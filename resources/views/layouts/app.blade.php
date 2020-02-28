<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/filter.js') }}" defer></script>
    <script src="{{ asset('js/custom-alert.js') }}" defer></script>
    <script src="{{ asset('js/clickevents.js') }}" defer></script>
    <script src="{{ asset('js/docschanges.js') }}" defer></script>
    <script src="{{ asset('js/lightpick.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Fonts -->
    <script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" data-mutate-approach="sync"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightpick.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/Hawkeye-icon-02.png') }}" alt="Logo" style="width: 8%">
                {{ config('app.name', 'Hawkeye') }}
            </a>
        @guest
        @else
            <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('parts_devices') }}" class="nav-link-hawkeye">
                            <span class="custom-icon menu-icon" data-toggle="tooltip" data-placement="bottom" title="Parts and Devices">
                                @svg('custom/workstation')
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link-hawkeye">
                            <span class="custom-icon menu-icon" data-toggle="tooltip" data-placement="bottom" title="Orders">
                                @svg('custom/shopping-card')
                            </span>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="" class="nav-link-hawkeye">--}}
{{--                            <span class="custom-icon menu-icon" data-toggle="tooltip" data-placement="bottom" title="NEW_TITLE_HERE">--}}
{{--                                NEW--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            @endguest
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="dropdown navbar-nav ml-auto">
                                <a id="navbarDropdown" class="nav-link-hawkeye dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="custom-icon" style="display: inline-block; width: 25px">
                                        @svg('custom/plus')
                                    </span>
                                    {{ Auth::user()->name }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <li class="dropdown-item">
                                        <a href="{{ route('nav_create_order') }}" class="nav-link-hawkeye" style="text-align: center">
                                            <span class="custom-icon-menu-app">
                                                @svg('custom/plus')
                                            </span>
                                            <span style="margin-left: 0.5rem">New order</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('nav_create_product') }}" class="nav-link-hawkeye">
                                            <span class="custom-icon-menu-app">
                                                @svg('custom/plus')
                                            </span>
                                            <span style="margin-left: 0.5rem">New Product</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('nav_create_device') }}" class="nav-link-hawkeye">
                                            <span class="custom-icon-menu-app">
                                                @svg('custom/plus')
                                            </span>
                                            <span style="margin-left: 0.5rem">New Device</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script>
    $( document ).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });
</script>

</body>
</html>
