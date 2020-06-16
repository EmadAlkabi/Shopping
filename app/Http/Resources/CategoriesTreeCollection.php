<?php


namespace App\Http\Resources;


use App\Enum\AnnouncementType;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoriesTreeCollection extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'children' => (!is_null($this->children))
                ? $this::collection($this->children)
                : null
        ];
    }
}
