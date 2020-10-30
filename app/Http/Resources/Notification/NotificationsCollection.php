<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title"    => $this->title,
            "body"     => $this->body,
            "action"   => $this->action,
            "content"  => $this->content,
            "datetime" => $this->datetime
        ];
    }
}
