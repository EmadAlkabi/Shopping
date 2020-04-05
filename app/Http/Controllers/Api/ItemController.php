<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Models\Item;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function show($item) {
        $item = Item::where('id', $item)
            ->where('deleted', '!=', 1)
            ->first();

        if(!$item)
            return $this->notFoundResponse();

        return $this->apiResponse(new ItemCollection($item));
    }
}
