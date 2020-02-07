<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gamai</title>

    <!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.4.3.1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">

    @yield('additional_css')


</head>
<body>
<div id="app">

    @include('layouts.header')

    <main class="py-4">
        @yield('content')
    </main>
    @include('layouts.footer')

</div>

<!-- jQuery 2.1.4 -->
<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.4.3.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.js') }}" type="text/javascript"></script>
<script>
    var base_url = '{{ url("/") }}';
</script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script src="{{ asset('js/chat.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>



@yield('additional_js')

</body>
</html>
