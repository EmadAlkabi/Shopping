<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementsCollection extends JsonResource
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
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => $this->image,
            'id'          => $this->target_id,
            'type'        => $this->type,
        ];
    }
}
