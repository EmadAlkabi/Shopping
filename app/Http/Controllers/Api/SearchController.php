<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchItemsCollection;
use App\Models\Item;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    use ApiResponseTrait;

    public function search() {
        $items = self::getItems(request()->input('vendor'), request()->input('query'));

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
            return $this->apiResponse(null, 200, "page number not in rang");

        return $this->apiResponse([
            "items" => SearchItemsCollection::collection($items[$page-1]),
            "current-page" => $page,
            "max-page"     => $pages
        ]);
    }

    public static function getItems($vendor, $query) {
        if (is_null($vendor) || $vendor == "null")
            $items =  Item::where("deleted", 0)
                ->whereRaw("(name like '%$query%' or company_name like '%$query%' or tags like '%$query%')")
                ->get();
        else
            $items = Item::where("vendor_id", $vendor)
                ->where("deleted", 0)
                ->whereRaw("(name like '%$query%' or company_name like '%$query%' or tags like '%$query%')")
                ->get();

        return $items;
    }
}
