<?php

namespace App\Http\Controllers\Dashboard\Media;

use App\Enum\MediaItemType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MediaImageRequest;
use App\Models\Item;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(){
        $item = Item::findOrFail(\request()->input("item"));
        self::checkView($item);

        return view("dashboard.media.index")->with([
            "item" => $item
        ]);
    }

    public function imageStore(MediaImageRequest $request){
        $item = Item::findOrFail(\request()->input("item"));
        self::checkView($item);

        foreach (request()->file('image') as $file) {
            $image = Storage::put("public/item/test", $file);
            $mediaItem = MediaItem::create([
                "item_id"    => $item->id,
                "type"       => MediaItemType::IMAGE,
                "url"        => $image,
                "main"       => 0,
                "created_at" => date("Y-m-d")
            ]);

            if (!$mediaItem)
                return redirect()
                    ->back()
                    ->with([
                        "message" => __("dashboard/media.store-image.failed"),
                        "type"    => "warning"
                    ]);
        }

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/media.store-image.success"),
                "type"    => "success"
            ]);
    }

    public function imageSelect(){
        $currentImage = MediaItem::findOrFail(\request()->input("image"));
        $item = Item::findOrFail($currentImage->item_id);
        self::checkView($item);

        foreach ($item->images as $image) {
            $image->main = $image->id == $currentImage->id ? 1 : 0;
            $success = $image->save();

            if (!$success)
                return redirect()
                    ->back()
                    ->with([
                        "message" => __("dashboard/media.select-image.failed"),
                        "type"    => "warning"
                    ]);
        }

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/media.select-image.success"),
                "type"    => "success"
            ]);
    }

    public function imageDelete(){
        $currentImage = MediaItem::findOrFail(\request()->input("image"));
        $item = Item::findOrFail($currentImage->item_id);
        self::checkView($item);
        Storage::delete($currentImage->url);
        $success = $currentImage->delete();

        if (!$success)
            return redirect()
                ->back()
                ->with([
                    "message" => __("dashboard/media.delete-image.failed"),
                    "type"    => "warning"
                ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/media.delete-image.success"),
                "type"    => "success"
            ]);
    }

    /**
     * Check permission to view the specified resource.
     *
     * @param Item $item
     */
    public static function checkView(Item $item) {
        if ($item->vendor_id != 1)
            abort(404);
    }
}
