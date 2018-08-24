<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
</head>
<body>
    <div id="app">
        @if($banner->active)
            <div class="text-center p-2 bg-warning">
                <strong>{{ $banner->value }}</strong>
            </div>
        @endif
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li><a class="nav-link" href="{{ url('aktualnosci') }}">Aktualności</a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            @if(!auth()->user()->admin)
                                <li><a class="nav-link" href="{{ route('home') }}">Rajdy</a></li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->login }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('driver-profile') }}">Profil kierowcy</a>
                                        <a class="dropdown-item" href="{{ route('pilots') }}">Piloci</a>
                                        <a class="dropdown-item" href="{{ route('cars') }}">Samochody</a>
                                        <a class="dropdown-item" href="{{ route('settings') }}">Ustawienia konta</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Zarządzaj witryną <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('partners') }}">Partnerzy</a>
                                        <a class="dropdown-item" href="{{ route('news') }}">Aktualności</a>
                                        <a class="dropdown-item" href="{{ route('banner') }}">Baner z informacją</a>
                                        <a class="dropdown-item" href="{{ route('contactInfo') }}">Dane kontaktowe</a>
                                    </div>
                                </li>
                                <li><a class="nav-link" href="{{ route('drivers') }}">Zawodnicy</a></li>
                                <li><a class="nav-link" href="{{ route('races') }}">Rajdy</a></li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->login }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('settings') }}">Ustawienia konta</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @endguest
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </nav>

        @include('messages')

        <main class="py-4">
            @yield('content')
        </main>

        <p class="craft text-white">Crafted by <a href="//efabryka.net" title="efabryka.net" alt="efabryka" target="_blank" rel="nofollow">efabryka.net</a></p>
    </div>
    
</body>
</html>
