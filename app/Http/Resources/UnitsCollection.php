<?php

namespace App\Http\Resources;

use App\Http\Requests\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UnitsCollection extends JsonResource
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
            'name'          => $this->name,
            'price'         => $this->price,
            'quantity'      => $this->quantity,
            'main'          => $this->main,
            'content'       => $this->content,
            'child'         => $this->child()->name ?? null,
            'discount_rate' => 0
        ];
    }
}
