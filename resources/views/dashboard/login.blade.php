<html lang="{{str_replace("_", "-", app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@lang("dashboard-admin/login.title")</title>
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
    <!-- Inside Page Styles -->
    <style>
        [lang="ar"] body {
            direction: rtl;
            text-align: right;
        }
        [lang="en"] body {
            direction: ltr;
            text-align: left;
        }
        html, body {
            background-color: #f0f3f9;
            color: #23282c;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: calc(100vh - 56px);
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center full-height position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-4">
                    <h4 class="text-center font-weight-bold mb-4">
                        @lang("dashboard/login.header")
                    </h4>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @error("login-failed")
                                <div class="text-danger text-center animated fadeIn">
                                    {{$message}}
                                </div>
                            @enderror

                            <form method="post" action="{{route("dashboard.login")}}">
                                @csrf()
                                <div class="form-group">
                                    <label class="control-label" for="username">
                                        @lang("dashboard/login.label.username")
                                    </label>
                                    <input type="text" class="form-control" name="username" id="username" value="{{old("username")}}">
                                    @error("username") <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">
                                        @lang("dashboard/login.label.password")
                                    </label>
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                    @error("password") <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                                <div class="form-group pt-2">
                                    <button type="submit" class="btn btn-block btn-blue-grey">
                                        @lang("dashboard/login.btn-login")
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="links text-center pt-3">
                        <a href="{{route("dashboard", ["locale" => \App\Enum\Language::ARABIC])}}">العربية</a>
                        <a href="{{route("dashboard", ["locale" => \App\Enum\Language::ENGLISH])}}">English</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer unique-color-dark">
        <div class="footer-copyright py-3 text-center" dir="ltr">
            © 2020 Copyright:
            <a href="https://www.turathalanbiaa.com" target="_blank">
                <strong> http://alfosoolonline.com</strong>
            </a>
        </div>
    </footer>
</body>
</html>
