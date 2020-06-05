<?php


namespace App\Http\Resources;


use App\Enum\AnnouncementType;
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
        return [
            "id"                 => $this->id,
            "vendor"             => [
              "id"   => $this->vendor->id,
              "name" => $this->vendor->name
            ],
            "state"              => $this->state,
            "total_price_dollar" => $this->total_price_dollar,
            "total_price_dinar"  => $this->total_price_dollar,
            "request_at"         => $this->request_at,
            "response_at"         => $this->response_at,
            "items_counts"       => $this->items->count()
        ];
    }
}
