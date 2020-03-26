<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\TopItemsCollection;
use App\Models\Item;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Resource_;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function show($item) {
        $item = Item::where('id', $item)
            ->where('deleted', '!=', 1)
            ->get();

        if(!$item->first())
            return $this->notFoundResponse();

        return $this->apiResponse(ItemCollection::collection($item));
    }
}
