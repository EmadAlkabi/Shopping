@if(!$item)
    @php $color = "danger" @endphp
    @php $message =  __("dashboard/item.components.modal-change-deleted.error-message") @endphp
@elseif($item->deleted == \App\Enum\ItemDeleted::FALSE)
    @php $color = "success" @endphp
    @php $message =  __("dashboard/item.components.modal-change-deleted.disable-message", ["number" => $item->id]) @endphp
    @php $deleted = \App\Enum\ItemDeleted::TRUE @endphp
@else
    @php $color = "danger" @endphp
    @php $message =  __("dashboard/item.components.modal-change-deleted.active-message", ["number" => $item->id]) @endphp
    @php $deleted = \App\Enum\ItemDeleted::FALSE @endphp
@endif
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-{{$color}}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading text-capitalize">
                    @lang("dashboard/item.components.modal-change-deleted.header")
                </p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center p-4">
                            <div class="h5-responsive">
                                {{$message}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($item)
                <div class="modal-footer justify-content-center">
                    <a class="btn btn-{{$color}}" type="button"  onclick="$('#change-deleted').submit();">
                        @lang("dashboard/item.components.modal-change-deleted.btn-yes")
                    </a>
                    <form id="change-deleted" class="d-none" method="post" action="/dashboard/items/change-deleted">
                        @csrf()
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="deleted" value="{{$deleted}}">
                    </form>
                    <a class="btn btn-outline-{{$color}}" type="button" data-dismiss="modal">
                        @lang("dashboard/item.components.modal-change-deleted.btn-no")
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
