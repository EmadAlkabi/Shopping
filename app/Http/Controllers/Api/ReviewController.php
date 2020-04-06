<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewsCollection;
use App\Models\Item;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function index() {
        $item = request()->input('item');
        $item = Item::where('id', $item)
            ->where('deleted', '!=', 1)
            ->first();

        if(!$item)
            return $this->notFoundResponse();

        $page = request()->input('page', 0);
        $reviews = $item->reviews->chunk(10);

        return $this->apiResponse(ReviewsCollection::collection($reviews[$page]));

    }

    public function store() {

    }
}
