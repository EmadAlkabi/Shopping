@extends("dashboard.layout.app")

@section("title", __("dashboard/classify-items.index.title"))

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="h5-responsive text-center">@lang("dashboard/classify-items.index.header-1")</div>
                <div class="list-group overflow-auto scrollbar-blue-gray thin" style="height: 400px;" id="old-list">
                    @foreach($items as $item)
                        <div class="list-group-item d-flex justify-content-between" data-content="{{ $item->id }}">
                            <span class="d-inline-block text-truncate">
                                {{ $item->name }}
                            </span>
                            <span class="btn p-1 btn-outline-success waves-effect waves-light" data-action="btn-add">
                                <i class="fa fa-angle-double-left text-success"></i>
                            </span>
                            <span class="btn p-1 btn-outline-danger waves-effect waves-light d-none" data-action="btn-remove">
                                <i class="fa fa-times text-danger"></i>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-6">
                <div class="h5-responsive text-center">@lang("dashboard/classify-items.index.header-2")</div>
                <div class="list-group overflow-auto scrollbar-blue-gray thin" style="max-height: 300px;" id="new-list"></div>
                <div class="text-warning" id="items-error"></div>
                <div class="dropdown pt-3">
                    <input type="text" class="form-control" id="category" value=""
                           placeholder="@lang("dashboard/classify-items.placeholder.select-category")" autocomplete="off"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <input type="hidden" name="category" value="">
                    <div class="text-warning" id="category-error"></div>
                    <div class="dropdown-menu dropdown-default w-100" aria-labelledby="category" id="dropdown-category">
                        @foreach($categories as $category)
                            <div class="dropdown-item" data-value="{{ $category->id }}">
                                {{ $category->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-outline-primary">
                        @lang("dashboard/classify-items.index.btn-send")
                    </button>
                </div>
            </div>
        </div>

        {{ $items->links() }}
    </div>
@endsection

@section("script")
    <script>
        $('#dropdown-category .dropdown-item').on('click', function () {
            $('input#category').val($(this).html().trim());
            $('input[name="category"]').val($(this).data('value'));
        });

        $('span[data-action="btn-add"]').on('click', function () {
            $(this).addClass("d-none");
            $(this).parent().find('span[data-action="btn-remove"]').removeClass("d-none");
            $('#new-list').append($(this).parent());
        });

        $('span[data-action="btn-remove"]').on('click', function () {
            $(this).addClass("d-none");
            $(this).parent().find('span[data-action="btn-add"]').removeClass("d-none");
            $('#old-list').append($(this).parent());
        });

        $('button').on('click', function () {
            let category = $('input[name="category"]').val();
            let items = [];
            $("#new-list div").each(function(index, item) {
                items.push(item.dataset.content);
            });
            $(this).addClass("disabled");

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '/dashboard/classify-items',
                data: {category: category, items: items},
                datatype: 'json',
                encode: true,
                success: function(response) {
                    if (response.status === false) {
                        $("#category-error").html(response.message.category);
                        $("#items-error").html(response.message.items);
                    } else {
                        $("#category-error").html('');
                        $("#items-error").html('');
                        $("#new-list").html('');
                        $('input#category').val('');
                        $('input[name="category"]').val('');
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
                    setTimeout(function (){
                        $('button').removeClass("disabled");
                    }, 500);
                }
            });
        });
    </script>
@endsection
