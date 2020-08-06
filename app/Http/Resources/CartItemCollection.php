<?php

namespace App\Http\Resources;

use App\Http\Requests\Request;
use App\Http\Resources\Item\SimpleItem;
use App\Http\Resources\Unit\UnitsCollection;
use App\Models\OrderItem;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $orderItem = OrderItem::find($this->id);
        return [
            'id'       => $this->id,
            'item'     => new SimpleItem($orderItem->item),
            'unit'     => new UnitsCollection($orderItem->unit),
            "quantity" => $this->quantity,
            "total"    => ($orderItem->unit->price - 0) * $this->quantity
        ];
    }
}
