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

        if (!$items)
            return $this->notFoundResponse();

        $items = self::getNewProductItems($items, $numberOfItems);

        return $this->apiResponse(TopItemsCollection::collection($items));
    }

    public function topSell() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        if (!$items)
            return $this->notFoundResponse();

        $items = self::getTopSellItems($items, $numberOfItems);

        return $this->apiResponse(TopItemsCollection::collection($items));
    }

    public function topRating() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        if (!$items)
            return $this->notFoundResponse();

        $items = self::getTopRatingItems($items, $numberOfItems);

        return $this->apiResponse(TopItemsCollection::collection($items));
    }

    public function topDiscount() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        if (!$items)
            return $this->notFoundResponse();

        $items = self::getTopDiscountItems($items, $numberOfItems);

        return $this->apiResponse(TopItemsCollection::collection($items));
    }

    public function topCollection() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);

        $items = self::getItems($vendor);

        if (!$items)
            return $this->notFoundResponse();

        return $this->apiResponse([
           "new-product"  => TopItemsCollection::collection(self::getNewProductItems($items, $numberOfItems)),
           "top-sell"     => TopItemsCollection::collection(self::getTopSellItems($items, $numberOfItems)),
           "top-rating"   => TopItemsCollection::collection(self::getTopRatingItems($items, $numberOfItems)),
           "top-discount" => TopItemsCollection::collection(self::getTopDiscountItems($items, $numberOfItems))
        ]);
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

    public static function getNewProductItems($items, $numberOfItems) {
        return $items->sortByDesc('created_at')
            ->take($numberOfItems);
    }

    public static function getTopSellItems($items, $numberOfItems) {
        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'count' => $item->orders->count()]);

        return $collection->sortByDesc('count')
            ->take($numberOfItems)
            ->pluck('item');
    }

    public static function getTopRatingItems($items, $numberOfItems) {
        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'rating' => $item->reviews->avg('rating')]);

        return $collection->sortByDesc('rating')
            ->take($numberOfItems)
            ->pluck('item');
    }

    public static function getTopDiscountItems($items, $numberOfItems) {
        $collection = new Collection();
        foreach($items as $item)
            $collection->push(['item' => $item, 'discountRate' => $item->discountRate()]);

        return $collection->sortByDesc('discountRate')
            ->take($numberOfItems)
            ->pluck('item');
    }
}
