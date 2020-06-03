<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemCollection;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Vendor;
use http\Env\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function index() {
        $result = DB::table('order_item')
            ->join('items', 'order_item.item_id', '=', 'items.id')
            ->select("order_item.*", "items.name as item_name", "items.quantity as item_quantity", "items.vendor_id as item_vendor")
            ->where('order_item.user_id', request()->input("user"))
            ->where('order_item.cart', 1)
            ->get()
            ->groupBy("item_vendor");

        $collection = new Collection();
        foreach ($result as $vendor_id => $order_items){
            $vendor = Vendor::find($vendor_id);
            $collection->push([
                'vendor'          => [
                    "id"   => $vendor->id,
                    "name" => $vendor->name,
                ],
                'total_items'     => $order_items->count(),
                'total_price_IQD' => $order_items->map(function ($order_item){
                    if ($order_item->currency == "IQD")
                        return $order_item->price * $order_item->quantity;
                })->sum(),
                'total_price_USD' => $order_items->map(function ($order_item){
                    if ($order_item->currency == "USD")
                        return $order_item->price * $order_item->quantity;
                })->sum(),
                'order_items'     => CartItemCollection::collection($order_items)
            ]);
        }

        return response()->json([
            "data"   => ($collection->isEmpty()) ? null : $collection,
            "status" => true,
            "error"  => null
        ]);
    }

    public function store() {
        $item = Item::where("id", request()->input("item_id"))
            ->where("deleted", 0)
            ->first();

        if (!$item)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.item.not-found")
            ]);


        $orderItem = OrderItem::updateOrCreate(
            [
                "user_id" => request()->input("user_id"),
                "item_id" => request()->input("item_id"),
                "cart"    => 1
            ],
            [
                "currency"   => request()->input("currency"),
                "price"      => request()->input("price"),
                "quantity"   => request()->input("quantity"),
                "order_id"   => null,
                "created_at" => date("Y-m-d")
            ]
        );

        if (!$orderItem)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.order-item.stored-failed")
            ]);

        return response()->json([
            "data"   => null,
            "status" => true,
            "error"  => null
        ]);
    }

    public function delete() {
        $orderItem = OrderItem::find(request()->input("id"));

        if (!$orderItem)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.order-item.not-found")
            ]);

        if (!$orderItem->delete())
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.order-item.delete-failed")
            ]);

        return response()->json([
            "data"   => null,
            "status" => true,
            "error"  => null
        ]);
    }
}
