<?php

namespace App\Http\Controllers\Api;

use App\Enum\OrderState;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersCollection;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index() {
        switch (request()->input("state")) {
            case OrderState::REVIEW:
                $orders = Order::where("user_id", request()->input("user"))
                    ->where("state", OrderState::REVIEW)
                    ->orderBy("request_at", "DESC")
                    ->get();
                break;
            case OrderState::ACCEPT:
                $orders = Order::where("user_id", request()->input("user"))
                    ->where("state", OrderState::ACCEPT)
                    ->orderBy("response_at", "DESC")
                    ->get();
                break;
            case OrderState::REJECT:
                $orders = Order::where("user_id", request()->input("user"))
                    ->where("state", OrderState::REJECT)
                    ->orderBy("response_at", "DESC")
                    ->get();
                break;
            default:
                $orders = Order::where("user_id", request()->input("user"))
                    ->orderBy("request_at", "DESC")
                    ->get();
        }

        $orders = $orders->chunk(10);
        $pages = $orders->count();
        $page = (integer)request()->input('page', 1);

        if (!$orders->isEmpty() && ($page < 1 || $page > $pages))
            return response()->json([
                "data"         => null,
                "current-page" => $page,
                "max-page"     => $pages,
                "status"       => false,
                "error"        => __("api.order.out-range"),
            ]);

        return response()->json([
            "data"         => $orders->isEmpty()
                ? null
                : OrdersCollection::collection($orders[$page-1]),
            "current-page" => $page,
            "max-page"     => $pages,
            "status"       => true,
            "error"        => null
        ]);
    }

    public function store() {
        $vendor = Vendor::find(request()->input("vendor"));
        if (!$vendor)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.vendor.not-found")
            ]);

        $orderItems = OrderItem::where("user_id", request()->input("user"))
            ->whereIn("item_id", $vendor->items->pluck("id")->toArray())
            ->where("cart" , 1)
            ->get();

        $exception = null;
        if (!$orderItems->isEmpty())
            $exception = DB::transaction(function () use ($orderItems) {
                $order = Order::create([
                    "user_id"            => request()->input("user"),
                    "vendor_id"          => request()->input("vendor"),
                    "state"              => OrderState::REVIEW,
                    "total_price_dollar" => request()->input("total_price_dollar"),
                    "total_price_dinar"  => request()->input("total_price_dinar"),
                    "request_at"         => date("Y-m-d"),
                    "response_at"        => null
                ]);
                foreach ($orderItems  as $orderItem) {
                    $orderItem->order_id = $order->id;
                    $orderItem->cart = 0;
                    $orderItem->save();
                }
            });

        if (!is_null($exception))
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => __("api.order.stored-failed")
            ]);

        return response()->json([
            "data"   => null,
            "status" => true,
            "error"  => null
        ]);
    }
}
