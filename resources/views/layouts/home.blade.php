<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url"                content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Rajdowy Puchar Śląska" />
    <meta property="og:image" content="{{ asset('/images/logo.png') }}" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css"> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-75301544-8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-75301544-8');
    </script> 
</head>
<body class="front">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.1&appId=1689435341383453&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div id="app">
        @if($banner && $banner->active)
            <div class="text-center p-2 bg-danger">
                <strong class="text-white">{{ $banner->value }}</strong>
            </div>
        @endif
        <header>
            <a class="navbar-brand d-block d-xl-none text-center" href="{{ url('/') }}">
                <img src="/images/logo.png">
            </a>
            <nav class="navbar navbar-dark navbar-expand-md text-white shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand d-none d-xl-block" href="{{ url('/') }}">
                        <img src="/images/logo.png">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav">
                            <li><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                            <li><a class="nav-link" href="{{ url('video') }}">Live video</a></li>
                            <li><a class="nav-link" href="{{ url('live_wyniki') }}">Live wyniki</a></li>
                            <li><a class="nav-link" href="{{ url('wyniki') }}">Wyniki</a></li>
                            <li><a class="nav-link" href="{{ url('terminarz') }}">Terminarz</a></li>
                            <li><a class="nav-link" href="{{ url('aktualnosci') }}">Aktualności</a></li>
                            <li><a class="nav-link" href="{{ route('kierowcy') }}">Kierowcy</a></li>
                            <li><a class="nav-link" href="{{ route('piloci') }}">Piloci</a></li>
                            <li><a class="nav-link" href="{{ route('teams') }}">Teams</a></li>
                            <li><a class="nav-link" href="{{ url('dokumenty') }}">Dokumenty</a></li>
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                {{-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> --}}
                            @else
                                @if(!auth()->user()->admin)
                                    <li class="nav-y"><a class="nav-link" href="{{ route('home') }}">Rajdy</a></li>
                                    <li class="nav-y nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->login }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @if(auth()->user()->driver == 1)
                                                <a class="dropdown-item" href="{{ route('profile') }}">Profil kierowcy</a>
                                                <a class="dropdown-item" href="{{ route('pilots') }}">Piloci</a>
                                                <a class="dropdown-item" href="{{ route('cars') }}">Samochody</a>
                                                <a class="dropdown-item" href="{{ route('userTeam') }}">Team</a>
                                            @elseif(auth()->user()->driver == 2)
                                                <a class="dropdown-item" href="{{ route('profile') }}">Profil redakcji</a>
                                                <a class="dropdown-item" href="{{ route('staff') }}">Dziennikarze</a>
                                            @else
                                                <a class="dropdown-item" href="{{ route('profile') }}">Profil pilota</a>
                                                <a class="dropdown-item" href="{{ route('userTeam') }}">Team</a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('settings') }}">Ustawienia konta</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item dropdown nav-y">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Zarządzaj witryną <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('partners') }}">Partnerzy</a>
                                            <a class="dropdown-item" href="{{ route('news') }}">Aktualności</a>
                                            <a class="dropdown-item" href="{{ route('docs') }}">Dokumenty</a>
                                            <a class="dropdown-item" href="{{ route('banner') }}">Baner z informacją</a>
                                            <a class="dropdown-item" href="{{ route('contactInfo') }}">Dane kontaktowe</a>
                                            <a class="dropdown-item" href="{{ route('edit_live_video') }}">Video Live</a>
                                            <a class="dropdown-item" href="{{ route('edit_live_wyniki') }}">Wyniki Live</a>
                                            <a class="dropdown-item" href="{{ route('edit_promoted') }}">Promowani kierowcy</a>
                                            <a class="dropdown-item" href="{{ route('edit_terms') }}">Regulamin</a>
                                            <a class="dropdown-item" href="{{ route('drivers') }}">Zawodnicy</a>
                                            <a class="dropdown-item" href="{{ route('races') }}">Rajdy</a>
                                            <a class="dropdown-item" href="{{ route('adminTeams') }}">Teamy</a>
                                            <a class="dropdown-item" href="{{ route('tables') }}">Tabele do transmisji</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown nav-y">
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
        </header>

        @include('messages')

        <main>
            <div class="main-content">
                @yield('content')
            </div>

            @include('partials.partners')

            @include('partials.contact')
        </main>
    </div>
    
</body>
</html>
