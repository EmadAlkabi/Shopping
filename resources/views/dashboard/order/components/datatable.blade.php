<table class="table table-hover text-center w-100 table-responsive-xl" id="orders">
    <thead class="blue-gray-darken-4 text-white">
    <tr>
        <th rowspan="2">
            @lang("dashboard/order.components.datatable.column.number")
        </th>
        <th colspan="3" class="align-middle text-capitalize">
            @lang("dashboard/order.components.datatable.header")
        </th>
    </tr>
    <tr>
        <th class="th-sm">@lang("dashboard/order.components.datatable.column.user")</th>
        <th class="th-sm">@lang("dashboard/order.components.datatable.column.request-at")</th>
        <th class="th-sm">---</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr data-content="{{$order->id}}">
            <td class="align-middle">{{$order->id}}</td>
            <td class="align-middle">
                {{$order->user->name}}
            </td>
            <td class="align-middle">
                {{$order->request_at}}
            </td>
            <td class="align-middle">
                <div class="d-flex justify-content-center">
                    <a class="btn-floating btn-sm info-color mx-2" data-action="btn-show">
                        <i class="far fa-eye"></i>
                    </a>

                    <a class="btn-floating btn-sm secondary-color mx-2">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section("extra-content")
    @parent
    <div id="modal-show"></div>
@endsection

@section("script")
    @parent
    <script>
        $('#orders').DataTable( {
            order: [],
            columnDefs: [{targets: [3], orderable: false}],
            @if(app()->getLocale() == App\Enum\Language::ARABIC)
            language: {url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json'},
            @endif
        } );
        $('[data-action="btn-show"]').on('click', function () {
            let order = $(this).parent().parent().parent().data('content');
            $.ajax({
                type: 'get',
                url: '/dashboard/orders/' + order,
                datatype: 'json',
                encode: true,
                success: function(response) {
                    $('#modal-show').html(response.data.html)
                },
                error: function() {
                } ,
                complete : function() {
                    $('#modal-show .modal').modal('show');
                }
            });
        });

        function action(id, order, user, state) {
            let btn = document.getElementById(id);
            btn.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div>';

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '/dashboard/orders/'+ order,
                data: {_method: "PUT", order: order, user:user, state: state},
                datatype: 'json',
                encode: true,
                success: function(response) {
                    if (response.status === false) {
                        btn.parent().find(".text-danger").html(response.message);
                    } else {
                        $.toast({
                            title: response.message.title,
                            type:  response.message.type,
                            delay: 2500
                        });
                        if (state === 2)
                            $('[data-content="' + order + '"]').addClass("success-ic");
                        else
                            $('[data-content="' + order + '"]').addClass("danger-ic");
                    }
                },
                error: function() {

                } ,
                complete : function() {
                    $('#modal-show .modal').modal('hide');
                }
            });
        }
    </script>
@endsection

