<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gamay</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app_back.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.4.3.1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    @yield('additional_css')


</head>
<body>
<div id="app">

    <main class="py-4" style="margin-top: 5%;">
        @yield('content')
    </main>

</div>

<!-- jQuery 2.1.4 -->
<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('js/bootstrap.4.3.1.min.js') }}" type="text/javascript"></script>
@yield('additional_js')

</body>
</html>
