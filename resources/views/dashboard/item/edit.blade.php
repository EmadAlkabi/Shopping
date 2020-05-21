@extends("dashboard.layout.app")

@section("title", $item->name)

@section("head")
    @include("dashboard.layout.head.summer-note")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form method="post" action="{{route("dashboard.items.update", ["item" => $item->id])}}">
                    @csrf()
                    @method("PUT")
                    <div class="form-group row">
                        <div class="col-12">
                            <label class="col-form-label" for="name" >
                                @lang("dashboard/item.label.name")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$item->name}}"
                                   placeholder="@lang("dashboard/item.placeholder.name")">
                            @error("name") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="company">
                                @lang("dashboard/item.label.company")
                            </label>
                            <input type="text" class="form-control" name="company" id="company" value="{{$item->company}}"
                                   placeholder="@lang("dashboard/item.placeholder.company")">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="tags">
                                @lang("dashboard/item.label.tags")
                            </label>
                            <input type="text" class="form-control" name="tags" id="tags" value="{{$item->tags}}"
                                   placeholder="@lang("dashboard/item.placeholder.tags")">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="category">
                                @lang("dashboard/item.label.category")
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="category"
                                       value="{{$item->category->name}}"
                                       placeholder="@lang("dashboard/item.placeholder.category")"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="category" value="{{$item->category->id}}">
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
                            <textarea class="form-control" name="details" id="details">{{$item->details}}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="barcode" >
                                @lang("dashboard/item.label.barcode")
                            </label>
                            <input type="text" class="form-control" name="barcode" id="barcode" value="{{$item->barcode}}">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="code" >
                                @lang("dashboard/item.label.code")
                            </label>
                            <input type="text" class="form-control" name="code" id="code" value="{{$item->code}}">
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="currency" >
                                @lang("dashboard/item.label.currency")
                                <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="currency" value="{{App\Enum\Currency::getCurrencyName($item->currency)}}"
                                       placeholder="@lang("dashboard/item.placeholder.currency")"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="currency" value="{{$item->currency}}">
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
                            <input type="text" class="form-control" name="price" id="price" value="{{$item->price}}">
                            @error("price") <div class="text-warning">{{$message}}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="unit" >
                                @lang("dashboard/item.label.unit")
                                <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="unit" value="{{App\Enum\Unit::getUnitName($item->unit)}}"
                                       placeholder="@lang("dashboard/item.placeholder.unit")"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="unit" value="{{$item->unit}}">
                                @error("unit") <div class="text-warning">{{$message}}</div> @enderror
                                <div class="dropdown-menu dropdown-default w-100" aria-labelledby="unit" id="dropdown-unit">
                                    @foreach(\App\Enum\Unit::getUnits() as $unit)
                                        <div class="dropdown-item" data-value="{{$unit}}">
                                            {{App\Enum\Unit::getUnitName($unit)}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="col-form-label" for="quantity" >
                                @lang("dashboard/item.label.quantity")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="quantity" id="quantity" value="{{$item->quantity}}">
                            @error("quantity") <div class="text-warning">{{$message}}</div> @enderror
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
        $('#dropdown-unit .dropdown-item').on('click', function () {
            $('input#unit').val($(this).html().trim());
            $('input[name="unit"]').val($(this).data('value'));
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
