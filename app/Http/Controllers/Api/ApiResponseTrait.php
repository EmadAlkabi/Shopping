<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiResponse($data=null, $code=200, $error=false) {
        $array = [
            'data'   => $data,
            'status' => in_array($code, array(200, 201, 202))? true:false,
            'error'  => $error
        ];

        return response($array, $code);
    }

    public function notFoundResponse() {
        return $this->apiResponse(null,404,'Not found!');
    }
}
