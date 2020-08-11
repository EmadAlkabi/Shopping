<?php


namespace App\Http\Resources;


use App\Enum\AnnouncementType;
use App\Enum\Currency;
use App\Http\Resources\Vendor\SingleVendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OrdersCollection extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $orderItems = $this->orderItems;
        return [
            "id"              => $this->id,
            "vendor"          => new SingleVendor($this->vendor),
            "total_items"     => $orderItems->count(),
            "total_price_IQD" => $orderItems->map(function ($orderItem) {
                if ($orderItem->item->currency == Currency::IQD)
                    return $orderItem->price * $orderItem->quantity;
            })->sum(),
            "total_price_USD" => $orderItems->map(function ($orderItem) {
                if ($orderItem->item->currency == Currency::USD)
                    return $orderItem->price * $orderItem->quantity;
            })->sum(),
            "state"           => $this->state,
            "request_at"      => $this->request_at,
            "response_at"     => $this->response_at,
        ];
    }
}
