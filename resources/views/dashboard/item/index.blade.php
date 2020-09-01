@extends("dashboard.layout.app")

@section("title", __("dashboard/item.index.title"))

@section("head")
    @include("dashboard.layout.head.datatable")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 mb-4">
                <a class="text-dark text-capitalize mb-1" type="button" data-toggle="collapse" href="#collapse-document-type-filter" aria-expanded="false" aria-controls="collapse-document-type-filter">
                    <i class="fa fa-filter"></i>
                    {{ $categories->filter(function ($category) use ($c) {return $category->id == $c;})->first()->name ?? __("dashboard/item.index.filter") }}
                </a>
                <div class="collapse" id="collapse-document-type-filter">
                    <a class="badge blue-gray p-2 m-1" href="{{ route("dashboard.items.index", ["f" => $f]) }}">
                        <i class="fa fa-star"></i>
                    </a>
                    @foreach($categories as $category)
                        <a class="badge blue-gray p-2 m-1" href="{{ route("dashboard.items.index", ["f" => $f, "c" => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-12">
                @include("dashboard.item.components.datatable", ["f" => $f, "items" => $items])
            </div>
        </div>
    </div>
@endsection
