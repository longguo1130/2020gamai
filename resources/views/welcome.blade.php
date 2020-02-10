@extends('layouts.home')

@section('additional_css')
    {{--<style>--}}
        {{--.header img{--}}
            {{--height: 30px;--}}
        {{--}--}}
    {{--</style>--}}
@endsection

@section('content')
    <div class="header">
        <div class="header_row">

            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('images/gamai-logo.png')}}" alt="" style="height: 30px;">

            </a>
            <ul class="navbar-nav ml-auto" style="flex-direction: row;">
                <li class="nav-item">
                    <a class="nav-link nav-search" href="javascript:void(0);" style="padding: 10px;font-size: 1.3em;">
                        <i class="fa fa-search"></i></a>
                    {{--@include('home.nav.search')--}}
                </li>
            @guest
                <li class="nav-item">
                    @include('home.nav.login')
                </li>
                    <li class="nav-item">
                        @include('home.nav.nonuser')
                    </li>
            @else
                <li class="nav-item">
                    @include('home.nav.logged')
                </li>
            @endguest
            </ul>
        </div>
        <div class="search_menu" style="display: none;">
            <form id="product-search-form" action="{{ route('home') }}" method="GET" style="">
                <i class="fa fa-search"></i>
                <input type="text" name="q" class="navbar-search" placeholder="Search stuff" value="{{ $query }}">
            </form>
        </div>
        @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
            <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>

            <script>
                $(function() {
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="margin-top: 10%;">
                <div class="modal-content">
                    <img src="{{asset('assets/gamai-logo.png')}}" alt="">

                </div>
            </div>
        </div>
        <div class="description_container">
            <div class="description">
                <div class="left_desc">
                    <div class="welcome"><h2>Welcome to our site</h2></div>
                    <div class="kind_container">
                        <h3>Buy and sell second hand item</h3>
                        <h3>Post item and start making money</h3>

                        <div class="sell_btn_container">
                            {{--<a href="{{ route('products.create') }}" class="sell_btn">--}}
                                {{--<img src="{{asset('assets/Asset 1@4x.png')}}" alt="Sell Asset" >--}}
                            {{--</a>--}}
                            @guest
                                <li class="nav-item">
                                    @include('home.nav.selllogin')
                                </li>
                            @else
                                <li class="nav-item">
                                    @include('home.nav.selling')
                                </li>
                            @endguest
                            {{--<span class="sell_btn_desc">for 7 days trial</span>--}}
                        </div>
                    </div>
                </div>

                <div class="right_desc">
                    <img class="intro_img" src="{{ asset('uploads/iphone6s-rosegold-300x400.png') }}"/>
                </div>

            </div>

            <div class="container">
                <div class="category_container">
                    <ul class="category_content">
                    @include('home.kind')
                    </ul>
                </div>
            </div>

        </div>

    </div>


    <div class="products-list">
        <div class="container products-container">
            <div class="row">
                <div class="col-md-10">
                    <div class="product_list" data-page="1" data-last_page="1"></div>
                </div>
                <div class="col-md-2">
                    <img src="{{'product_images/adv.png'}}" style="height: 600px;width:100%;">
                </div>


            </div>
        </div>
    </div>


@endsection

@section('additional_js')
    <script>
        var query = '{{ $query }}';
        var bring_products_url = '{{ route('bring.products') }}';
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';
        var set_favor_url = '{{ route('favor.products') }}';


    </script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/front/front.js') }}"></script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>




@endsection

