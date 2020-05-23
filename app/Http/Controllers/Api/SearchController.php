<?php

namespace App\Http\Controllers\Api;

use App\Enum\ItemDeleted;
use App\Http\Controllers\Controller;
use App\Http\Resources\SearchItemsCollection;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search() {
        $items = self::getItems(request()->input('query'), request()->input('vendor'), request()->input('category'));
        switch (request()->input('order')) {
            // By alphabets
            case 1:
                (request()->input('sort') == 2)
                    ? $items = $items->sortByDesc("name")
                    : $items = $items->sortBy("name");
                break;
            // By price
            case 2:
                (request()->input('sort') == 2)
                    ? $items = $items->sortByDesc("price")
                    : $items = $items->sortBy("price");
                break;
            // By rating
            case 3:
                $collection = new Collection();
                foreach($items as $item)
                    $collection->push([
                        'item' => $item,
                        'rating' => $item->reviews->avg('rating')
                    ]);

                (request()->input('sort') == 2)
                    ? $collection = $collection->sortByDesc('rating')
                    : $collection = $collection->sortBy('rating');
                $items = $collection->pluck('item');
                break;
            // By best sell
            case 4:
                $collection = new Collection();
                foreach($items as $item)
                    $collection->push([
                        'item' => $item,
                        'count' => $item->orders->count()
                    ]);

                (request()->input('sort') == 2)
                    ? $collection = $collection->sortByDesc('count')
                    : $collection = $collection->sortBy('count');
                $items = $collection->pluck('item');
                break;
        }

        $items = $items->chunk(10);
        $pages = $items->count();
        $page = (integer)request()->input('page', 1);

        if ($page < 1 || $page > $pages)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.search-item.out-range"),
            ]);

        return response()->json([
            "data"         => SearchItemsCollection::collection($items[$page-1]),
            "current-page" => $page,
            "max-page"     => $pages,
            "status"       => true,
            "error"        => null,
        ]);
    }

    public static function getItems($query, $vendor, $category) {
        // Without vendor
        if (is_null($vendor) || $vendor == "null")
            // Without category
            if (is_null($category) || $category == "null")
                $items =  Item::where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
            // With category
            else
                $items =  Item::whereIn("category_id", self::getCategoryChildren($category))
                    ->where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
        // With vendor
        else
            // Without category
            if (is_null($category) || $category == "null")
                $items = Item::where("vendor_id", $vendor)
                    ->where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
            // With category
            else
                $items = Item::where("vendor_id", $vendor)
                    ->whereIn("category_id", self::getCategoryChildren($category))
                    ->where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
        return $items;
    }

    public static function getCategoryChildren($category) {
        return Category::where("parent_id", $category)
            ->pluck("id")
            ->toArray();
    }
}
