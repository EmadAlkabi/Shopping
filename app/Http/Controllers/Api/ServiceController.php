<?php

namespace App\Http\Controllers\Api;

use App\Enum\Currency;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Unit;

class ServiceController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        ini_set("max_execution_time", 300);

        $vendor = request()->input("vendor");
        $items = collect(json_decode(file_get_contents(request()->file("file")), true));

        if ($items->isEmpty())
            return $this->simpleResponseWithMessage(false, "file is empty");

        $items->map(function ($item) use ($vendor) {
            $newItem = Item::updateOrCreate([
                "vendor_id"  => $vendor,
                "offline_id" => $item["id"]
            ], [
                "name"       => $item["name"],
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
                    "quantity"  => $unit["quantity"],
                    "price"     => $unit["price"],
                    "main"      => $unit["isMain"],
                    "content"   => $unit["content"],
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

        return $this->simpleResponseWithMessage(true, "success");
    }
}
