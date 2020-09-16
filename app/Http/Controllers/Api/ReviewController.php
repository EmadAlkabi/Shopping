<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserState;
use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewsCollection;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ResponseTrait;

    public function all(Request $request) {
        $reviews = Review::where("item_id", $request->input("item"))
            ->paginate(10);
        ReviewsCollection::collection($reviews);

        return $this->paginateResponse($reviews);
    }

    public function single(Request $request) {
        $review = Review::where("user_id", $request->input("user"))
            ->where("item_id", $request->input("item"))
            ->first();

        return $this->simpleResponse(($review)
            ? new ReviewsCollection($review)
            : null
        );
    }

    public function createOrUpdate(Request $request) {
        $user = User::find($request->input("user"));

        if ($user->state == UserState::INACTIVE)
            return $this->simpleResponseWithMessage(false, "api.user.blocked");

        $review = Review::updateOrCreate([
            "user_id" => request()->input("user"),
            "item_id" => request()->input("item"),
        ], [
            "rate"    => request()->input("rating"),
            "comment" => request()->input("comment")
        ]);

        if (!$review)
            return $this->simpleResponseWithMessage(false, "api.review.stored-failed");

        return $this->simpleResponse($review);
    }

    public function delete(Request $request) {
        $review = Review::where("user_id", request()->input("user"))
            ->where("item_id", $request->input("item"))
            ->first();

        if (!$review)
            return $this->simpleResponseWithMessage(false, "api.review.not-found");

        $review = $review->delete();

        if (!$review)
            return $this->simpleResponseWithMessage(false, "api.review.deleted-failed");

        return $this->simpleResponseWithMessage(true, "success");
    }
}
