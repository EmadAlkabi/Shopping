<?php

namespace App\Http\Resources\Unit;

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
            "id" => $this->id,
            'name'          => $this->name,
            'price'         => $this->price,
            'quantity'      => $this->quantity,
            'details'       => (!is_null($this->child()))
                ? $this->details($this->child())
                : null,
            'discount_rate' => 0
        ];
    }

    public function details($unit)
    {
        return "تحتوي على " . $unit->quantity . " " . $unit->name;
    }
}
