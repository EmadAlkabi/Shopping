@extends("dashboard.layout.app")

@section("title", __("dashboard/category.index.title"))

@section("head")
    @include("dashboard.layout.head.datatable")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <a class="text-dark text-capitalize mb-1" type="button" data-toggle="collapse" href="#collapse-category-filter" aria-expanded="false" aria-controls="#collapse-category-filter">
                    <i class="fa fa-filter"></i>
                    @lang("dashboard/category.index.filter.header")
                </a>
                <div class="collapse" id="collapse-category-filter">
                    <a class="badge blue-gray p-2 m-1" href="{{route("dashboard.categories.index", ["filter" => "all"])}}">
                        @lang("dashboard/category.index.filter.all")
                    </a>
                    <a class="badge blue-gray p-2 m-1" href="{{route("dashboard.categories.index", ["filter" => "main"])}}">
                        @lang("dashboard/category.index.filter.main")
                    </a>
                    <a class="badge blue-gray p-2 m-1" href="{{route("dashboard.categories.index", ["filter" => "sub"])}}">
                        @lang("dashboard/category.index.filter.sub")
                    </a>
                </div>
            </div>

            <div class="col-12">
                @include("dashboard.category.components.datatable", ["filter" => $filter, "categories" => $categories])
            </div>
        </div>
    </div>
@endsection
