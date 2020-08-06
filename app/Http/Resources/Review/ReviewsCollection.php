<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\User\SimpleUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ReviewsCollection extends JsonResource
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
            "user"       => new SimpleUser($this->user),
            "rate"       => $this->rate,
            "comment"    => $this->comment,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
