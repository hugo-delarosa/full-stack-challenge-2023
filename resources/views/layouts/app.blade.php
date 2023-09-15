<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Referral Database') }}</title>

    <!-- Styles -->
    <!-- TODO: use nppm for getting styles setup, for now usign CDN bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

{{--        <nav class="navbar navbar-default navbar-static-top">--}}
{{--            <div class="container">--}}
{{--                <div class="navbar-header">--}}

{{--                    <!-- Collapsed Hamburger -->--}}
{{--                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">--}}
{{--                        <span class="sr-only">Toggle Navigation</span>--}}
{{--                        <span class="icon-bar"></span>--}}
{{--                        <span class="icon-bar"></span>--}}
{{--                        <span class="icon-bar"></span>--}}
{{--                    </button>--}}

{{--                    <!-- Branding Image -->--}}
{{--                    <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                        {{ config('app.name', 'Referral Database') }}--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="nav navbar-nav">--}}
{{--                        &nbsp;--}}
{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="nav navbar-nav navbar-right">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}


    <header class="p-3 mb-5 border-bottom bg-body">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </ul>


                <div class="dropdown text-right">
                    @guest
                        <a class="d-block link-body-emphasis text-decoration-none" href="{{ route('login') }}">Login</a>
                    @else
                        <a class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu text-small">
                            @can('view', App\Referral::class)
                            <li>
                                <a href="{{ route('referral.index') }}">
                                    Referrals
                                </a>
                            </li>
                            @endcan
                                @can('create', App\Referral::class)
                                    <li>
                                        <a href="{{ route('add-referral') }}">
                                            Add Referral
                                        </a>
                                    </li>
                                @endcan
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <div class="container bg-body">
        @yield('content')
    </div>


    <!-- Scripts -->
    <!-- TODO: use nppm for getting JS setup, for now usign CDN bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#filter").click(function(){
                var country = $("#country").val();
                if(country == undefined) {
                    country = $("#city").val();
                }
                var divider = window.location.href.substr(-1) == '/' ? '' : '/'
                window.location.href = window.location.origin + window.location.pathname + divider + country;
                // console.log($("#country").val());
            });
        });
    </script>
</body>
</html>
