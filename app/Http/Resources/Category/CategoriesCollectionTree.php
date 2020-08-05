<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesCollectionTree extends JsonResource
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
            "id"       => $this->id,
            "name"     => $this->name,
            "children" => (is_null($this->children))
                ? null
                : $this::collection($this->children)
        ];
    }
}
