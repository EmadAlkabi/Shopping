<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\Language;
use App\Enum\OrderState;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class OrderController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = Order::where([
            "vendor_id" => 1,
            "state" => OrderState::REVIEW
        ])->get();

        return view("dashboard.order.index")->with([
            "orders" => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        abort(404);
    }


    /**
     * * Display the specified resource.
     *
     * @param $order
     * @return JsonResponse
     * @throws Throwable
     */
    public function show($order)
    {
        $order = Order::find($order);
        $view = view("dashboard.order.components.modal-show", compact("order"))->render();
        return $this->response(["html" => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     */
    public function edit(Order $order)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $order
     * @return JsonResponse
     */
    public function update(Request $request, $order)
    {
        $order = Order::where([
            "id"      => $order,
            "user_id" => $request->input("user"),
            "state"   => OrderState::REVIEW
        ])->first();

        if (!$order)
            return $this->responseWithMessage(false, "Order not found");

        $state = $request->input("state");
        if (!in_array($state, array(OrderState::ACCEPT, OrderState::REJECT)))
            return $this->responseWithMessage(false, "State not valid");

        $order->state = $state;
        $success = $order->save();

        if (!$success)
            return $this->responseWithMessage(true, [
                "title" => __("dashboard/order.update.failed-$state"),
                "type"  => "error"
            ]);

        return $this->responseWithMessage(true, [
            "title" => __("dashboard/order.update.success-$state"),
            "type"  => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     */
    public function destroy(Order $order)
    {
        abort(404);
    }
}
