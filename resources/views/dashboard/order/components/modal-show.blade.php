<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify" role="document">
        <div class="modal-content">
            <div class="modal-header info-color text-white">
                <p class="heading text-capitalize">
                    @lang("dashboard/order.components.modal-show.main-header")
                </p>
            </div>
            <div class="modal-body">
                @if($order)
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <p>
                                        <strong>@lang("dashboard/order.components.modal-show.label.number"): </strong>
                                        <span>{{$order->id}}</span>
                                    </p>
                                    <p>
                                        <strong>@lang("dashboard/order.components.modal-show.label.state"): </strong>
                                        <span>{{\App\Enum\OrderState::getStateName($order->state)}}</span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        <strong>@lang("dashboard/order.components.modal-show.label.user.name"): </strong>
                                        <span>{{$order->user->name}}</span>
                                    </p>
                                    <p>
                                        <strong>@lang("dashboard/order.components.modal-show.label.user.phone"): </strong>
                                        <span>{{$order->user->phone}}</span>
                                    </p>
                                </div>
                            </div>
                            <p>
                                <strong>@lang("dashboard/order.components.modal-show.label.user.address"): </strong>
                                <span>{{$order->user->address_1 . $order->user->address_2}}</span>
                            </p>
                        </div>
                        <div class="col-12">
                            <table class="table table-sm table-hover text-center">
                                <thead class="blue-gray-darken-4 text-white">
                                <tr>
                                    <th colspan="4" class="align-middle text-capitalize">
                                        @lang("dashboard/order.components.modal-show.header")
                                    </th>
                                </tr>
                                <tr>
                                    <th class="th-sm">@lang("dashboard/order.components.modal-show.column.item")</th>
                                    <th class="th-sm">@lang("dashboard/order.components.modal-show.column.price")</th>
                                    <th class="th-sm">@lang("dashboard/order.components.modal-show.column.quantity")</th>
                                    <th class="th-sm">@lang("dashboard/order.components.modal-show.column.total")</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $totalIQD = 0; $totalUSD =0; @endphp
                                @foreach($order->orderItems as $orderItem)
                                    @php $item = $orderItem->item; @endphp

                                    <tr>
                                        <td class="align-middle">{{$item->name}}</td>
                                        <td class="align-middle">
                                            <span>{{$orderItem->price}}</span>
                                            <strong>{{$item->currency}}</strong>
                                        </td>
                                        <td class="align-middle">
                                            <span>{{$orderItem->quantity}}</span>
                                            <strong>{{$orderItem->unit->name}}</strong>
                                        </td>
                                        <td class="align-middle">{{ $orderItem->price * $orderItem->quantity }}</td>
                                    </tr>

                                    @if($item->currency == \App\Enum\Currency::IQD)
                                        @php $totalIQD += ($orderItem->price * $orderItem->quantity); @endphp
                                    @else
                                        @php $totalUSD += ($orderItem->price * $orderItem->quantity); @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <td class="font-weight-bold" colspan="2">
                                        @lang("dashboard/order.components.modal-show.column.total-IQD")
                                    </td>
                                    <td class="font-weight-bold" colspan="2">
                                        {{ $totalIQD }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" colspan="2">
                                        @lang("dashboard/order.components.modal-show.column.total-USD")
                                    </td>
                                    <td class="font-weight-bold" colspan="2">
                                        {{ $totalUSD }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 d-flex justify-content-between text-center">
                            <p class="mb-0">
                                <strong>@lang("dashboard/order.components.modal-show.label.request_at")</strong>
                                <br>
                                <span>{{ $order->request_at }}</span>
                            </p>

                            <p class="mb-0">
                                <strong>@lang("dashboard/order.components.modal-show.label.response_at")</strong>
                                <br>
                                <span>{{ $order->response_at }}</span>
                            </p>
                        </div>
                        <div class="col-12 text-center">
                            <div class="text-danger text-center" id="error"></div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center p-4">
                                <div class="h5-responsive">
                                    @lang("dashboard/order.components.modal-show.error-message")
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if($order)
                <div class="modal-footer justify-content-center">
                    @if($order->state == \App\Enum\OrderState::REVIEW)
                        <button class="btn btn-success" id="btn-accept" onclick="action('btn-accept', {{$order->id}}, {{$order->user_id}}, {{\App\Enum\OrderState::ACCEPT}})">
                            <div class="spinner-border spinner-border-sm d-none" role="status"></div>
                            <div class="content">
                                <i class="fas fa-check"></i>
                                @lang("dashboard/order.components.modal-show.btn-accept")
                            </div>
                        </button>
                        <button class="btn btn-danger" id="btn-reject" onclick="action('btn-reject', {{$order->id}}, {{$order->user_id}}, {{\App\Enum\OrderState::REJECT}})">
                            <div class="spinner-border spinner-border-sm d-none" role="status"></div>
                            <div class="content">
                                <i class="fas fa-times"></i>
                                @lang("dashboard/order.components.modal-show.btn-reject")
                            </div>
                        </button>
                    @elseif($order->state == \App\Enum\OrderState::ACCEPT)
                        <div class="w-100 alert alert-success text-center">
                            @lang("dashboard/order.components.modal-show.accept-message")
                        </div>
                    @else
                        <div class="w-100 alert alert-danger text-center">
                            @lang("dashboard/order.components.modal-show.reject-message")
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
