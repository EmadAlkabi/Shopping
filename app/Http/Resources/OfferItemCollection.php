<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferItemCollection extends JsonResource
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
            'id'            => $this->item_id,
            'name'          => $this->item->name,
            'image'         => "https://lorempixel.com/640/480/?24239",
            'price'         => $this->item->price,
            'discount_rate' => $this->discount_rate,
            'rating'        => $this->item->rating(),
            'quantity'      => $this->item->quantity
        ];
    }
}
