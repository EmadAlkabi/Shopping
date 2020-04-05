<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ItemCollection extends JsonResource
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
            'rating'          => $this->rating(),
            'numberOfReviews' => $this->reviews->count(),

            'vendor' => [
                'id'   => $this->vendor->id,
                'name' => $this->vendor->name
            ],

            'category' => [
                'id'   => $this->category->id,
                'name' => $this->category->name
            ],

            'media' => [
                'images' => $this->images->map(function ($image) {
                    return asset('images/large' . Storage::url($image->url));
                }),
                'videos' => $this->videos->map(function ($video) {
                    return "https://www.youtube.com/embed/$video->url";
                }),
            ]
        ];
    }
}