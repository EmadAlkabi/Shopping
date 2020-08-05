<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\Category\CategoriesCollection;
use App\Http\Resources\Unit\UnitsCollection;
use App\Http\Resources\Vendor\SingleVendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SingleItem extends JsonResource
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
            "id"              => $this->id,
            "name"            => $this->name,
            "details"         => $this->details,
            "currency"        => $this->currency,
            "rating"          => $this->rating(),
            "numberOfReviews" => $this->reviews->count(),
            "vendor"          => new SingleVendor($this->vendor),
            "units"           => UnitsCollection::collection($this->units),
            "category"        => new CategoriesCollection($this->category),
            "media" => [
                "images" => $this->images->map(function ($image) {
                    return asset("images/large" . Storage::url($image->url));
                }),
                "videos" => $this->videos->map(function ($video) {
                    return "https://www.youtube.com/embed/$video->url";
                })
            ]
        ];
    }
}
