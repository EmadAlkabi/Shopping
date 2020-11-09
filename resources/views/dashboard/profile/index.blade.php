@extends("dashboard.layout.app")

@section("title", __("dashboard/profile.index.title"))

@section("head")
    @include("dashboard.layout.head.datatable")
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-info" role="alert">
                    <div class="row">
                        <div class="col-sm-8 d-flex flex-column">
                            <h4 class="alert-heading">
                                <i class="fa fa-info-circle"></i>
                                @lang("dashboard/profile.index.note.header")
                            </h4>
                            <ul>
                                <li>@lang("dashboard/profile.index.note.line-v")</li>
                                <li>@lang("dashboard/profile.index.note.line-a")</li>
                                <li>@lang("dashboard/profile.index.note.line-c")</li>
                            </ul>
                            <div class="mt-auto">
                                <hr>
                                <p>
                                    <i class="fa fa-star"></i>
                                    @lang("dashboard/profile.index.note.line-i")
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center d-none d-md-block">
                            <img src="{{asset("images/square".\Illuminate\Support\Facades\Storage::url("public/admin/default.jpg"))}}" class="img-fluid z-depth-1 rounded-circle" alt="Square Image">
                            <p class="my-3 font-weight-bold">{{$admin->name}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <ul class="nav nav-tabs nav-fill p-0" id="myTab" role="tablist">
                    @if(in_array("SuperAdmin", session()->get("dashboard.roles")))
                        <li class="nav-item">
                            <a class="nav-link" id="vendor-tab" data-toggle="tab" href="#vendor" role="tab" aria-controls="vendor" aria-selected="true">
                                @lang("dashboard/profile.index.tab.vendor")
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">
                            @lang("dashboard/profile.index.tab.account")
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">
                            @lang("dashboard/profile.index.tab.change-password")
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    @if(in_array("SuperAdmin", session()->get("dashboard.roles")))
                        <div class="tab-pane fade pt-4" id="vendor" role="tabpanel" aria-labelledby="vendor-tab">
                            @include("dashboard.profile.components.change-vendor-info", ["vendor" => $vendor])
                        </div>
                    @endif
                    <div class="tab-pane fade pt-4" id="account" role="tabpanel" aria-labelledby="account-tab">
                        Account
                    </div>

                    <div class="tab-pane fade pt-4" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                        Change Password
                    </div>
                </div>
            </div>
        </div>



{{--        <div class="row">--}}

{{--                <div class="tab-content">--}}
{{--                    <div class="tab-pane fade show active pt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.name"): </strong>--}}
{{--                            <span>{{$user->name}}</span>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.type"): </strong>--}}
{{--                            <span>{{\App\Enum\UserType::getTypeName($user->type)}}</span>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.email"): </strong>--}}
{{--                            <span>{{$user->email}}</span>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.phone"): </strong>--}}
{{--                            <span>{{$user->phone}}</span>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.gender"): </strong>--}}
{{--                            <span>{{\App\Enum\Gender::getGenderName($user->gender)}}</span>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.country"): </strong>--}}
{{--                            <span>{{Countries::getValue(app()->getLocale(), $user->country)}}</span>--}}
{{--                        </p>--}}
{{--                        @if($user->type == \App\Enum\UserType::STUDENT)--}}
{{--                            <p>--}}
{{--                                <strong>@lang("dashboard-admin/user.label.stage"): </strong>--}}
{{--                                <span>{{\App\Enum\Stage::getStageName($user->stage)}}</span>--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <strong>@lang("dashboard-admin/user.label.birth-date"): </strong>--}}
{{--                                <span>{{$user->birth_date}}</span>--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <strong>@lang("dashboard-admin/user.label.address"): </strong>--}}
{{--                                <span>{{$user->address}}</span>--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <strong>@lang("dashboard-admin/user.label.certificate"): </strong>--}}
{{--                                <span>{{\App\Enum\Certificate::getCertificateName($user->certificate)}}</span>--}}
{{--                            </p>--}}
{{--                        @endif--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.last-login"): </strong>--}}
{{--                            <span>{{$user->last_login ?? "---"}}</span>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <strong>@lang("dashboard-admin/user.label.state"): </strong>--}}
{{--                            <span>{{\App\Enum\UserState::getStateName($user->state)}}</span>--}}
{{--                        </p>--}}
{{--                        <a class="btn btn-outline-primary" href="{{route("dashboard.admin.users.edit", ["user" => $user->id])}}">--}}
{{--                            @lang("dashboard-admin/user.show.profile-tab.btn-edit")--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="tab-pane fade pt-4" id="documents" role="tabpanel" aria-labelledby="documents-tab">--}}
{{--                        @include("dashboard.admin.document.share.user-documents", ["user" => $user])--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
