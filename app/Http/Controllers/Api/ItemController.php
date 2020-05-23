<?php

namespace App\Http\Controllers\Api;

use App\Enum\ItemDeleted;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Models\Item;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function show($item) {
        $item = Item::where('id', $item)
            ->where('deleted', '=', ItemDeleted::FALSE)
            ->first();

        if(!$item)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.item.not-found")
            ]);

        return response()->json([
            "data"   => new ItemCollection($item),
            "status" => true,
            "error"  => null
        ]);
    }
}
