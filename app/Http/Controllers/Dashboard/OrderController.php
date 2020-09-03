<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\ItemDeleted;
use App\Enum\Language;
use App\Enum\OrderState;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            "state" => ["required", Rule::in(array(OrderState::ACCEPT, OrderState::REJECT))]
        ];
        $messages = (app()->getLocale() == Language::ENGLISH)
            ? ["state.required" => "Select state required.",
                "state.in"      => "State invalid."]
            : ["state.required" => "يرجى اختيار الحالة.",
                "state.in"      => "الحالة غير مقبولة."];

        $validation = Validator::make($request->all(), $rules, $messages);

        if (!$validation->passes())
            return $this->responseWithMessage(false, $validation->errors());

        $state = $request->input("state");
        $order = Order::where("id", $request->input("order"))
            ->update(["state" => $state]);

        if (!$order)
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
