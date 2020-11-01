<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationController extends Controller
{
    public static function send($topic, $title, $body, $action, $content, Messaging $messaging)
    {
        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification([
                "title" => $title,
                "body"  => $body
            ]) // optional
            ->withData([
                "action"  => $action,
                "content" => $content ?? null
            ]) // optional
            ->withAndroidConfig([
                "notification"=> [
                    "click_action"=> $action,
                    "channel_id"=> "3000",
                    "default_sound"=> true,
                    "default_vibrate_timings"=> true,
                    "default_light_settings"=> true
                ],
                "priority"=> "high"
            ]);

        $messaging->send($message);
    }

    private static function save() {

    }
}
