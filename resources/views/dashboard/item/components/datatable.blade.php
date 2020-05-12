<table class="table table-hover text-center w-100 table-responsive-xl" id="items">
    <thead class="blue-gray-darken-4 text-white">
    <tr>
        <th rowspan="2">
            @lang("dashboard/item.components.datatable.column.number")
        </th>
        <th colspan="5" class="align-middle text-capitalize">
            @lang("dashboard/item.components.datatable.title-$q")
        </th>
        <th colspan="1">
            <a class="btn btn-flat waves-effect waves-light" type="button" href="{{route("dashboard.items.create")}}">
                <i class="fa fa-plus light-green-text mx-1"></i>
                @lang("dashboard/item.components.datatable.btn-add")
            </a>
        </th>
    </tr>
    <tr>
        <th class="th-sm">@lang("dashboard/item.components.datatable.column.name")</th>
        <th class="th-sm">@lang("dashboard/item.components.datatable.column.barcode")</th>
        <th class="th-sm">@lang("dashboard/item.components.datatable.column.code")</th>
        <th class="th-sm">@lang("dashboard/item.components.datatable.column.price")</th>
        <th class="th-sm">@lang("dashboard/item.components.datatable.column.quantity")</th>
        <th class="th-sm"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->barcode}}</td>
            <td>{{$item->code}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->quantity}}</td>
            <td>
                <div class="d-flex justify-content-center" data-content="{{$item->id}}">
                    <a class="btn-floating btn-sm secondary-color mx-2" data-action="btn-show">
                        <i class="far fa-address-card"></i>
                    </a>
                    <a class="btn-floating btn-sm info-color mx-2" href="{{route("dashboard.items.show",["item" => $item->id])}}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a class="btn-floating btn-sm primary-color mx-2" href="{{route("dashboard.items.edit",["item" => $item->id])}}">
                        <i class="far fa-edit"></i>
                    </a>
                    @if($item->deleted == 0)
                        <a class="btn-floating success-color btn-sm mx-2" data-action="btn-change-state">
                            <i class="fas fa-check"></i>
                        </a>
                    @else
                        <a class="btn-floating btn-sm danger-color mx-2" data-action="btn-change-state">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section("script")
    @parent
    <script>
        $('#items').DataTable( {
            order: [],
            columnDefs: [{targets: [6], orderable: false}],
            @if(app()->getLocale() == App\Enum\Language::ARABIC)
            language: {url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json'},
            @endif
        } );
    </script>
@endsection

