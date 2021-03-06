<?php

namespace App\Http\Controllers\Api;

use App\Enum\ItemDeleted;
use App\Http\Controllers\Controller;
use App\Http\Resources\Item\SingleItem;
use App\Http\Resources\Item\ItemsCollection;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    use ResponseTrait;

    public function index(Request $request) {
        $items = self::getItemsWithQuery($request->input("query"), (integer)$request->input("vendor"), (integer)$request->input("category"));
        $sort = $request->input("sort");

        switch ($request->input("order")) {
            // By alphabets
            case 1:
                $items = ($sort == 2)
                    ? $items->sortByDesc("name")
                    : $items->sortBy("name");
                break;
            // By price
            case 2:
                $items = ($sort == 2)
                    ? $items->sortByDesc("price")
                    : $items->sortBy("price");
                break;
            // By rating
            case 3:
                $collection = new Collection();
                foreach($items as $item)
                    $collection->push([
                        "item" => $item,
                        "rating" => $item->rating()
                    ]);

                $collection = ($sort == 2)
                    ? $collection->sortByDesc("rating")
                    : $collection->sortBy("rating");
                $items = $collection->pluck("item");
                break;
            // By best sell
            case 4:
                $collection = new Collection();
                foreach($items as $item)
                    $collection->push([
                        "item" => $item,
                        "count" => $item->orders->count()
                    ]);

                $collection = ($sort == 2)
                    ? $collection->sortByDesc("count")
                    : $collection->sortBy("count");
                $items = $collection->pluck("item");
                break;
            // Default by alphabets
            default:
                $items = ($sort == 2)
                    ? $items->sortByDesc("name")
                    : $items->sortBy("name");
        }

        $items = $items->chunk(10);
        $currentPage = (integer)request()->input("page", 1);
        $maxPage = $items->count();
        $data = empty($items[$currentPage-1]) ? null : ItemsCollection::collection($items[$currentPage-1]);
        $status =  ($currentPage > $maxPage && $maxPage >= 1) ? false : true;
        $message = ($status) ? null : "out of range";

        return response()->json([
            "data"         => $data,
            "current_page" => $currentPage,
            "max_page"     => $maxPage,
            "status"       => $status,
            "message"      => $message
        ]);
    }

    public static function getItemsWithQuery($query, $vendor, $category) {
        // Without vendor
        if ($vendor == 0)
            // Without category
            if ($category == 0)
                $items =  Item::where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
            // With category
            else
                $items =  Item::whereIn("category_id", array($category, self::getCategories($category)))
                    ->where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
        // With vendor
        else
            // Without category
            if ($category == 0)
                $items = Item::where("vendor_id", $vendor)
                    ->where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();
            // With category
            else
                $items = Item::where("vendor_id", $vendor)
                    ->whereIn("category_id", self::getCategories($category))
                    ->where("deleted", ItemDeleted::FALSE)
                    ->whereRaw("(name like '%$query%' or company like '%$query%' or tags like '%$query%')")
                    ->get();

        return $items;
    }

    public static function getCategories($category) {
        return Category::where("id", $category)
            ->orWhere("parent_id", $category)
            ->pluck("id")
            ->toArray();
    }

    public function show($item) {
        $item = Item::find($item);

        if (!$item)
            return $this->simpleResponseWithMessage(false, __("api.item.not-found"));

        if ($item->deleted == ItemDeleted::TRUE)
            return $this->simpleResponseWithMessage(false, __("api.item.deleted"));

        return $this->simpleResponse(new SingleItem($item));
    }

    public function newProduct(Request $request) {
        $items = self::getItems($request->input("vendor"));
        $items = self::getNewProductItems($items, $request->input("numberOfItems", 10));

        return $this->simpleResponse(ItemsCollection::collection($items));
    }

    public function topSell(Request $request) {
        $items = self::getItems($request->input("vendor"));
        $items = self::getTopSellItems($items, $request->input("numberOfItems", 10));

        return $this->simpleResponse(ItemsCollection::collection($items));
    }

    public function topRating(Request $request) {
        $items = self::getItems($request->input("vendor"));
        $items = self::getTopRatingItems($items, $request->input("numberOfItems", 10));

        return $this->simpleResponse(ItemsCollection::collection($items));
    }

    public function topDiscount(Request $request) {
        $items = self::getItems($request->input("vendor"));
        $items = self::getTopDiscountItems($items, $request->input("numberOfItems", 10));

        return $this->simpleResponse(ItemsCollection::collection($items));
    }

    public function topCollection(Request $request) {
        $numberOfItems = $request->input('numberOfItems', 10);
        $items = self::getItems($request->input("vendor"));

        return $this->simpleResponse(($items->isEmpty())
            ? null
            : [
                "new-product"  => ItemsCollection::collection(self::getNewProductItems($items, $numberOfItems)),
                "top-sell"     => ItemsCollection::collection(self::getTopSellItems($items, $numberOfItems)),
                "top-rating"   => ItemsCollection::collection(self::getTopRatingItems($items, $numberOfItems)),
                "top-discount" => ItemsCollection::collection(self::getTopDiscountItems($items, $numberOfItems))
            ]);
    }

    public function bestTopCollection(Request $request) {
        $numberOfItems = $request->input("numberOfItems", 2);
        $items = self::getItems($request->input("vendor"));
        $topItems = collect([
            self::getNewProductItems($items, $numberOfItems),
            self::getTopSellItems($items, $numberOfItems),
            self::getTopRatingItems($items, $numberOfItems),
            self::getTopDiscountItems($items, $numberOfItems)
        ])->collapse();

        return $this->simpleResponse(ItemsCollection::collection($topItems));
    }

    public static function getItems($vendor) {
        return ($vendor == 0)
            ? Item::where("deleted", ItemDeleted::FALSE)
                ->get()
            : Item::where("vendor_id", $vendor)
                ->where("deleted", ItemDeleted::FALSE)
                ->get();
    }

    public static function getNewProductItems($items, $numberOfItems) {
        return $items->sortByDesc("id")->take($numberOfItems);
    }

    public static function getTopSellItems($items, $numberOfItems) {
        $collection = new Collection();
        foreach($items as $item)
            $collection->push([
                "item"  => $item,
                "count" => $item->orders->count()
            ]);

        return $collection->sortByDesc("count")
            ->take($numberOfItems)
            ->pluck("item");
    }

    public static function getTopRatingItems($items, $numberOfItems) {
        $collection = new Collection();
        foreach($items as $item)
            $collection->push([
                "item"   => $item,
                "rating" => $item->rating()
            ]);

        return $collection->sortByDesc("rating")
            ->take($numberOfItems)
            ->pluck("item");
    }

    public static function getTopDiscountItems($items, $numberOfItems) {
        $collection = new Collection();
        foreach($items as $item)
            $collection->push([
                "item"         => $item,
                "discountRate" => $item->discountRate()
            ]);

        return $collection->sortByDesc("discountRate")
            ->take($numberOfItems)
            ->pluck("item");
    }
}
