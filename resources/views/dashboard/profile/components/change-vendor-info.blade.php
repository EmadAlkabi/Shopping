<div class="row justify-content-center">
    <div class="col-sm-10">
        <form method="post" action="{{route("dashboard.profile.updateVendor")}}">
            @csrf()
            <div class="row">
                <div class="col-sm-6">
                    <label class="col-form-label" for="name">
                        @lang("dashboard/vendor.label.name")
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$vendor->name}}"
                           placeholder="@lang("dashboard/vendor.placeholder.name")">
                    @error("name") <div class="text-danger">{{$message}}</div> @enderror
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label" for="email">
                        @lang("dashboard/vendor.label.email")
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$vendor->email}}"
                           placeholder="@lang("dashboard/vendor.placeholder.email")">
                    @error("email") <div class="text-danger">{{$message}}</div> @enderror
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label" for="phone">
                        @lang("dashboard/vendor.label.phone")
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$vendor->phone}}"
                           placeholder="@lang("dashboard/vendor.placeholder.phone")">
                    @error("phone") <div class="text-danger">{{$message}}</div> @enderror
                </div>
                <div class="col-sm-6">
                    <label class="col-form-label" for="gps">
                        @lang("dashboard/vendor.label.gps")
                    </label>
                    <input type="text" class="form-control" name="gps" id="gps" value="{{$vendor->gps}}">
                </div>
                <div class="col-sm-12">
                    <label class="col-form-label" for="detail">
                        @lang("dashboard/vendor.label.detail")
                    </label>
                    <textarea class="form-control" rows="5" name="detail" id="detail">{{$vendor->detail}}</textarea>
                </div>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-outline-primary" type="submit">
                    @lang("dashboard/ui.btn-save-change")
                </button>
            </div>
        </form>
    </div>
</div>


@section("script")
    <script>
        @if(session()->has("message"))
        $.toast({
            title: '{{session()->get("message")}}',
            type:  '{{session()->get("type")}}',
            delay: 2500
        });
        @endif
    </script>
@endsection
