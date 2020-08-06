<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait ResponseTrait{
    public function simpleResponse($data) {
        return response()->json([
            "data"    => ($data instanceof AnonymousResourceCollection && $data->isEmpty()) ? null : $data,
            "status"  => true,
            "message" => null
        ]);
    }

    public function simpleResponseWithMessage($status, $message) {
        return response()->json([
            'data'    => null,
            'status'  => $status,
            'message' => $message
        ]);
    }

    public function paginateResponse($collection) {
        $array = $collection->toArray();
        $data = empty($array["data"]) ? null : $array["data"];
        $currentPage = $array["current_page"];
        $maxPage = ceil($array["total"]/$array["per_page"]);
        $status =  ($currentPage > $maxPage && $maxPage >= 1) ? false : true;
        $message = ($status) ? null : "out of range";

        return response()->json([
            "data"         => $data,
            "current_page" => $currentPage,
            "max_page"     => $maxPage,
            "status"       => $status,
            "message"      => $message
        ]);
    }

    public function paginateResponseWithMessage($status, $message) {
        return response()->json([
            "data"         => null,
            "current_page" => 1,
            "max_page"     => 0,
            "status"       => $status,
            "message"      => $message
        ]);
    }
}
