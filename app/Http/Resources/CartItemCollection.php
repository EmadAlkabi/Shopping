<?php

namespace App\Http\Resources;

use App\Http\Requests\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartItemCollection extends JsonResource
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
            'id'         => $this->id,
            'item'       => [
                'id'       => $this->item_id,
                'name'     => $this->item_name,
                'quantity' => $this->item_quantity
            ],
            'currency'   => $this->currency,
            'price'      => $this->price,
            'total'      => $this->price * $this->quantity,
            'quantity'   => $this->quantity,
            'created_at' => $this->created_at
        ];
    }
}
