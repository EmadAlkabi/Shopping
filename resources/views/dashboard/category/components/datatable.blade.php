<table class="table table-hover text-center w-100 table-responsive-xl" id="categories">
    <thead class="blue-gray-darken-4 text-white">
    <tr>
        <th rowspan="2">
            @lang("dashboard/category.components.datatable.column.number")
        </th>
        <th colspan="2" class="align-middle text-capitalize">
            @lang("dashboard/category.components.datatable.header-$filter")
        </th>
        <th colspan="1">
            <a class="btn btn-flat waves-effect waves-light" type="button" href="{{ route("dashboard.categories.create") }}">
                <i class="fa fa-plus light-green-text mx-1"></i>
                @lang("dashboard/category.components.datatable.btn-add")
            </a>
        </th>
    </tr>
    <tr>
        <th class="th-sm">@lang("dashboard/category.components.datatable.column.name")</th>
        <th class="th-sm">@lang("dashboard/category.components.datatable.column.parent")</th>
        <th class="th-sm">---</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td class="align-middle">{{ $category->id }}</td>
            <td class="align-middle">
                {{ $category->name }}
            </td>
            <td class="align-middle">
               {{ $category->parent()->name ?? "---" }}
            </td>
            <td class="align-middle">
                <a class="btn-floating btn-sm primary-color mx-2" href="{{route("dashboard.categories.edit",["category" => $category->id])}}" target="_blank">
                    <i class="far fa-edit"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section("script")
    @parent
    <script>
        $('#categories').DataTable( {
            order: [],
            columnDefs: [{targets: [3], orderable: false}],
            @if(app()->getLocale() == App\Enum\Language::ARABIC)
            language: {url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json'},
            @endif
        } );

        @if(session()->has("message"))
        $.toast({
            title: '{{session()->get("message")}}',
            type:  '{{session()->get("type")}}',
            delay: 2500
        });
        @endif
    </script>
@endsection

