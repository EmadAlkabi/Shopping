<?php

namespace App\Http\Controllers\Api;

use App\Enum\OrderState;
use App\Enum\UserState;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersCollection;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ResponseTrait;

    public function myOrders() {
        switch (request()->input("state")) {
            case OrderState::REVIEW:
                $orders = Order::where("user_id", request()->input("user"))
                    ->where("state", OrderState::REVIEW)
                    ->orderBy("request_at", "DESC")
                    ->paginate(10);
                break;
            case OrderState::ACCEPT:
                $orders = Order::where("user_id", request()->input("user"))
                    ->where("state", OrderState::ACCEPT)
                    ->orderBy("response_at", "DESC")
                    ->paginate(10);
                break;
            case OrderState::REJECT:
                $orders = Order::where("user_id", request()->input("user"))
                    ->where("state", OrderState::REJECT)
                    ->orderBy("response_at", "DESC")
                    ->paginate(10);
                break;
            default:
                $orders = Order::where("user_id", request()->input("user"))
                    ->orderBy("request_at", "DESC")
                    ->paginate(10);
        }

        OrdersCollection::collection($orders);

        return $this->paginateResponse($orders);
    }

    public function store() {
        $vendor = Vendor::find(request()->input("vendor"));

        if (!$vendor)
            return $this->simpleResponseWithMessage(false, "vendor not found");

        $user = User::find(request()->input("user"));

        if (!$user)
            return $this->simpleResponseWithMessage(false, "user not found");

        if ($user->state == UserState::INACTIVE)
            return $this->simpleResponseWithMessage(false, "user is blocked");

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
                    "state"              => OrderState::REVIEW
                ]);

                foreach ($orderItems  as $orderItem) {
                    $orderItem->price = $orderItem->unit->price - 0;
                    $orderItem->cart = 0;
                    $orderItem->order_id = $order->id;
                    $orderItem->save();
                }
            });

        if (!is_null($exception))
            return $this->simpleResponseWithMessage(false, "try again");

        return $this->simpleResponseWithMessage(true, "success");
    }
}
