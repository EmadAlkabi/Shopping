<?php

namespace App\Http\Controllers\Api;

use App\Enum\MainShowType;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementsCollection;
use App\Models\Announcement;
use App\Models\MainShow;

class AnnouncementController extends Controller
{
    use ApiResponseTrait;

    public function mainAnnouncements($numberOfAnnouncements = 5) {
        $targetIds = MainShow::select("target_id")
            ->where("type", MainShowType::ANNOUNCEMENTS)
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
}
