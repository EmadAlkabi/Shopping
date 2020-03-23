<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopItemsCollection;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TopController extends Controller
{
    use ApiResponseTrait;

    public function newProduct() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);
        $items = $items->sortByDesc('created_at')->take($numberOfItems);

        if (!$items)
            return $this->notFoundResponse();

        return $this->apiResponse(TopItemsCollection::collection($items));
    }

    public function topSell() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'count' => $item->orders->count()]);

        $topItems = $collection->sortByDesc('count')
            ->take($numberOfItems)
            ->pluck('item');

        if (!$topItems)
            return $this->notFoundResponse();

        return $this->apiResponse(TopItemsCollection::collection($topItems));
    }

    public function topRating() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'rating' => $item->reviews->avg('rating')]);

        $topItems = $collection->sortByDesc('rating')
            ->take($numberOfItems)
            ->pluck('item');

        if (!$topItems)
            return $this->notFoundResponse();

        return $this->apiResponse(TopItemsCollection::collection($topItems));
    }

    public function topDiscount() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'discountRate' => $item->discountRate()]);

        $topItems = $collection->sortByDesc('discountRate')
            ->take($numberOfItems)
            ->pluck('item');

        if (!$topItems)
            return $this->notFoundResponse();

        return $this->apiResponse(TopItemsCollection::collection($topItems));
    }

    public static function getItems($vendor) {
        if (is_null($vendor) || $vendor == "null")
            $items = Item::where('category_id', '!=', null)
                ->where('deleted', 0)
                ->get();
        else
            $items = Item::where('vendor_id', $vendor)
                ->where('category_id', '!=', null)
                ->where('deleted', 0)
                ->get();

        return $items;
    }
}
