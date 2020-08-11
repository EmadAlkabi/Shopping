<?php

namespace App\Http\Controllers\Api;

use App\Enum\Currency;
use App\Enum\ItemDeleted;
use App\Enum\UserState;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemCollection;
use App\Http\Resources\Vendor\SingleVendor;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Vendor;
use http\Env\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    use ResponseTrait;

    public function myCart() {
        $result = DB::table("order_item")
            ->join("items",  "items.id", "=" ,"order_item.item_id")
            ->join("units", "units.id", "=", "order_item.unit_id")
            ->select("items.id as item_id", "items.vendor_id as item_vendor", "items.name as item_name", "items.currency as item_currency",
            "units.name as unit_name", "units.quantity as unit_quantity", "units.price as unit_price",
            "order_item.id as order_item_id", "order_item.quantity as order_item_quantity")
            ->where('order_item.user_id', request()->input("user"))
            ->where('order_item.cart', 1)
            ->get()
            ->groupBy("item_vendor");

        $collection = new Collection();
        foreach ($result as $vendor => $items){
            $collection->push([
                "vendor"          => new SingleVendor(Vendor::find($vendor)),
                "total_items"     => $items->count(),
                "total_price_IQD" => $items->map(function ($item){
                    if ($item->item_currency == Currency::IQD)
                        return $item->unit_price * $item->order_item_quantity;
                })->sum(),
                "total_price_USD" => $items->map(function ($item){
                    if ($item->item_currency == Currency::USD)
                        return $item->unit_price * $item->order_item_quantity;
                })->sum(),
                "order_items"     => CartItemCollection::collection($items)
            ]);
        }

        return $this->simpleResponse(($collection->isEmpty())
            ? null
            : $collection
        );
    }

    public function createOrUpdate() {
        $user = User::find(request()->input("user"));

        if (!$user)
            return $this->simpleResponseWithMessage(false, "user not found");

        if ($user->state == UserState::INACTIVE)
            return $this->simpleResponseWithMessage(false, "user is blocked");

        $item = Item::where("id", request()->input("item"))
            ->where("deleted", ItemDeleted::FALSE)
            ->first();

        if (!$item)
            return $this->simpleResponseWithMessage(false, "item not found");

        $unit = $item->units()
            ->where("id", request()->input("unit"))
            ->first();

        if (!$unit)
            return $this->simpleResponseWithMessage(false, "unit not found");

        $orderItem = OrderItem::updateOrCreate([
            "user_id"  => $user->id,
            "item_id"  => $item->id,
            "unit_id"  => $unit->id,
            "cart"     => 1
        ], [
            "price"    => null,
            "quantity" => 1,
            "order_id" => null
        ]);

        if (!$orderItem)
            return $this->simpleResponseWithMessage(false, "try again");

        return $this->simpleResponseWithMessage(true, "success");
    }

    public function delete($orderItem) {
        $orderItem = OrderItem::find($orderItem);

        if (!$orderItem)
            return $this->simpleResponseWithMessage(false, "order item not found");

        if (!$orderItem->delete())
            return $this->simpleResponseWithMessage(false, "try again");

        return $this->simpleResponseWithMessage(true, "success");
    }
}
