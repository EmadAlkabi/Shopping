<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\ApiResponseTrait;
use App\Models\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ApiItemController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display model change deleted.
     *
     * @return Application|ResponseFactory|Response
     * @throws /Throwable
     */
    public function changeDeleted()
    {
        $item = self::getItem();
        $view = view("dashboard.item.components.modal-change-deleted", compact("item"))->render();
        return $this->apiResponse(["html" => $view]);
    }

    /**
     * Get the specified item from storage.
     *
     * @return mixed
     */
    public static function getItem() {
        return Item::where("id", request()->input("item"))
            ->where("vendor_id", 1)
            ->first();
    }
}
