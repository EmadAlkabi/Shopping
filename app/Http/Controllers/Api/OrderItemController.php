<?php

namespace App\Http\Controllers\Api;

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
        $result = DB::table('order_item')
            ->join('items', 'order_item.item_id', '=', 'items.id')
            ->select("order_item.*", "items.name as item_name", "items.currency as item_currency", "items.vendor_id as item_vendor")
            ->where('order_item.user_id', request()->input("user"))
            ->where('order_item.cart', 1)
            ->get()
            ->groupBy("item_vendor");

        $collection = new Collection();
        foreach ($result as $vendor_id => $order_items){
            $vendor = Vendor::find($vendor_id);
            $collection->push([
                'vendor'          => new SingleVendor($vendor),
                'total_items'     => $order_items->count(),
                'total_price_IQD' => $order_items->map(function ($order_item){
                    if ($order_item->item_currency == "IQD")
                        return $order_item->price * $order_item->quantity;
                })->sum(),
                'total_price_USD' => $order_items->map(function ($order_item){
                    if ($order_item->item_currency == "USD")
                        return $order_item->price * $order_item->quantity;
                })->sum(),
                'order_items'     => CartItemCollection::collection($order_items)
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
            ->where("deleted", 0)
            ->first();

        if (!$item)
            return $this->simpleResponseWithMessage(false, "item not found");

        $unit = $item->units
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
