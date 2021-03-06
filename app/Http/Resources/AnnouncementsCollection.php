<?php


namespace App\Http\Resources;


use App\Enum\AnnouncementType;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'image'       => asset('images/x-large' . Storage::url($this->image)),
            'target'      => $this->target_id,
            'type'        => $this->type,
            'link'        => ($this->type == AnnouncementType::OFFER)
                                ? route('offers.show', ['offer' => $this->target_id])
                                : route('items.show', ['item' => $this->target_id]),
        ];
    }
}
