<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Item\TopCollection;
use App\Models\Item;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function index() {
        $items = Item::all();
        return $this->apiResponse($items, 200, false);
    }




    public function newProduct($numberOfItem = 10) {
        $items = Item::where('deleted', 0)
            ->latest()
            ->take($numberOfItem)
            ->get();

        if (!$items)
            return $this->notFoundResponse();

        return $this->apiResponse(TopCollection::collection($items));
    }

    public function topSell($numberOfItem = 10) {
        $items = Item::where('deleted', 0)->get();

        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'count' => $item->orders->count()]);

        $topItems = $collection->sortByDesc('count')
            ->take($numberOfItem)
            ->pluck('item');

        if (!$topItems)
            return $this->notFoundResponse();

        return $this->apiResponse(TopCollection::collection($topItems));
    }

    public function topRating($numberOfItem = 10) {
        $items = Item::where('deleted', 0)->get();

        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'rating' => $item->reviews->avg('rating')]);

        $topItems = $collection->sortByDesc('rating')
            ->take($numberOfItem)
            ->pluck('item');

        if (!$topItems)
            return $this->notFoundResponse();

        return $this->apiResponse(TopCollection::collection($topItems));
    }

    public function topDiscount($numberOfItem = 10) {
        $items = Item::where('deleted', 0)->get();

        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'discountRate' => $item->discountRate()]);

        $topItems = $collection->sortByDesc('discountRate')
            ->take($numberOfItem)
            ->pluck('item');

        if (!$topItems)
            return $this->notFoundResponse();

        return $this->apiResponse(TopCollection::collection($topItems));
    }
}
