<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



    <!-- Scripts -->
 
    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/js/Test.js',
        ])

    <style>
        .form-control {
            box-shadow: none !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}-developer-option
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                          

                            @auth
                           <li class="nav-item">
                               <a href="{{ route("app.home") }}" class="nav-link">Dashbord</a>
                           </li>

                           <li class="nav-item">
                            <a href="{{ url("Youtube/index") }}" class="nav-link">Youtube-api</a>
                        </li>
                     
                           <li class="nav-item">
                            <a href="{{ url("EventTutorial") }}" class="nav-link">Even/Listener</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url("EventTutorial/listen") }}" class="nav-link">Listen</a>
                                </li>
                           @endauth

                           @guest
                           @if (!Route::is('app.create'))
                           <li class="nav-item">
                               <a href="{{ route("app.create") }}" class="nav-link">register</a>
                           </li>
                           @endif

                           @if (!Route::is('app.login'))
                           <li class="nav-item">
                               <a href="{{ route("app.login") }}" class="nav-link">Login</a>
                           </li>
                           @endif
                           @endguest


                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
    
                                        <form action="{{ Route("logout") }}" 
                                        method="POST" class="form">
                                            @csrf
                                            <button type="submit" 
                                            class="btn btn-sm ms-2"
                                            href="">Logout</button>
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
