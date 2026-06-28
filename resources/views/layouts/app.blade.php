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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .stars {
            width: 100vw;
            height: 100px;
            position: absolute;
        }
        .wrap {
            z-index:1;
        }
        .star {
            background: url(http://zhemch.gin-ger.ru/flower.png);
            background-size: cover;
            position: fixed;
            /*margin: 10px;*/
            transition: 10s;
            opacity: 0.3;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            z-index:0;
        }
        .wrap {
            overflow-x: auto;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img width="40" src="/spring.png" width="50" style="margin-right: 50px;">

                <a href="/"><img src="https://sun9-75.userapi.com/impf/c834401/v834401860/15e3a/1HQU-FsBSfU.jpg?size=447x450&quality=96&sign=57ba5993179afe055bbea3f95c120df9&type=album" width="50" style="margin-right: 50px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('timetable', 1) }}">{{ __('Расписание зал 1') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('timetable', 2) }}">{{ __('Расписание зал 2') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dancers') }}">{{ __('Танцоры') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('type') }}">{{ __('Направления') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('group') }}">{{ __('Группы') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('trainer') }}">{{ __('Тренера') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('journal') }}">{{ __('Журнал') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('journalall') }}">{{ __('Журнал записи') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sub') }}">{{ __('Абонементы') }}</a>
                        </li>

                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
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

        <main class="py-4" style="background: #2C3034; min-height:100vh;">
            @yield('content')
        </main>
    </div>
    <div class="stars">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
        <!--<div class="star"></div>-->
    </div>
    <script>
        $(document).ready(function() {
            // Светлячки
            function getRandomArbitrary(min, max) {
                return Math.random() * (max - min) + min;
            }
            $(document).ready(function() {
                $('body .star').each(function() {
                    var top = getRandomArbitrary(2, 98);
                    var right = getRandomArbitrary(2, 98);
                    $(this).css({
                        top: top + 'vh',
                        right: right + 'vw'
                    });
                });
                setTimeout(function() {
                    $('body .star').each(function() {
                        var top = getRandomArbitrary(2, 98);
                        var right = getRandomArbitrary(2, 98);
                        $(this).css({
                            top: top + 'vh',
                            right: right + 'vw'
                        });
                    });
                }, 100)
                setInterval(function() {
                    $('body .star').each(function() {
                        var top = getRandomArbitrary(2, 98);
                        var right = getRandomArbitrary(2, 98);
                        $(this).css({
                            top: top + 'vh',
                            right: right + 'vw'
                        });
                    });
                }, 10000)
            })
        });
    </script>
    <style>
        .wrap {
            padding: 20px;
            background: white;
            margin: 40px;
        }

        .btn {
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 10px !important;
        }
    </style>


</body>

</html>