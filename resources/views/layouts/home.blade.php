<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta name="google-signin-client_id" content="427109905679-kqja0l1rg1m0llcbnnk0jlst5h5cacsl.apps.googleusercontent.com">--}}
    <link rel="icon" type="image/png" href="{{asset('assets/gamai app icon 1024[487].png')}}">
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
                <img src="{{asset('assets/gamai-logo.png')}}" alt="" style="height: 30px; margin-top: 10px;">
            </a>
            <div class="right-corner">

                <a href="{{ route('products.create') }}" class="" >
                    <img src="{{asset('assets/Asset 1@4x.png' )}}" style="height: 25px;" alt="">
                </a>



                <!-- Authentication Links -->
                @guest

                    <a class="nav-login-btn" href="{{ route('login') }}">{{ __('Login') }}
                        <i class="fa fa-user-alt"></i>
                    </a>

                @else
                    <a href="{{url('profile')}}">
                        <img src="{{Auth::user()->avatar}}" alt="" style="height: 30px;border-radius: 50px;width: 30px;">

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
{{--<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>--}}
<script>
    var base_url = '{{ url("/") }}';
    $(function () {

        var buttons = $('a');
        $.each(buttons,function () {
            $(this).on('click',function () {
                var item = $(this)[0];
                $(this)[0].style.cssText = 'filter: brightness(0.7);';
                setTimeout(function () {
                    item.style.cssText = 'filter: brightness(1);';
                },50)

            })
        })
    })

</script>
<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap JS -->
{{--<script src="{{ asset('js/bootstrap.4.3.1.min.js') }}" type="text/javascript"></script>--}}
@if(Auth::check())
    <script>
        let userId = '{{Auth::user()->id}}';
        let sub_category_url = '{{route('get.sub_category')}}';
        if(userId){
            window.Echo.private('App.User.' + userId).notification((notifiable) => {
                console.log(notifiable);
                var count = '{{Auth::user()->unreadNotifications->count()+1}}';
                $('.badge').text(count);
                var message = '<a class="dropdown-item" href="/products/'+notifiable.product_id+'">'+notifiable.message+'</a>'
                $('#notificationlist').prepend(message);
            });
        }
        $(function () {
           $('#category_id').on('change',function () {
               var parent_id = $(this).val();

               $.ajax({
                   url:sub_category_url,
                   data:{'parent_id':parent_id},
                   method: 'get',
                   success:function (response) {
                       $("#sub_category_id").empty();
                       $("#sub_category_id").append("<option value='0'>Select Sub-Category</option>");
                       var data = response.data;
                       for (var i = 0; i<data.length;i++){
                           $('#sub_category_id').append('<option value="'+data[i].parent_id+'">'+data[i].category+'</option>');
                       }
                   },

               });
           })
        })
    </script>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>

@endif
{{--<script src="https://js.pusher.com/4.1/pusher.min.js"></script>--}}




@yield('additional_js')

</body>
</html>
