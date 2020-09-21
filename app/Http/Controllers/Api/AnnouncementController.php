<?php

namespace App\Http\Controllers\Api;

use App\Enum\MainShowType;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementsCollection;
use App\Models\Announcement;
use App\Models\MainShow;

class AnnouncementController extends Controller
{
    use ResponseTrait;

    public function all()
    {
        $announcements = Announcement::all();
        return $this->simpleResponse(AnnouncementsCollection::collection($announcements));
    }
}
