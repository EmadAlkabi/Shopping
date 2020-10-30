<nav class="mb-1 navbar fixed-top scrolling-navbar navbar-dark blue-gray">
    <a class="navbar-brand m-0" href="javascript:void(0)">
        {{session()->get("dashboard.vendor")}}
    </a>
    <ul class="navbar-nav nav-flex-icons">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-default overflow-auto scrollbar-blue-gray square thin" aria-labelledby="navbar-dropdown">
                @if(in_array("SuperAdmin", session()->get("dashboard.roles")))
                    <a class="dropdown-item" href="{{route("dashboard.profile.index", ["part" => "v"])}}">
                        @lang("dashboard/layout.nav.profile.action-1")
                    </a>
                @endif
                <a class="dropdown-item" href="{{route("dashboard.profile.index", ["part" => "a"])}}">
                    @lang("dashboard/layout.nav.profile.action-2")
                </a>
                <a class="dropdown-item" href="{{route("dashboard.profile.index", ["part" => "c"])}}">
                    @lang("dashboard/layout.nav.profile.action-3")
                </a>
                <hr/>
                <a class="dropdown-item" href="{{route("dashboard.profile.logoutFromCurrentDevice")}}">
                    @lang("dashboard/layout.nav.profile.action-4")
                </a>
                <a class="dropdown-item" href="{{route("dashboard.profile.logoutFromAllDevices")}}">
                    @lang("dashboard/layout.nav.profile.action-5")
                </a>
            </div>
        </li>

        <li class="nav-item mt-1 d-lg-none d-block">
            <a class="nav-link d-block" id="show-sidenav">
                <i class="fas fa-bars"></i>
            </a>
            <a class="nav-link d-none" id="hide-sidenav">
                <i class="fas fa-times"></i>
            </a>
        </li>
    </ul>
</nav>

@section("script")
    @parent
    <script>
        @switch(app()->getLocale())
            @case(\App\Enum\Language::ARABIC)
                $('#show-sidenav').on('click', function () {
                    $('#my-sidenav').removeClass('fadeOutRight').addClass('d-block animated fadeInRight');
                    $(this).addClass('d-none').removeClass('d-block');
                    $('#hide-sidenav').addClass('d-block').removeClass('d-none');
                });
                $('#hide-sidenav').on('click', function () {
                    $('#my-sidenav').removeClass('fadeInRight').addClass('d-none animated fadeOutRight');
                    $(this).addClass('d-none').removeClass('d-block');
                    $("#show-sidenav").addClass('d-block').removeClass('d-none');
                });
            @break
            @case(\App\Enum\Language::ENGLISH)
                $('#show-sidenav').on('click', function () {
                    $('#my-sidenav').removeClass('fadeOutLeft').addClass('d-block animated fadeInLeft');
                    $(this).addClass('d-none').removeClass('d-block');
                    $('#hide-sidenav').addClass('d-block').removeClass('d-none');
                });
                $('#hide-sidenav').on('click', function () {
                    $('#my-sidenav').removeClass('fadeInLeft').addClass('d-none animated fadeOutLeft');
                    $(this).addClass('d-none').removeClass('d-block');
                    $("#show-sidenav").addClass('d-block').removeClass('d-none');
                });
            @break
        @endswitch
    </script>
@endsection
