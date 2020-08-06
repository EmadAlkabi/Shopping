<?php

namespace App\Http\Resources\Item;

use App\Http\Resources\Category\CategoriesCollection;
use App\Http\Resources\Unit\UnitsCollection;
use App\Http\Resources\Vendor\SingleVendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SimpleItem extends JsonResource
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
            "currency"        => $this->currency,
            "image"         => (is_null($this->mainImage()))
                ? asset('images/large' . Storage::url("public/item/default.png"))
                : asset('images/large' . Storage::url($this->mainImage()->url)),
        ];
    }
}
