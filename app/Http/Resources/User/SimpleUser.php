<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SimpleUser extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return   [
            "id"    => $this->id,
            "name"  => $this->name,
            "image" => asset("images/small".Storage::url($this->image)),
        ];
    }
}
