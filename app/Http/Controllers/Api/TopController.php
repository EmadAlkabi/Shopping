<?php

namespace App\Http\Controllers\Api;

use App\Enum\ItemDeleted;
use App\Http\Controllers\Controller;
use App\Http\Resources\TopItemsCollection;
use App\Models\Item;
use Illuminate\Support\Collection;

class TopController extends Controller
{
    public function newProduct() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);
        $items = self::getItems($vendor);
        $items = self::getNewProductItems($items, $numberOfItems);

        return response()->json([
            "data"   => (!$items->isEmpty())
                ? TopItemsCollection::collection($items)
                : null,
            "status" => true,
            "error"  => null
        ]);
    }

    public function topSell() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);
        $items = self::getItems($vendor);
        $items = self::getTopSellItems($items, $numberOfItems);

        return response()->json([
            "data"   => (!$items->isEmpty())
                ? TopItemsCollection::collection($items)
                : null,
            "status" => true,
            "error"  => null
        ]);

    }

    public function topRating() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);
        $items = self::getItems($vendor);
        $items = self::getTopRatingItems($items, $numberOfItems);

        return response()->json([
            "data"   => (!$items->isEmpty())
                ? TopItemsCollection::collection($items)
                : null,
            "status" => true,
            "error"  => null
        ]);
    }

    public function topDiscount() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);
        $items = self::getItems($vendor);
        $items = self::getTopDiscountItems($items, $numberOfItems);

        return response()->json([
            "data"   => (!$items->isEmpty())
                ? TopItemsCollection::collection($items)
                : null,
            "status" => true,
            "error"  => null
        ]);
    }

    public function topCollection() {
        $numberOfItems = request()->input('numberOfItems', 10);
        $vendor = request()->input('vendor', null);
        $items = self::getItems($vendor);

        return response()->json([
            "data"   => (!$items->isEmpty())
                ? [
                    "new-product"  => TopItemsCollection::collection(self::getNewProductItems($items, $numberOfItems)),
                    "top-sell"     => TopItemsCollection::collection(self::getTopSellItems($items, $numberOfItems)),
                    "top-rating"   => TopItemsCollection::collection(self::getTopRatingItems($items, $numberOfItems)),
                    "top-discount" => TopItemsCollection::collection(self::getTopDiscountItems($items, $numberOfItems))
                ]
                : null,
            "status" => true,
            "error"  => null
        ]);
    }

    public function bestTopCollection() {
        $numberOfItems = request()->input('numberOfItems', 2);
        $vendor = request()->input('vendor', null);
        $items = self::getItems($vendor);
        $topItems = collect([
            self::getNewProductItems($items, $numberOfItems),
            self::getTopSellItems($items, $numberOfItems),
            self::getTopRatingItems($items, $numberOfItems),
            self::getTopDiscountItems($items, $numberOfItems)
        ])->collapse();

        return response()->json([
            "data"   => (!$topItems->isEmpty())
                ? TopItemsCollection::collection($topItems)
                : null,
            "status" => true,
            "error"  => null
        ]);
    }

    public static function getItems($vendor) {
        return (is_null($vendor) || $vendor == "null")
            ? Item::where('deleted', ItemDeleted::FALSE)
                ->get()
            : Item::where('vendor_id', $vendor)
                ->where('deleted', ItemDeleted::FALSE)
                ->get();
    }

    public static function getNewProductItems($items, $numberOfItems) {
        return $items->sortByDesc('id')
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
