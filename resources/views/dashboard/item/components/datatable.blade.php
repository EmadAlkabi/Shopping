<table class="table table-sm table-hover table-responsive-xl w-100 btn-table" id="items">
    <thead class="blue-gray-darken-4 text-white">
    <tr>
        <th rowspan="2" class="align-bottom">
            @lang("dashboard/item.column.id")
        </th>
        <th colspan="6" class="align-middle text-center text-capitalize">
            @lang("dashboard/item.components.datatable.title-$q")
        </th>
        <th colspan="1" class="text-center">
            <a class="btn btn-link text-decoration-none text-white" type="button" href="{{route("dashboard.items.create")}}">
                <i class="fa fa-plus light-green-text mx-1"></i>
                @lang("dashboard/item.components.datatable.btn-add")
            </a>
        </th>
    </tr>
    <tr>
        <th>@lang("dashboard/item.column.name")</th>
        <th>@lang("dashboard/item.column.barcode")</th>
        <th>@lang("dashboard/item.column.code")</th>
        <th>@lang("dashboard/item.column.price")</th>
        <th>@lang("dashboard/item.column.quantity")</th>
        <th>@lang("dashboard/item.column.category_id")</th>
        <th class="text-center"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->barcode}}</td>
            <td>{{$item->code}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->category->name ?? ''}}</td>
            <td class="text-center" data-content="{{$item->id}}">
                <a class="btn btn-outline-secondary btn-sm m-2" href="{{route("dashboard.items.show", ["item" => $item->id])}}">
                    <i class="far fa-eye"></i>
                </a>
                <a class="btn btn-outline-primary btn-sm m-2" href="{{route("dashboard.items.edit", ["item" => $item->id])}}">
                    <i class="far fa-edit"></i>
                </a>
                <a class="btn btn-outline-danger btn-sm m-2" data-action="btn-modal-delete">
                    <i class="far fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section("extra-content")
    @parent
    <div id="extra"></div>
@endsection

@section('script')
    @parent
    <script>
        $(document).ready( function () {
            $('#items').DataTable( {
                columnDefs: [{
                    targets: [7],
                    orderable: false
                }],
                @if(app()->getLocale() == App\Enum\Language::ARABIC)
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json"
                },
                @endif
            } );
        } );
    </script>
@endsection

