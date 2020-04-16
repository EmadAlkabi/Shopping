<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserCollection extends JsonResource
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
            "id"         => $this->id,
            "name"       => $this->name,
            "phone"      => $this->phone,
            "image"      => (!is_null($this->image))
                ? asset("images/large" . Storage::url($this->image))
                : asset('images/large' . Storage::url("public/user/default.png")),
            "address_1"  => $this->address_1,
            "address_2"  => $this->address_2,
            "gps"        => $this->gps,
            "state"      => $this->state,
            "created_at" => $this->created_at
        ];
    }
}
