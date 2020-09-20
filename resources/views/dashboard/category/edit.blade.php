@extends("dashboard.layout.app")

@section("title", $category->name)

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center" id="change-selector">
            <div class="col-sm-8">
                <div class="alert alert-info">
                    <i class="far fa-star text-danger"></i>
                    @lang("dashboard/category.edit.note")
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="h5-responsive py-2">
                            <a data-toggle="collapse" href="#collapse-change-info" aria-expanded="false" aria-controls="#collapse-change-info">
                                @lang("dashboard/category.edit.change-info")
                            </a>
                        </div>

                        <div class="collapse @if(old("update") == "info") show @endif border-top border-info" id="collapse-change-info" data-parent="#change-selector">
                            <form class="pt-3 pb-5" method="post" action="{{route("dashboard.categories.update", ["category" => $category->id])}}">
                                @csrf()
                                @method("PUT")
                                <input type="hidden" name="update" value="info">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label class="col-form-label" for="name">
                                            @lang("dashboard/category.label.name")
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}"
                                               placeholder="@lang("dashboard/category.placeholder.name")">
                                        @error("name") <div class="text-warning">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="col-form-label" for="parent">
                                            @lang("dashboard/category.label.parent")
                                        </label>
                                        <div class="dropdown">
                                            <input type="text" class="form-control" id="parent" value="{{ $category->parent()->name ?? null}}"
                                                   placeholder="@lang("dashboard/category.placeholder.parent")" autocomplete="off"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <input type="hidden" name="parent" value="{{ $category->parent_id }}">
                                            @error("parent") <div class="text-warning">{{ $message }}</div> @enderror
                                            <div class="dropdown-menu dropdown-default w-100" aria-labelledby="parent" id="dropdown-parent">
                                                @foreach($categories as $item)
                                                    <div class="dropdown-item" data-value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-outline-primary" type="submit">
                                        @lang("dashboard/category.edit.btn-save")
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="h5-responsive py-2">
                            <a data-toggle="collapse" href="#collapse-change-image" aria-expanded="false" aria-controls="#collapse-change-image">
                                @lang("dashboard/category.edit.change-image")
                            </a>
                        </div>

                        <div class="collapse @if(old("update") == "image") show @endif border-top border-info" id="collapse-change-image" data-parent="#change-selector">
                            <form class="pt-3 pb-5" method="post" action="{{route("dashboard.categories.update", ["category" => $category->id])}}" enctype="multipart/form-data">
                                @csrf()
                                @method("PUT")
                                <input type="hidden" name="update" value="image">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label class="col-form-label" for="image">
                                            @lang("dashboard/category.label.image")
                                        </label>
                                        <div class="row align-items-center">
                                            <div class="{{(($category->image) ? "col-sm-6":"col-sm-12")}}">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="image" value="">
                                                    <input type="hidden" name="deleted" value="0">
                                                    <div class="custom-file-label">
                                                        @lang("dashboard/category.placeholder.image")
                                                    </div>
                                                </div>
                                                @error("image") <div class="text-warning">{{ $message }}</div> @enderror
                                            </div>
                                            @if($category->image)
                                                <div class="col-sm-6">
                                                    <div class="view overlay z-depth-1 img-thumbnail">
                                                        <img src="{{asset("images/large".Storage::url($category->image))}}" class="w-100" alt="Category Image">
                                                        <div class="mask flex-center rgba-black-strong">
                                                            <div class="btn btn-outline-info btn-sm" id="view">
                                                                <i class="fa fa-eye"></i>
                                                            </div>
                                                            <div class="btn btn-outline-danger btn-sm" id="delete">
                                                                <i class="fa fa-trash"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-outline-primary" type="submit">
                                        @lang("dashboard/category.edit.btn-save")
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("extra-content")
    <div class="modal fade" id="modal-category-view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <img src="" class="img-fluid" alt="Category Image">
            </div>
        </div>
    </div>
@endsection

@section("script")
    @parent
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
        $('#view').on('click', function () {
            let src = $(this).parent().parent().find('img').attr('src');
            let modal = $('#modal-category-view');
            modal.find('img').attr('src', src);
            modal.modal('show');
        });
        $('#delete').on('click', function () {
            $(this).parent().parent().parent().addClass('d-none');
            $('input[name="deleted"]').val(1);
        });
        @if(session()->has("toast"))
            $.toast({
                title: '{{session()->get("toast.message")}}',
                type:  '{{session()->get("toast.type")}}',
                delay: 2500
            });
        @endif
    </script>
@endsection
