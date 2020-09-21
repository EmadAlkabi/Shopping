@extends("dashboard.layout.app")

@section("title", __("dashboard/order.index.title"))

@section("head")
    @include("dashboard.layout.head.datatable")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @include("dashboard.order.components.datatable", ["filter" => $filter, "orders" => $orders])
            </div>
        </div>
    </div>
@endsection
