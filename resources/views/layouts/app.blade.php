<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Gamai</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('assets/gamai app icon 1024[487].png')}}">
    @if(!empty($product))
        <meta property="og:url"           content="https://gamai.co/products/show/1" />
        <meta property="og:type"          content="article" />
        <meta property="og:title"         content="{{$product->title}}" />
        <meta property="og:description"   content="{{$product->text}}" />
        <meta property="og:image"         content="https://gamai.co/products/show/1" />
    @endif


    <!-- Scripts -->

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.4.3.1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <link href="{{ asset('css/drop-down.css') }}" rel="stylesheet">

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
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dropdown-script.js') }}"></script>

<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap JS -->
{{--<script src="{{ asset('js/bootstrap.4.3.1.min.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('plugins/fancybox-master/dist/jquery.fancybox.min.js') }}" type="text/javascript"></script>
<script>
    var base_url = '{{ url("/") }}';
    var set_favor_url = '{{ route('favor.products') }}';
    var query = '';
    var bring_products_url = '{{ route('bring.products') }}';
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
@if(Auth::check())
    <script>
        let userId = '{{Auth::user()->id}}';

        if(userId){
            window.Echo.private('App.User.' + userId).notification((notifiable) => {

                var count = '{{Auth::user()->unreadNotifications->count()+1}}';
                $('.badge').text(count);
                var message = '<a class="dropdown-item" href="/products/'+notifiable.product_id+'">'+notifiable.message+'</a>'
                $('#notificationlist').prepend(message);
            });
        }



    </script>
@endif
@if(!empty($product))<script>
    var product_related_url = '{{ route('product.related.detail') }}';

    var product_id = '{{$product->id}}';
    $(function () {

        $.ajax({
            url: product_related_url,
            type: "get",
            datatype: "json",
            data: {'id':product_id},
            success:function(data) {
                $('#related').html(data.related_html);
                $('#nearby').html(data.nearby_html);
                $('#more').html(data.more_html);
            }

        });
    });

</script>
@endif
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{ asset('js/page/front/front.js') }}"></script>

<script src="{{ asset('js/chat.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>

<script src="{{ asset('js/lightslider.min.js') }}"></script>
<script src="{{ asset('js/page/product/show.js') }}"></script>


@yield('additional_js')

</body>
</html>
