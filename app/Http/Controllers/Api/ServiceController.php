<?php

namespace App\Http\Controllers\Api;

use App\Enum\Currency;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ServiceController extends Controller
{
    public function index() {
        $vendor = request()->input("vendor");
        $items = collect(json_decode(file_get_contents(request()->file("file")), true));

        foreach ($items as $item) {
            Item::updateOrCreate(
                [
                    "vendor_id" => $vendor,
                    "offline_id" => $item["id"]
                ],
                [
                    "name"       => $item["name"],
                    "company"    => null,
                    "tags"       => null,
                    "details"    => null,
                    "barcode"    => null,
                    "code"       => null,
                    "currency"   => ($item["currency"] == 1) ? Currency::IQD : Currency::USD,
                    "deleted"    => 0
                ]
            );
        }

//        foreach ($items->chunk(300) as $chunk) {
//            foreach ($chunk as $item) {}
//        }

        return $items;
    }
}
