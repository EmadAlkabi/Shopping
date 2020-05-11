@extends("dashboard.layout.app")

@section("title", __("dashboard/item.index.title"))

@section("head")
    @include("dashboard.layout.head.datatable")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include("dashboard.item.components.datatable", ["q" => $q, "items" => $items])
            </div>
        </div>
    </div>
@endsection
