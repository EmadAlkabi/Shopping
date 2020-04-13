<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewsCollection;
use App\Models\Item;

class ReviewController extends Controller
{
    public function index() {
        $item = request()->input('item');
        $item = Item::where('id', $item)
            ->where('deleted', '!=', 1)
            ->first();

        if(!$item)
            return response()->json([
                "data" => null,
                "status" => false,
                "error" => "item not found",
            ]);

        $reviews = $item->reviews->chunk(10);
        $pages = $reviews->count();
        $page = (integer)request()->input('page', 1);

        if ($page < 1 || $page > $pages)
            return response()->json([
                "data" => null,
                "status" => false,
                "error" => "page number not in rang",
            ]);

        return response()->json([
            "data" => ReviewsCollection::collection($reviews[$page-1]),
            "current-page" => $page,
            "max-page" => $pages,
            "status" => true,
            "error" => false,
        ]);
    }

    public function store() {

    }
}
