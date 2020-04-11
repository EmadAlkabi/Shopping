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
            // By price
            case 1:
                (request()->input('sort') == 2)
                    ? $items = $items->sortByDesc("price")
                    : $items = $items->sortBy("price");
                break;
            // By rating
            case 2:
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
            case 3:
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

        $page = request()->input('page');
        if (is_null($page) || $page < 1)
            $page = 1;

        $items = $items->chunk(10);

        return $this->apiResponse(SearchItemsCollection::collection($items[$page-1]));
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
