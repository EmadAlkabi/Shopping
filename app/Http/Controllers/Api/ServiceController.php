<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index() {

        return response()->json([request()->input(), request()->file("file")]);

        $vendor = request()->input("vendor");
        $items = collect(json_decode(file_get_contents(request()->file("file")), true));
        foreach ($items->chunk(300) as $chunk) {
            foreach ($chunk as $item) {

            }
        }

        return $items;
    }
}
