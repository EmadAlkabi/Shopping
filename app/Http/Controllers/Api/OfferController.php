<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferItemCollection;
use App\Models\Offer;

class OfferController extends Controller
{
    use ResponseTrait;

    public function show($offer) {
        $offer = Offer::where('id', $offer)
            ->where('end_date', '>', date('Y-m-d'))
            ->first();

        if(!$offer)
            return $this->notFoundResponse();

        return $this->apiResponse(OfferItemCollection::collection($offer->offerItems));
    }
}
