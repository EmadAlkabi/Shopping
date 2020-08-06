<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserState;
use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewsCollection;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    use ResponseTrait;

    public function all() {
        $reviews = Review::where("item_id", request()->input("item"))
            ->paginate(10);
        ReviewsCollection::collection($reviews);

        return $this->paginateResponse($reviews);
    }

    public function single() {
        $review = Review::where("user_id", request()->input("user"))
            ->where("item_id", request()->input("item"))
            ->first();

        return $this->simpleResponse(($review)
            ? new ReviewsCollection($review)
            : null
        );
    }

    public function createOrUpdate() {
        $user = User::find(request()->input("user"));

        if ($user->state == UserState::INACTIVE)
            return response()->json([
                "data"   => null,
                "status" => true,
                "error"  => __("api.user.blocked")
            ]);

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
