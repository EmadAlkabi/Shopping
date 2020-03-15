<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleItemCollection extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'details'  => $this->details,
            'currency' => $this->currency,
            'price'    => $this->price,
            'unit'     => $this->unit,
            'quantity' => $this->quantity,

            'discount_rate'   => $this->discountRate(),
            'numberOfReviews' => $this->reviews->count(),
            'rating'          => $this->rating(),

            'vendor' => [
                'id'   => $this->vendor->id,
                'name' => $this->vendor->name
            ],

            'category' => [
                'id'   => $this->category->id,
                'name' => $this->category->name
            ]
        ];
    }
}
