<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\TopItemsCollection;
use App\Models\Item;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function show($item) {
        $item = Item::where('id', $item)->get();

        if(!$item)
            return $this->notFoundResponse();

        return $this->apiResponse(ItemCollection::collection($item));
    }
}
