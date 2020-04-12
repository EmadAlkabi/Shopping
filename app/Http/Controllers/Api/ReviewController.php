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

        $reviews = $item->reviews->chunk(10);
        $pages = $reviews->count();
        $page = (integer)request()->input('page', 1);

        if ($page < 1 || $page > $pages)
            return $this->apiResponse(null, 200, "page number not in rang");

        return $this->apiResponse([
            "reviews"      => ReviewsCollection::collection($reviews[$page-1]),
            "current-page" => $page,
            "max-page"     => $pages
        ]);
    }

    public function store() {

    }
}
