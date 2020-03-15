@extends("dashboard.layout.app")

@section("title")
    @lang("dashboard/item.index.title-$q")
@endsection

@section("style")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include("dashboard.item.components.datatable", ["items" => $items, "q" => $q])
            </div>
        </div>
    </div>
@endsection

@section("extra-content")
@endsection

@section("script")
@endsection
