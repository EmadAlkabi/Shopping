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
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->last_login ?? "---"}}</td>
            <td>
                <div class="d-flex justify-content-center" data-content="{{$user->id}}">
                    <a class="btn-floating btn-sm secondary-color mx-2" data-action="btn-show">
                        <i class="far fa-address-card"></i>
                    </a>
                    <a class="btn-floating btn-sm info-color mx-2" href="{{route("dashboard.admin.users.show",["user" => $user->id])}}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a class="btn-floating btn-sm primary-color mx-2" href="{{route("dashboard.admin.users.edit",["user" => $user->id])}}">
                        <i class="far fa-edit"></i>
                    </a>
                    @if($user->state == \App\Enum\UserState::UNTRUSTED)
                        <a class="btn-floating Warning-color btn-sm mx-2" data-action="btn-change-state">
                            <i class="fas fa-user"></i>
                            {{$user->state}}
                        </a>
                    @elseif($user->state == \App\Enum\UserState::TRUSTED)
                        <a class="btn-floating btn-sm success-color mx-2" data-action="btn-change-state">
                            <i class="fas fa-user-check"></i>
                            {{$user->state}}
                        </a>
                    @else
                        <a class="btn-floating btn-sm danger-color mx-2" data-action="btn-change-state">
                            <i class="fas fa-user-times"></i>
                            {{$user->state}}
                        </a>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>













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

@section('script')
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

