<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;

class TopCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'image'         => "https://lorempixel.com/640/480/?24239",
            'price'         => $this->price,
            'discount_rate' => $this->discountRate(),
            'rating'        => $this->rating(),
            'quantity'      => $this->quantity
        ];
    }
}
