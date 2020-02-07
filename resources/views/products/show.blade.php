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
                        <div class="col-sm-6">
                            <div class="product_slider_img">
                                <div id="vertical">
                                    @foreach($product->images as $image)
                                        <div data-thumb="{{ asset('thumbnails/'.$image->path) }}">
                                            <img src="{{ asset('images/'.$image->path) }}" style=" height: 300px;width: 300px;"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group profile-price">
                                <h3 class="" style="display: inline-block;">{{ $product->title }} </h3>
                                <div style="float: right;">
                                    <a href="javascript:void(0)"  data-toggle="modal" data-target="#shareList"><i class="fa fa-share-alt"></i></a>
                                    <a href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="shareList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document" style="margin-top: 10%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2>Share this listing</h2>
                                            </div>
                                            <div class="modal-body">
                                                <a href="http://facebook.com"><img src="{{asset('assets/Asset 2@4x.png')}}" alt="" style="width: 40%;height: 40px;"></a>
                                                <a href="http://facebook.com" ><img src="{{asset('assets/Asset 2@4x.png')}}" alt="" style="width: 40%;height: 40px;"></a>
                                                <div class="copylink" style="text-align: center;margin-top: 10px;width: 93%;">
                                                    <input type="text" value="{{url()->current()}}" id="myInput" style="width: 60%;">
                                                    <button onclick="myFunction()">Copy Link</button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h6>{{ $product->price_format() }} </h6>
                            </div>
                            <div class="form-group">
                                <span style="color:red;">{{ $product->created_date() }}</span>
                            </div>
                            <div class="form-group">
                                <span>{{$product->transaction_type == 1?"FOR:RENT":"FOR:RENT OR SELL"}}</span>
                            </div>


                            <hr>
                            <div class="form-group">
                                <h3>{{$success}}</h3>
                                <a href="{{ route('login') }}" class="btn btn-gray">LOGIN TO BID</a>
                            </div>
                            <hr>
                            <div class="form-group">
                                <p>{{ $product->text }}</p>
                            </div>
                            <hr>
                            <div class="seller_info_wrap media">
                                @if(App\User::find($product->user_id)->provider)
                                    <img src="{{App\User::find($product->user_id)->avatar}}" alt=""
                                         style="width: 128px;height: 128px;border-radius: 50%;">
                                @else
                                    <img src="{{ asset('avatars/'.App\User::find($product->user_id)->avatar) }}" alt=""
                                         style="width: 128px;height: 128px;border-radius: 50%;">
                                @endif
                                <div class="seller_info media-body" style="vertical-align: middle;align-self: center;">
                                    <span>Seller Name :{{App\User::find($product->user_id)->name }}</span>
                                    <div class="star-ratings-sprite"><span style="width:{{App\User::find($product->user_id)->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-other-wrap py-4">
        <div class="container py-4">
            <div class="row ">
                <div class="col-md-10">
                    <div class="product_list"></div>
                    <a href="">See more</a>
                    <hr>
                </div>
                <div class="col-md-2">
                    <img src="{{asset('images/adv.png')}}" style="height: 600px;width:100%;">
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
