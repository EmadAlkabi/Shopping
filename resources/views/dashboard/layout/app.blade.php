<html lang="{{str_replace("_", "-", app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap tooltips/core  JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- MDB core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/css/mdb.min.css" rel="stylesheet">
    <!-- MDB core JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/js/mdb.min.js"></script>
    <!-- Toaster core CSS -->
    <link href="{{asset("css/toaster.min.css")}}" rel="stylesheet" type="text/css">
    <!-- Toaster core JS -->
    <script type="text/javascript" src="{{asset("js/toaster.min.js")}}"></script>
    @yield("head")
    <!-- Custom CSS -->
    @switch(app()->getLocale())
        @case(\App\Enum\Language::ARABIC)
            <link href="{{asset("css/custom-rtl.css")}}" rel="stylesheet" type="text/css">
            @break
        @case(\App\Enum\Language::ENGLISH)
            <link href="{{asset("css/custom-ltr.css")}}" rel="stylesheet" type="text/css">
            @break
    @endswitch
</head>
<body class="fixed-skin">
    <!-- Navigation -->
    @include("dashboard.layout.nav")

    <!-- Side Navigation -->
    @include("dashboard.layout.side-nav")

    <!-- Main -->
    <main>
        @yield("content")
    </main>

    <!-- Footer -->
    @include("dashboard.layout.footer")

    <!-- Extra Content -->
    @yield("extra-content")

    <!-- Inside Page Scripts -->
    @yield("script")
</body>
</html>
