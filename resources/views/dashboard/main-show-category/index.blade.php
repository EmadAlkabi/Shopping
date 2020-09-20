@extends("dashboard.layout.app")

@section("title", __("dashboard/main-show-category.index.title"))

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="h5-responsive text-center">
                    @lang("dashboard/main-show-category.index.header-1")
                </div>
                <div class="alert alert-info text-center mt-3">
                    <i class="far fa-star text-danger"></i>
                    @lang("dashboard/main-show-category.index.note")
                </div>
                <div class="text-center text-warning" id="counter"></div>
                <div class="dropdown pt-3">
                    <input type="text" class="form-control" id="category" value=""
                           placeholder="@lang("dashboard/main-show-category.placeholder.select-category")" autocomplete="off"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <input type="hidden" name="category" value="">
                    <div class="text-warning" id="category-error"></div>
                    <div class="dropdown-menu dropdown-default w-100" aria-labelledby="category" id="dropdown-category">
                        @foreach($categories as $category)
                            <div class="dropdown-item" data-value="{{$category->id}}">
                                {{$category->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center pt-3">
                    <button class="btn btn-outline-primary" id="add">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        <span class="content">
                            @lang("dashboard/main-show-category.index.btn-send")
                        </span>
                    </button>
                </div>
            </div>

            <div class="col-6">
                <div class="h5-responsive text-center">
                    @lang("dashboard/main-show-category.index.header-2")
                </div>
                <div class="list-group pt-3" id="list">
                    @foreach($mainShowCategories as $category)
                        <div class="list-group-item d-flex justify-content-between">
                            <span class="d-inline-block text-truncate">
                                {{$category->name}}
                            </span>
                            <button class="btn p-1 btn-outline-danger waves-effect waves-light" id="{{$category->id}}" onclick="remove({{$category->id}})">
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                <span class="content">
                                    <i class="fa fa-times text-danger"></i>
                                </span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @parent
    <script>
        $('#dropdown-category .dropdown-item').on('click', function () {
            $('input#category').val($(this).html().trim());
            $('input[name="category"]').val($(this).data('value'));
        });
        $('input#category').on('keyup', function () {
            let value = $(this).val();
            let items = $('#dropdown-category .dropdown-item');
            $.each(items, function(index, item) {
                item.classList.add('d-none');
                item.classList.remove('d-block');
                let str = item.textContent.trim();
                if(str.includes(value))
                    item.classList.add('d-block');
            });
        });
        $('button#add').on('click', function () {
            let category = $('input[name="category"]').val();
            let btn = $(this);
            btn.find('.spinner-border').removeClass('d-none');
            btn.find('.content').addClass('d-none');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '/dashboard/main-show-category',
                data: {category: category},
                datatype: 'json',
                encode: true,
                success: function(response) {
                    if (response.status === false) {
                        $('#counter').html(response.message.counter);
                        $('#category-error').html(response.message.category);
                        if (response.message.toast != null)
                            $.toast({
                                title: response.message.toast.title,
                                type:  response.message.toast.type,
                                delay: 2500
                            });
                    } else {
                        let categoryText = $('input#category').val();
                        let categoryValue = $('input[name="category"]').val();
                        let list = $('#list');
                        let item = list.find('#'+categoryValue).parent();
                        if (item.html() === undefined) {
                            let span = '<span class="d-inline-block text-truncate">' + categoryText  + '</span>';
                            let buttonSpinner = '<span class="spinner-border spinner-border-sm d-none" role="status"></span>';
                            let buttonContent = '<span class="content"><i class="fa fa-times text-danger"></i></span>';
                            let button = '<button class="btn p-1 btn-outline-danger waves-effect waves-light" id="'+categoryValue+'" onclick="remove('+categoryValue+')">' + buttonSpinner + buttonContent + '</button>';
                            let newItem = '<div class="list-group-item d-flex justify-content-between">' + span + button + '</div>';
                            list.append(newItem);
                        }
                        $('#counter').html('');
                        $('#category-error').html('');
                        categoryText.value = '';
                        categoryValue.value = '';
                        $.toast({
                            title: response.message.toast.title,
                            type:  response.message.toast.type,
                            delay: 2500
                        });
                    }
                },
                error: function() {
                } ,
                complete : function() {
                    setTimeout(function (){
                        btn.find('.spinner-border').addClass('d-none');
                        btn.find('.content').removeClass('d-none');
                    }, 500);
                }
            });
        });
        function remove(category) {
            let btn = document.getElementById(category);
            btn.getElementsByClassName('spinner-border')[0].classList.remove('d-none');
            btn.getElementsByClassName('content')[0].classList.add('d-none');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '/dashboard/main-show-category/'+category,
                data: {_method: "Delete", category: category},
                datatype: 'json',
                encode: true,
                success: function(response) {
                    if (response.status === true)
                        btn.parentElement.remove();
                    $.toast({
                        title: response.message.toast.title,
                        type:  response.message.toast.type,
                        delay: 2500
                    });
                },
                error: function() {
                } ,
                complete : function() {
                    setTimeout(function (){
                        btn.getElementsByClassName('spinner-border')[0].classList.add('d-none');
                        btn.getElementsByClassName('content')[0].classList.remove('d-none');
                    }, 500);
                }
            });
        }
    </script>
@endsection
