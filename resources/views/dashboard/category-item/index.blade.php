@extends("dashboard.layout.app")

@section("title", __("dashboard/category-item.index.title"))

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="list-group" style="height: 500px; overflow-y: scroll;">
                    @foreach($items as $item)
                        <div class="list-group-item list-group-item-action">{{$item->name}}</div>
                    @endforeach
                </div>
            </div>

            <div class="col-6">
                @include("dashboard.category.components.datatable", ["categories" => $categories])
            </div>
        </div>
    </div>
@endsection
