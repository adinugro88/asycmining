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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @livewireStyles
    <!-- Styles -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-fixed"
            style="width:100%!important;z-index: 1;">
            <div class="container">
                @auth
                @if (Auth::user()->is_admin != 1)
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @else
                <a class="navbar-brand" href="{{ url('admin/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @endif
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        {{-- @if (Auth::user()->name !== '') --}}
                        @auth

                        @if (Auth::user()->is_admin != 1)
                        {{-- <li class="nav-item">
                            <a class="nav-link 
                            {{ route('home') ? 'font-weight-bold' : '' }}
                        " href="/home">koin BCH </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ route('btc') ? 'font-weight-bold' : '' }}" href="/btc">Koin BTC</a>
                        </li> --}}
                        {{-- @endif --}}

                        @else

                        <li class="nav-item">
                            <a class="nav-link 
                            {{ (request()->is('admin/home')) ? 'active' : '' }}
                            " href="/admin/home">Dashboard </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link 
                            {{ (request()->is('admin/investor')) ? 'active' : '' }}
                            " href="/admin/investor">Investor </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link 
                            {{ (request()->is('admin/mesin*')) ? 'active' : '' }}
                            " href="/admin/mesin">Mesin Investor </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link 
                            {{ (request()->is('admin/income*')) ? 'active' : '' }}
                            " href="/admin/income">Income per Mesin</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link 
                            {{ (request()->is('admin/payment*')) ? 'active' : '' }}
                            " href="/admin/payment">Payment </a>
                        </li>

                        @endif


                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif --}}
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mb-5">
            <div class="mt-5">
                @yield('content')
                @livewireScripts
                <script>
          

                    window.addEventListener('closeModal', event => {
                        $('#exampleModal').modal('hide')
                        $("#alertoi").fadeTo(1000, 500).slideUp(500, function () {
                            $("#alertoi").slideUp(500);
                        });
                    })

                    window.addEventListener('openModal', event => {
                        $('#exampleModal').modal('show')
                    })

                    window.addEventListener('openHapus', event => {
                        $('#delete').modal('show')
                    })

                    window.addEventListener('closeHapus', event => {
                        $('#delete').modal('hide')
                        $("#alertoi").fadeTo(1000, 500).slideUp(500, function () {
                            $("#alertoi").slideUp(500);
                        });
                    })

                </script>

            </div>
        </main>
    </div>

</body>

</html>
