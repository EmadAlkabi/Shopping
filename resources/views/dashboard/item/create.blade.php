@extends("dashboard.layout.app")

@section("title", __("dashboard/item.create.title"))

@section("head")
    @include("dashboard.layout.head.summer-note")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form method="post" action="{{route("dashboard.items.store")}}">
                    @csrf()
                    {{-- Item --}}
                    <div class="form-group row">
                        <div class="col-12">
                            <label class="col-form-label" for="name" >
                                @lang("dashboard/item.label.name")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old("name")}}"
                                   placeholder="@lang("dashboard/item.placeholder.name")">
                            @error("name") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="company">
                                @lang("dashboard/item.label.company")
                            </label>
                            <input type="text" class="form-control" name="company" id="company" value="{{old("company")}}"
                                   placeholder="@lang("dashboard/item.placeholder.company")">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="tags">
                                @lang("dashboard/item.label.tags")
                            </label>
                            <input type="text" class="form-control" name="tags" id="tags" value="{{old("tags")}}"
                                   placeholder="@lang("dashboard/item.placeholder.tags")">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="category">
                                @lang("dashboard/item.label.category")
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="category"
                                       value="{{$categories->filter(function ($category) {return $category->id == old("category");})->first()->name ?? ""}}"
                                       placeholder="@lang("dashboard/item.placeholder.category")"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="category" value="{{old("category")}}">
                                @error("category") <div class="text-warning">{{$message}}</div> @enderror
                                <div class="dropdown-menu dropdown-default w-100" aria-labelledby="category" id="dropdown-category">
                                    @foreach($categories as $category)
                                        <div class="dropdown-item" data-value="{{$category->id}}">
                                            {{$category->name}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="details">
                                @lang("dashboard/item.label.details")
                            </label>
                            <textarea class="form-control" name="details" id="details">{{old("details")}}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="barcode" >
                                @lang("dashboard/item.label.barcode")
                            </label>
                            <input type="text" class="form-control" name="barcode" id="barcode" value="{{old("barcode")}}">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="code" >
                                @lang("dashboard/item.label.code")
                            </label>
                            <input type="text" class="form-control" name="code" id="code" value="{{old("code")}}">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="currency" >
                                @lang("dashboard/item.label.currency")
                                <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="currency" value="{{App\Enum\Currency::getCurrencyName(old("currency"))}}"
                                       placeholder="@lang("dashboard/item.placeholder.currency")"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="currency" value="{{old("currency")}}">
                                @error("currency") <div class="text-warning">{{$message}}</div> @enderror
                                <div class="dropdown-menu dropdown-default w-100" aria-labelledby="currency" id="dropdown-currency">
                                    @foreach(\App\Enum\Currency::getCurrencies() as $currency)
                                        <div class="dropdown-item" data-value="{{$currency}}">
                                            {{App\Enum\Currency::getCurrencyName($currency)}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="price" >
                                @lang("dashboard/item.label.price")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="price" id="price" value="{{old("price")}}">
                            @error("price") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                    </div>
                    {{-- Units --}}
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" name="unit-1" id="unit-1" {{(old("unit-1"))? "checked" : ""}}>
                                <label class="custom-control-label" for="unit-1">
                                    @lang("dashboard/unit.fill.unit-1")
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="quantity-1" value="{{old("quantity-1")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.quantity")">
                            @error("quantity-1") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="name-1" value="{{old("name-1")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.name")">
                            @error("name-1") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="price-1" value="{{old("price-1")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.price")">
                            @error("price-1") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" name="unit-2" id="unit-2" {{(old("unit-2"))? "checked" : ""}}>
                                <label class="custom-control-label" for="unit-2">
                                    @lang("dashboard/unit.fill.unit-2")
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="quantity-2" value="{{old("quantity-2")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.quantity")">
                            @error("quantity-2") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="name-2" value="{{old("name-2")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.name")">
                            @error("name-2") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="price-2" value="{{old("price-2")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.price")">
                            @error("price-2") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" name="unit-3" id="unit-3" {{(old("unit-3"))? "checked" : ""}}>
                                <label class="custom-control-label" for="unit-3">
                                    @lang("dashboard/unit.fill.unit-3")
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="quantity-3" value="{{old("quantity-3")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.quantity")">
                            @error("quantity-3") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="name-3" value="{{old("name-3")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.name")">
                            @error("name-3") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="price-3" value="{{old("price-3")}}"
                                   placeholder="@lang("dashboard/unit.placeholder.price")">
                            @error("price-3") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary" type="submit">
                            @lang("dashboard/item.create.btn-send")
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('#details').summernote({
            placeholder: '@lang("dashboard/item.placeholder.details")',
            tabsize: 4,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('#dropdown-currency .dropdown-item').on('click', function () {
            $('input#currency').val($(this).html().trim());
            $('input[name="currency"]').val($(this).data('value'));
        });
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
                str = item.textContent.trim();
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
