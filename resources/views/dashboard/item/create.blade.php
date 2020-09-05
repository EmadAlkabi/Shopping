@extends("dashboard.layout.app")

@section("title", __("dashboard/item.create.title"))

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <form method="post" action="{{route("dashboard.items.store")}}" enctype="multipart/form-data" autocomplete="off">
                    @csrf()
                    {{-- Item --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-form-label" for="name" >
                                @lang("dashboard/item.label.name")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old("name")}}"
                                   placeholder="@lang("dashboard/item.placeholder.name")">
                            @error("name") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="company">
                                @lang("dashboard/item.label.company")
                            </label>
                            <input type="text" class="form-control" name="company" id="company" value="{{old("company")}}"
                                   placeholder="@lang("dashboard/item.placeholder.company")">
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="tags">
                                @lang("dashboard/item.label.tags")
                            </label>
                            <input type="text" class="form-control" name="tags" id="tags" value="{{old("tags")}}"
                                   placeholder="@lang("dashboard/item.placeholder.tags")">
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="category">
                                @lang("dashboard/item.label.category")
                                <span class="text-danger">*</span>
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
                        <div class="col-sm-4">
                            <label class="col-form-label" for="barcode" >
                                @lang("dashboard/item.label.barcode")
                            </label>
                            <input type="text" class="form-control" name="barcode" id="barcode" value="{{old("barcode")}}">
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="code" >
                                @lang("dashboard/item.label.code")
                            </label>
                            <input type="text" class="form-control" name="code" id="code" value="{{old("code")}}">
                        </div>
                        <div class="col-sm-4">
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
                        <div class="col-sm-12">
                            <label class="col-form-label" for="details">
                                @lang("dashboard/item.label.details")
                            </label>
                            <textarea class="form-control" name="details" id="details">{{old("details")}}</textarea>
                        </div>
                    </div>
                    {{-- Media --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-form-label" for="main-image" >
                                @lang("dashboard/item.label.main-image")
                                <span class="text-danger">*</span>
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="mainImage" id="main-image" value="">
                                <div class="custom-file-label overflow-hidden">
                                    @lang("dashboard/item.placeholder.main-image")
                                </div>
                            </div>
                            @error("mainImage") <div class="text-warning">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="other-images" >
                                @lang("dashboard/item.label.other-images")
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="otherImages[]" id="other-images" value="" multiple="multiple">
                                <div class="custom-file-label overflow-hidden">
                                    @lang("dashboard/item.placeholder.other-images")
                                </div>
                            </div>
                            @error("otherImages") <div class="text-warning">{{ $message }}</div> @enderror
                            @error("otherImages.*") <div class="text-warning">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    {{-- Units --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info text-center mt-3">
                                <i class="far fa-star text-danger"></i>
                                @lang("dashboard/item.create.note")
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-2 py-2">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" name="unit-1" id="unit-1" value="1" checked disabled>
                                        <label class="custom-control-label d-inline" for="unit-1">
                                            @lang("dashboard/item.label.unit") 1
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="quantity-1" value="{{old("quantity-1")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.quantity")">
                                            @error("quantity-1") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="name-1" value="{{old("name-1")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.name")">
                                            @error("name-1") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="price-1" value="{{old("price-1")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.price")">
                                            @error("price-1") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="content-1" value="{{old("content-1")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.content")">
                                            @error("content-1") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-2 py-2">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" name="unit-2" id="unit-2" value="2" {{(old("unit-2"))? "checked" : ""}}>
                                        <label class="custom-control-label" for="unit-2">
                                            @lang("dashboard/item.label.unit") 2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="quantity-2" value="{{old("quantity-2")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.quantity")" {{(!old("unit-2"))? "disabled" : ""}}>
                                            @error("quantity-2") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="name-2" value="{{old("name-2")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.name")" {{(!old("unit-2"))? "disabled" : ""}}>
                                            @error("name-2") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="price-2" value="{{old("price-2")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.price")" {{(!old("unit-2"))? "disabled" : ""}}>
                                            @error("price-2") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="content-2" value="{{old("content-2")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.content")" {{(!old("unit-2"))? "disabled" : ""}}>
                                            @error("content-2") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-2 py-2">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" name="unit-3" id="unit-3" value="3" {{(old("unit-3"))? "checked" : ""}}>
                                        <label class="custom-control-label" for="unit-3">
                                            @lang("dashboard/item.label.unit") 3
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="quantity-3" value="{{old("quantity-3")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.quantity")" {{(!old("unit-3"))? "disabled" : ""}}>
                                            @error("quantity-3") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="name-3" value="{{old("name-3")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.name")" {{(!old("unit-3"))? "disabled" : ""}}>
                                            @error("name-3") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="price-3" value="{{old("price-3")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.price")" {{(!old("unit-3"))? "disabled" : ""}}>
                                            @error("price-3") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                        <div class="col py-2">
                                            <input type="text" class="form-control" name="content-3" value="{{old("content-3")}}"
                                                   placeholder="@lang("dashboard/item.placeholder.unit.content")" {{(!old("unit-3"))? "disabled" : ""}}>
                                            @error("content-3") <div class="text-warning">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-2 py-2">
                                    <label class="col-form-label" for="main-unit" >
                                        @lang("dashboard/item.label.main-unit")
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="col-sm-10 py-2">
                                    <div class="dropdown">
                                        <input type="text" class="form-control" id="main-unit" value="{{ (old("mainUnit")) ? __("dashboard/item.create.fill") . " " . old("mainUnit") : "" }}"
                                               placeholder="@lang("dashboard/item.placeholder.main-unit")"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <input type="hidden" name="mainUnit" value="{{ old("mainUnit") }}">
                                        @error("mainUnit") <div class="text-warning">{{ $message }}</div> @enderror
                                        <div class="dropdown-menu dropdown-default w-100" aria-labelledby="main-unit" id="dropdown-main-unit">
                                            <div class="dropdown-item" data-value="1">
                                                @lang("dashboard/item.create.fill") 1
                                            </div>
                                            <div class="dropdown-item disabled" data-value="2">
                                                @lang("dashboard/item.create.fill") 2
                                            </div>
                                            <div class="dropdown-item disabled" data-value="3">
                                                @lang("dashboard/item.create.fill") 3
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $('#dropdown-category .dropdown-item').on('click', function () {
            $('input#category').val($(this).html().trim());
            $('input[name="category"]').val($(this).data('value'));
        });
        $('#dropdown-currency .dropdown-item').on('click', function () {
            $('input#currency').val($(this).html().trim());
            $('input[name="currency"]').val($(this).data('value'));
        });
        $('#dropdown-main-unit .dropdown-item').on('click', function () {
            $('input#main-unit').val($(this).html().trim());
            $('input[name="mainUnit"]').val($(this).data('value'));
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
        $('input[type="checkbox"]').on('click', function () {
            let dd = $("#dropdown-main-unit .dropdown-item");
            if ($(this).attr('checked') === undefined) {
                $(this).attr('checked', 'checked');
                $(this).parent().parent().parent().find('input[type="text"]').removeAttr('disabled');
                if ($(this).attr("id") === "unit-2")
                    dd[1].classList.remove("disabled");
                if ($(this).attr("id") === "unit-3")
                    dd[2].classList.remove("disabled")
            } else {
                $(this).removeAttr('checked');
                $(this).parent().parent().parent().find('input[type="text"]').attr('disabled', 'disabled');
                if ($(this).attr("id") === "unit-2")
                    dd[1].classList.add("disabled");
                if ($(this).attr("id") === "unit-3")
                    dd[2].classList.add("disabled")
            }
        });
        $('button').on('click', function () {
            $('input#unit-1').removeAttr("disabled");
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
