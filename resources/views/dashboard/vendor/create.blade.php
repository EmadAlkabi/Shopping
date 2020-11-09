@extends("dashboard.layout.app")

@section("title", __("dashboard/vendor.create.title"))

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <form method="post" action="{{route("dashboard.vendors.store")}}">
                    @csrf()
                    {{-- Vendor --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info text-center mt-3">
                                <i class="far fa-star text-danger"></i>
                                @lang("dashboard/vendor.create.note-1")
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="vendor-name">
                                @lang("dashboard/vendor.label.name")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="vendorName" id="vendor-name" value="{{old("vendorName")}}"
                                   placeholder="@lang("dashboard/vendor.placeholder.name")">
                            @error("vendorName") <div class="text-danger">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="vendor-email">
                                @lang("dashboard/vendor.label.email")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" name="vendorEmail" id="vendor-email" value="{{old("vendorEmail")}}"
                                   placeholder="@lang("dashboard/vendor.placeholder.email")">
                            @error("vendorEmail") <div class="text-danger">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="vendor-phone">
                                @lang("dashboard/vendor.label.phone")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="vendorPhone" id="vendor-phone" value="{{old("vendorPhone")}}"
                                   placeholder="@lang("dashboard/vendor.placeholder.phone")">
                            @error("vendorPhone") <div class="text-danger">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="vendor-gps">
                                @lang("dashboard/vendor.label.gps")
                            </label>
                            <input type="text" class="form-control" name="vendorGPS" id="vendor-gps" value="{{old("vendorGPS")}}">
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="vendor-state">
                                @lang("dashboard/vendor.label.state")
                                <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="vendor-state" autocomplete="off"
                                       value="{{App\Enum\VendorState::getStateName(old("vendorState"))}}"
                                       placeholder="@lang("dashboard/vendor.placeholder.state")"
                                       data-toggle="dropdown" data-action="search" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="vendorState" value="{{old("vendorState")}}">
                                @error("vendorState") <div class="text-danger">{{$message}}</div> @enderror
                                <div class="dropdown-menu dropdown-default w-100" aria-labelledby="vendor-state">
                                    @foreach(\App\Enum\VendorState::getStates() as $state)
                                        <div class="dropdown-item" data-value="{{$state}}">
                                            {{App\Enum\VendorState::getStateName($state)}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="col-form-label" for="vendor-detail">
                                @lang("dashboard/vendor.label.detail")
                            </label>
                            <textarea class="form-control" rows="5" name="vendorDetail" id="vendor-detail">{{old("vendorDetail")}}</textarea>
                        </div>
                    </div>

                    {{-- Admin --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info text-center mt-3">
                                <i class="far fa-star text-danger"></i>
                                @lang("dashboard/vendor.create.note-2")
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="admin-name">
                                @lang("dashboard/admin.label.name")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="adminName" id="admin-name" value="{{old("adminName")}}"
                                   placeholder="@lang("dashboard/admin.placeholder.name")">
                            @error("adminName") <div class="text-danger">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="admin-username">
                                @lang("dashboard/admin.label.username")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="adminUsername" id="admin-username" value="{{old("adminUsername")}}"
                                   placeholder="@lang("dashboard/admin.placeholder.username")">
                            @error("adminUsername") <div class="text-danger">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="admin-password" >
                                @lang("dashboard/admin.label.password")
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" name="adminPassword" id="admin-password">
                            @error("adminPassword") <div class="text-danger">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="admin-password-confirmation" >
                                @lang("dashboard/admin.label.re-password")
                            </label>
                            <input type="password" class="form-control" name="adminPassword_confirmation" id="admin-password-confirmation">
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label" for="admin-state">
                                @lang("dashboard/admin.label.state")
                                <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown">
                                <input type="text" class="form-control" id="admin-state" autocomplete="off"
                                       value="{{App\Enum\AdminState::getStateName(old("adminState"))}}"
                                       placeholder="@lang("dashboard/admin.placeholder.state")"
                                       data-toggle="dropdown" data-action="search" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" name="adminState" value="{{old("adminState")}}">
                                @error("adminState") <div class="text-danger">{{$message}}</div> @enderror
                                <div class="dropdown-menu dropdown-default w-100" aria-labelledby="admin-state">
                                    @foreach(\App\Enum\AdminState::getStates() as $state)
                                        <div class="dropdown-item" data-value="{{$state}}">
                                            {{App\Enum\AdminState::getStateName($state)}}
                                        </div>
                                    @endforeach
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
        $('.dropdown-menu .dropdown-item').on('click', function () {
            $(this).parent().parent().find('input[type="text"]').val($(this).html().trim());
            $(this).parent().parent().find('input[type="hidden"]').val($(this).data('value'));
        });
        $('input[data-action="search"]').on('keyup', function () {
            let value = $(this).val();
            let items = $(this).parent().find('.dropdown-menu .dropdown-item');
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
