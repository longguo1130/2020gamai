@extends('layouts.home')


@section('content')
    <div class="header">

        <div class="header_row" style="background:transparent!important">

            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('assets/gamai-logo.png')}}" alt="" style="height: 30px;">

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

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-bell"></i>

                            <sup><span class="badge badge-danger">@if(Auth::user()->unreadNotifications->count()){{ Auth::user()->unreadNotifications->count()  }}@endif</span></sup>
                        </a>

                        <div id="notificationlist" class="text-center notificationBox dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach(Auth::user()->unreadNotifications as $notifications)

                                <a class="dropdown-item" href="{{route('products.show',['id'=>$notifications->data['product_id']])}}">
                                    {{$notifications->data['message']}}
                                </a>
                            @endforeach
                            {{-- <a href="{{route('MarkAsRead')}}" class="text-center btn btn-link">Mark All as Read</a> --}}
                        </div>
                    </li>
                <li class="nav-item">
                    @include('home.nav.logged')
                </li>
                    @include('chat.chat-box')


                    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />

                    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
                    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />

                    <div id="chat-overlay" class="row"></div>
            @endguest
            </ul>


        </div>
        <div class="search_menu" style="display: none;">
            <form id="product-search-form" action="{{ route('home') }}" method="GET" style="">
                <i class="fa fa-search"></i>
                <input type="text" name="q" class="navbar-search" placeholder="Search stuff" value="{{ $query }}">
            </form>
        </div>

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <img src="{{asset('assets/welcome.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="description_container">
            <div class="description">
                <div class="left_desc" style="padding: 10px">
                    <div class="welcome"><h2>Where Everything has Value!</h2></div>
                    <div class="kind_container">
                        <h4>Buy and sell second hand item</h4>
                        <h4>Post item and start making money</h4>
                        <h4>Your Gamai, your way!</h4>

                        <div class="sell_btn_container">

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
                <div class="col-lg-12 col-sm-12 col-12 col-md-12">
                    <div class="product_list" data-page="1" data-last_page="1"></div>
                </div>
                <!--<div class="col-md-2">-->
                <!--    {{--<img src="{{'product_images/adv.png'}}" style="height: 600px;width:100%;">--}}-->
                <!--</div>-->


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
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.4.3.1.min.js') }}" type="text/javascript"></script>

        <script>
            $(function() {
                $('#loginModal').modal('show');
            });
        </script>
    @endif

    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/front/front.js') }}"></script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=427109905679-kqja0l1rg1m0llcbnnk0jlst5h5cacsl &libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        function initAutocomplete(){
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };

            var input = document.getElementById('autocomplete');
            var input1 = document.getElementById('autocomplete1');
            input.setAttribute('placeholder','Enter the street address (e.g. 2401 Tampa Dr, Orlando Fl 34219)');
            if (input1 != null) {

                input1.setAttribute('placeholder','Enter the street address (e.g. 2401 Tampa Dr, Orlando Fl 34219)');
                var autocomplete1 = new google.maps.places.Autocomplete(input1, {types: ['geocode']});

            }

            var autocomplete = new google.maps.places.Autocomplete(input, {types: ['geocode']});

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var data = $(".city_select").val();

                $('.city_select').closest('.dropdown-menu').removeClass('show');
                $('.city_select').closest('.category_item').find('.bottom_cat_name').html(data);
                Front.bringContent(1);

            });
        }
    </script>




@endsection

