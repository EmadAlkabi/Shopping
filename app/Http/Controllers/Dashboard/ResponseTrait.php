<?php

namespace App\Http\Controllers\Dashboard;

trait ResponseTrait
{
    public function response($data) {
        return response()->json([
            "data"    => $data,
            "status"  => true,
            "message" => null
        ]);
    }

    public function responseWithMessage($status, $message) {
        return response()->json([
            "data"    => null,
            "status"  => $status,
            "message" => $message
        ]);
    }
}
