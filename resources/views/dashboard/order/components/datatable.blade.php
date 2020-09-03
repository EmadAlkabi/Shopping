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
        <tr>
            <td class="align-middle">{{$order->id}}</td>
            <td class="align-middle">
                {{$order->user->name}}
            </td>
            <td class="align-middle">
                {{$order->request_at}}
            </td>
            <td class="align-middle">
                <div class="form-inline">
                    <input type="hidden" name="order" value="{{ $order->id }}">
                    <div class="dropdown">
                        <input type="text" class="form-control" value="" autocomplete="off"
                               placeholder="@lang("dashboard/order.placeholder.state")"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <input type="hidden" name="state" value="">
                        <div class="text-warning"></div>
                        <div class="dropdown-menu dropdown-default w-100" data-action="state">
                            <div class="dropdown-item" data-value="{{ \App\Enum\OrderState::ACCEPT }}">
                                {{ \App\Enum\OrderState::getStateName(\App\Enum\OrderState::ACCEPT) }}
                            </div>
                            <div class="dropdown-item" data-value="{{ \App\Enum\OrderState::REJECT }}">
                                {{ \App\Enum\OrderState::getStateName(\App\Enum\OrderState::REJECT) }}
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-outline-primary" data-action="update">
                        <span class="fa fa-paper-plane"></span>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

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
        $('[data-action="state"] .dropdown-item').on('click', function () {
            $(this).parent().parent().find('input[type="text"]').val($(this).html().trim());
            $(this).parent().parent().find('input[name="state"]').val($(this).data('value'));
        });

        $('button[data-action="update"]').on('click', function () {
            let method = "PUT";
            let order = $(this).parent().find('input[name="order"]').val();
            let state = $(this).parent().find('input[name="state"]').val();
            let btn = $(this);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '/dashboard/orders/'+ order +'/update',
                data: {_method: method, order: order, state: state},
                datatype: 'json',
                encode: true,
                success: function(response) {
                    if (response.status === false) {
                        btn.parent().find(".text-warning").html(response.message.state);
                    } else {
                        console.log(response)
                        return ;
                        btn.parent().parent().parent().hide();
                        $.toast({
                            title: response.message.title,
                            type:  response.message.type,
                            delay: 2500
                        });
                    }
                },
                error: function() {

                } ,
                complete : function() {

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

