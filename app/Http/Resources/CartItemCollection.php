<?php

namespace App\Http\Resources;

use App\Http\Requests\Request;
use App\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
        return [
            "id"       => $this->order_item_id,
            "quantity" => $this->order_item_quantity,
            "item"     => [
                "id"       => $this->item_id,
                "name"     => $this->item_name,
                "currency" => $this->item_currency,
                "image"    => self::getItemImage($this->item_id)
            ],
            "unit"     => [
                "name"     => $this->unit_name,
                "price"    => $this->unit_price,
                "quantity" => $this->unit_quantity
            ],
            "total"    => ($this->unit_price - 0) * $this->order_item_quantity
        ];
    }

    public static function getItemImage($item_id)
    {
        $item = Item::find($item_id);

        return (is_null($item->mainImage()))
            ? asset('images/large' . Storage::url("public/item/default.png"))
            : asset('images/large' . Storage::url($item->mainImage()->url));
    }
}
