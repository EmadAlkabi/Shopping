<?php

namespace App\Http\Controllers\Api;

use App\Enum\MainShowType;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementsCollection;
use App\Http\Resources\OffersCollection;
use App\Models\Announcement;
use App\Models\MainShow;
use App\Models\Offer;

class MainShowController extends Controller
{
    use ApiResponseTrait;

    public function announcements() {
        $numberOfAnnouncements = request()->input('numberOfAnnouncements', 5);

        $targetIds = MainShow::select("target_id")
            ->where("type", MainShowType::ANNOUNCEMENT)
            ->latest()
            ->get();

        $announcements = Announcement::whereIn('id', $targetIds)
            ->where('end_date', '>', date('Y-m-d'))
            ->take($numberOfAnnouncements)
            ->get();

        if (!$announcements)
            return $this->notFoundResponse();

        return $this->apiResponse(AnnouncementsCollection::collection($announcements));
    }

    public function offers() {
        $numberOfOffers = request()->input('numberOfOffers', 10);

        $targetIds = MainShow::select("target_id")
            ->where("type", MainShowType::OFFER)
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
