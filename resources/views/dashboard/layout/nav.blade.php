<nav class="mb-1 navbar fixed-top scrolling-navbar navbar-dark blue-gray">
    <a class="navbar-brand m-0" href="javascript:void(0)">
        @lang("dashboard/layout.nav.brand")
    </a>
    <ul class="navbar-nav nav-flex-icons">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>

        <li class="nav-item mt-1 d-lg-none d-block">
            <a class="nav-link d-block" id="showSidenav">
                <i class="fas fa-bars"></i>
            </a>

            <a class="nav-link d-none" id="hideSidenav">
                <i class="fas fa-times"></i>
            </a>
        </li>
    </ul>
</nav>

<script>
    @if(app()->getLocale() == \App\Enum\Language::ARABIC)
        $("#showSidenav").click(function () {
            $("#mySidenav").removeClass("fadeOutRight")
                .addClass("d-block animated fadeInRight");
            // document.body.style.backgroundColor = "rgba(33,150,243,0.24)";
            $(this).addClass("d-none").removeClass("d-block");
            $("#hideSidenav").addClass("d-block").removeClass("d-none");
        });

        $("#hideSidenav").click(function () {
            $("#mySidenav").removeClass("fadeInRight")
                .addClass("d-none animated fadeOutRight");
            // document.body.style.backgroundColor = "rgb(255, 255, 255)";
            $(this).addClass("d-none").removeClass("d-block");
            $("#showSidenav").addClass("d-block").removeClass("d-none");
        });
    @else
        $("#showSidenav").click(function () {
            $("#mySidenav").removeClass("fadeOutLeft")
                .addClass("d-block animated fadeInLeft");
            // document.body.style.backgroundColor = "rgba(33,150,243,0.24)";
            $(this).addClass("d-none").removeClass("d-block");
            $("#hideSidenav").addClass("d-block").removeClass("d-none");
        });

        $("#hideSidenav").click(function () {
            $("#mySidenav").removeClass("fadeInLeft")
                .addClass("d-none animated fadeOutLeft");
            // document.body.style.backgroundColor = "rgb(255, 255, 255)";
            $(this).addClass("d-none").removeClass("d-block");
            $("#showSidenav").addClass("d-block").removeClass("d-none");
        });
    @endif
</script>
