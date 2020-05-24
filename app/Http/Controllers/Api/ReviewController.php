<?php

namespace App\Http\Controllers\Api;

use App\Enum\ItemDeleted;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewsCollection;
use App\Models\Item;
use App\Models\Review;

class ReviewController extends Controller
{
    public function allReviews() {
        $reviews = Review::where("item_id", request()->input("item"))->get();
        $reviews = $reviews->chunk(10);
        $pages = $reviews->count();
        $page = (integer)request()->input('page', 1);

        if (!$reviews->isEmpty() && ($page < 1 || $page > $pages))
            return response()->json([
                "data" => null,
                "status" => false,
                "error" => __("api.review.out-range"),
            ]);

        return response()->json([
            "data"         => ($reviews->isEmpty())
                ? null
                : ReviewsCollection::collection($reviews[$page-1]),
            "current-page" => $page,
            "max-page"     => $pages,
            "status"       => true,
            "error"        => null,
        ]);
    }

    public function singleReview() {
        $review = Review::where("user_id", request()->input("user"))
            ->where("item_id", request()->input("item"))
            ->first();

        return response()->json([
            "data"         => (is_null($review))
                ? null
                : new ReviewsCollection($review),
            "status"       => true,
            "error"        => null,
        ]);
    }

    public function store() {
        $review = Review::updateOrCreate(
            [
                "user_id" => request()->input("user"),
                "item_id" => request()->input("item"),
            ],
            [
                "rating"  => request()->input("rating"),
                "comment" => request()->input("comment"),
                "created_at" => date("Y-m-d h:i:s")
            ]
        );

        if (!$review)
            return response()->json([
                "data"   => null,
                "status" => true,
                "error"  => __("api.review.stored-failed")
            ]);

        return response()->json([
            "data"   => $review,
            "status" => true,
            "error"  => null
        ]);
    }

    public function delete() {
        $review = Review::where("user_id", request()->input("user"))
            ->where("item_id", request()->input("item"))
            ->first();

        if (!$review)
            return response()->json([
                "data" => null,
                "status" => false,
                "error" => __("api.review.not-found")
            ]);

        $review = $review->delete();

        if (!$review)
            return response()->json([
                "data" => null,
                "status" => false,
                "error" => __("api.review.deleted-failed")
            ]);

        return response()->json([
            "data"   => null,
            "status" => true,
            "error"  => null
        ]);
    }
}
