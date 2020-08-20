<table class="table table-hover text-center w-100 table-responsive-xl" id="categories">
    <thead class="blue-gray-darken-4 text-white">
    <tr>
        <th rowspan="2">
            @lang("dashboard/category.components.datatable.column.number")
        </th>
        <th colspan="2" class="align-middle text-capitalize">
            @lang("dashboard/category.components.datatable.header")
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
                <a href="{{ route("dashboard.categories.show", ["category" => $category->id]) }}" target="_blank">
                    {{ $category->name }}
                </a>
            </td>
            <td class="align-middle">
               {{ $category->parent()->name ?? "---" }}
            </td>
            <td class="align-middle">
                ----
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section("extra-content")
    @parent
    <div id="modal-change-deleted"></div>
@endsection

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


        $('[data-action="btn-change-deleted"]').on('click', function () {
            let item = $(this).parent().data('content');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '/dashboard/api/items/change-deleted',
                data: {item: item},
                datatype: 'json',
                encode: true,
                success: function(result) {
                    $('#modal-change-deleted').html(result.data.html)
                },
                error: function() {
                    console.log('error');
                } ,
                complete : function() {
                    $('#modal-change-deleted .modal').modal('show');
                }
            });
        });
        @if(session()->has("message"))
        $.toast({
            title: '{{session()->get("message")}}',
            type:  '{{session()->get("type")}}',
            delay: 2500
        });
        @endif
    </script>
@endsection

