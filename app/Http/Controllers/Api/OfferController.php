<?php

namespace App\Http\Controllers\Api;

use App\Enum\MainShowType;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffersCollection;
use App\Models\MainShow;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ApiResponseTrait;

    public function mainOffers($numberOfOffers = 10) {
        $targetIds = MainShow::select("target_id")
            ->where("type", MainShowType::OFFERS)
            ->latest()
            ->get();

        $offers = Offer::whereIn('id', $targetIds)
            ->where('end_date', '>', date('Y-m-d'))
            ->take($numberOfOffers)
            ->get();

        if (!$offers)
            return $this->notFoundResponse();

        return $this->apiResponse(OffersCollection::collection($offers));
    }
}
