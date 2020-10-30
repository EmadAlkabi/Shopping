<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationsCollection;
use App\Models\Notification;

class NotificationController extends Controller
{
    use ResponseTrait;

    public function all()
    {
        $notifications = Notification::whereIn('receiver', [
            "users",
            "order_id"
        ])->paginate(20);
        NotificationsCollection::collection($notifications);

        return $this->paginateResponse($notifications);
    }
}
