<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gamai</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.4.3.1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    @yield('additional_css')

</head>
<body>
<header class="main_menu" style="display: none;">
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container_header" >
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('images/gamai-logo.png')}}" alt="" style="height: 30px; margin-top: 10px;">
            </a>
            <div class="right-corner">

                <a href="{{ route('products.create') }}" class="sell_btn" >
                    <img src="{{asset('assets/Asset 1@4x.png' )}}" style="height: 25px;" alt="">
                </a>



                <!-- Authentication Links -->
                @guest

                    <a class="nav-login-btn" href="{{ route('login') }}">{{ __('Login') }}
                        <i class="fa fa-user-alt"></i>
                    </a>

                @else
                    <a href="{{url('profile')}}">
                    @if(Auth::user()->provider)
                        <img src="{{Auth::user()->avatar}}" alt="" style="height: 30px;border-radius: 50px;width: 30px;">
                        @else
                        <img src="{{asset('avatars/'.Auth::user()->avatar)}}" alt="" style="height: 30px;border-radius: 50px;width: 30px;">
                        @endif
                    </a>
                @endguest
            </div>




        </div>
    </nav>
</header>




<div id="app">
    <main class="">
        @yield('content')
    </main>

    @include('layouts.footer')
</div>

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.js') }}" type="text/javascript"></script>

@yield('additional_js')

</body>
</html>
