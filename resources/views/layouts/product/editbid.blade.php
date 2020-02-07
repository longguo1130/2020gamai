@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="product-detail-wrap my-n4 py-5">
        <div class="container">
            <div class="content">
                <div class="form-wrap">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="product_slider_img">
                                <div id="vertical">
                                    @foreach($product->images as $image)
                                        <div data-sthumb="{{ asset('thumbnails/'.$image->path) }}">
                                            @if(!empty($image->path))
                                                <img src="{{ asset('thumbnails/'.$image->path) }}"/>
                                            @else
                                                <img src="{{asset('images/no-image.png')}}" alt="">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group profile-price">
                                <h3 class="" style="display: inline-block;">{{ $product->title }} posted by {{$product->seller}}</h3>
                                <div style="float: right;">
                                    <a href=""><i class="fa fa-share-alt"></i></a>
                                    <a href=""><i class="fa fa-heart-o"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <h2>{{ $product->price_format() }}</h2>
                            </div>

                            <div class="form-group">
                                <span>{{ $product->created_date() }}</span>
                            </div>
                            <hr>

                            @yield('main_content')

                        </div>
                    </div>
                </div>
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
