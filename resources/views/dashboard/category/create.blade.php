@extends("dashboard.layout.app")

@section("title", __("dashboard/category.create.title"))

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="alert alert-info">
                    <i class="far fa-star text-danger"></i>
                    @lang("dashboard/category.create.note")
                </div>

                <form method="post" action="{{route("dashboard.categories.store")}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group row">
                        <div class="col-12">
                            <label class="col-form-label" for="name">
                                @lang("dashboard/category.label.name")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old("name")}}"
                                   placeholder="@lang("dashboard/category.placeholder.name")">
                            @error("name") <div class="text-warning">{{$message}}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="col-form-label" for="image">
                                @lang("dashboard/category.label.image")
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image" value="">
                                <div class="custom-file-label">
                                    @lang("dashboard/category.placeholder.image")
                                </div>
                            </div>
                            @error("image") <div class="text-warning">{{$message}}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="col-form-label" for="parent">
                                @lang("dashboard/category.label.parent")
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="parent" value="{{$categories->filter(function ($category) {return $category->id == old("parent");})->first()->name ?? ""}}"
                                       placeholder="@lang("dashboard/category.placeholder.parent")" autocomplete="off"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="parent" value="{{old("parent")}}">
                                @error("parent") <div class="text-warning">{{$message}}</div> @enderror
                                <div class="dropdown-menu dropdown-default w-100" aria-labelledby="parent" id="dropdown-parent">
                                    @foreach($categories as $category)
                                        <div class="dropdown-item" data-value="{{$category->id}}">
                                            {{$category->name}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary" type="submit">
                            @lang("dashboard/category.create.btn-send")
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('#dropdown-parent .dropdown-item').on('click', function () {
            $('input#parent').val($(this).html().trim());
            $('input[name="parent"]').val($(this).data('value'));
        });
        $('input#parent').on('keyup', function () {
            let value = $(this).val();
            let items = $('#dropdown-parent .dropdown-item');

            $.each(items, function(index, item) {
                item.classList.add('d-none');
                item.classList.remove('d-block');
                let str = item.textContent.trim();
                if(str.includes(value))
                    item.classList.add('d-block');
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
