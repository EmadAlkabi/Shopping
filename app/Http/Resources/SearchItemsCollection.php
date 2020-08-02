<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SearchItemsCollection extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'image'         => (is_null($this->mainImage()))
                ? asset('images/large' . Storage::url("public/item/default.png"))
                : asset('images/large' . Storage::url($this->mainImage()->url)),
            'currency'      => $this->currency,
            'unit'          => new UnitsCollection($this->mainUnit()),
            'rating'        => $this->rating()
        ];
    }
}
