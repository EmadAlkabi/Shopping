<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function store() {
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
                "message" => [
                    "ar" => "لم تتم الاضافة",
                    "en" => "Not added"
                ],
            ]);

        return response()->json([
            "data"   => null,
            "status" => true,
            "message" => [
                "ar" => "تمت الاضافة",
                "en" => "Added"
            ]
        ]);
    }

    public function delete() {
        $orderItem = OrderItem::find(request()->input("id"));

        if (!$orderItem)
            return response()->json([
                "data"   => null,
                "status" => false,
                "message" => [
                    "ar" => "غير موجود",
                    "en" => "Not found"
                ],
            ]);

        return response()->json([
            "data"   => null,
            "status" => true,
            "message" => [
                "ar" => "تم الحذف",
                "en" => "Deleted"
            ]
        ]);
    }
}
