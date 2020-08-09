<?php

namespace App\Http\Controllers\Api;

use App\Enum\Currency;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index() {
        ini_set("max_execution_time", 300);
        $vendor = request()->input("vendor");
        $items = collect(json_decode(file_get_contents(request()->file("file")), true));

        $items->map(function ($item) use ($vendor) {
            $newItem = Item::updateOrCreate([
                "vendor_id"  => $vendor,
                "offline_id" => $item["id"]
            ], [
                "name"       => $item["name"],
                "company"    => null,
                "tags"       => null,
                "details"    => null,
                "barcode"    => null,
                "code"       => null,
                "currency"   => ($item["currency"] == 1) ? Currency::IQD : Currency::USD,
                "deleted"    => 0
            ]);

            $units = collect($item["units"]);
            $units->map(function ($unit) use ($newItem) {
                Unit::updateOrCreate([
                    "item_id"    => $newItem->id,
                    "offline_id" => $unit["id"]
                ], [
                    "name"      => $unit["name"],
                    "quantity"  => (integer)$unit["quantity"],
                    "price"     => (double)$unit["price"],
                    "main"      => (integer)$unit["isMain"],
                    "content"   => (integer)$unit["content"],
                    "child_id"  => $unit["childId"]
                ]);
            });

            Unit::where("item_id", $newItem->id)
                ->whereNotIn("offline_id", $units->pluck("id"))
                ->delete();
        });

        Item::where("vendor_id", $vendor)
            ->whereNotIn("offline_id", $items->pluck("id"))
            ->update(["deleted" => 1]);

        return "OK";
    }
}
