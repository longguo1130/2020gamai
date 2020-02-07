@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="product-success">
        <div class="container">
            <div class="row ">
                <div class="success col-8">
                    <div class="success-dialog">
                        <h2>Congratulations!</h2>
                        <h5>Your listing has posted</h5>
                        <h6><b><a href="{{url('/')}}">Go to Homepage</a></b></h6>
                        <h5>OR</h5>
                        <a href="{{route('products.create')}}" class="sell_btn">Post another listing</a>
                        <div class="footer-social">
                            <a href="http://facebook.com">
                                <img src="{{asset('assets/Asset 11@4x.png')}}" alt="" height="20px">
                            </a>
                            <a href="http://linkedin.com">
                                <img src="{{asset('assets/Asset 12@4x.png')}}" alt="" height="20px">
                            </a>
                            <a href="http://twitter.com">
                                <img src="{{asset('assets/Asset 13@4x.png')}}" alt="" height="20px">
                            </a>
                            <a href="http://youtube.com">
                                <img src="{{asset('assets/Asset 14@4x.png')}}" alt="" height="20px">
                            </a>

                        </div>
                        <h5>Share the listing with your friends</h5>
                    </div>
                </div>
                <div class="overlay_success"></div>
            </div>
        </div>
    </div>

@endsection
@section('additional_js')
    <script>

    </script>
    <script src="{{ asset('js/lightslider.min.js') }}"></script>
    <script src="{{ asset('js/page/product/show.js') }}"></script>
@endsection
