@extends("dashboard.layout.app")

@section("title", __("dashboard/category.index.title"))

@section("head")
    @include("dashboard.layout.head.datatable")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include("dashboard.category.components.datatable", ["categories" => $categories])
            </div>
        </div>
    </div>
@endsection
