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
                                {{--<div id="vertical">--}}
                                {{--@foreach($product->images as $image)--}}
                                {{--<div data-thumb="{{ asset('thumbnails/'.$image->path) }}" style="text-align: center" >--}}
                                {{--<div class="">--}}
                                {{--<img src="{{ asset('thumbnails/'.$image->path) }}" style=" height: 300px;"/>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endforeach--}}
                                {{--</div>--}}
                                <div class="first-image" style="text-align: center;">
                                    <a data-fancybox="gallery" href="{{ asset('images/'.$product->firstImage->path) }}">

                                        <img src="{{ asset('thumbnails/'.$product->firstImage->path) }}" alt="" style="width: 75%;border: 2px solid #d7d7d7;">
                                    </a>
                                </div>
                                <ul class="thumbs-wrap">
                                    @foreach($product->images as $img)
                                        <li class="thumb" data-id="{{ $img->id }}">
                                            <a data-fancybox="gallery" href="{{ asset('images/'.$img->path) }}">
                                                <img src="{{ asset('thumbnails/'.$img->path) }}">

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
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
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&display=popup"><img src="{{asset('assets/Asset 2@4x.png')}}" alt="" style="width: 40%;height: 40px;    margin-left: 17px;"> </a>

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
                                <img src="{{ App\User::find($product->user_id)->avatar }}" alt=""
                                     style="width: 128px;height: 128px;border-radius: 50%;">
                                <div class="seller_info media-body" style="vertical-align: middle;align-self: center;">
                                    <a href="{{route('bidder.review',['id'=>App\User::find($product->user_id)->id])}}"><span>Seller :{{App\User::find($product->user_id)->username }}</span></a>
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
                    <a href="">See more</a>
                    <hr>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="related-tab" href="#related" aria-controls="related"
                               data-toggle="tab" role="tab" aria-selected="true">Other related products</a>
                        </li>
                        <li>
                            <a class="nav-link" id="nearby-tab" href="#nearby" aria-controls="nearby" data-toggle="tab"
                               role="tab" aria-selected="false">Nearby</a>
                        </li>
                        <li>
                            <a class="nav-link" id="nearby-tab" href="#more" aria-controls="more" data-toggle="tab"
                               role="tab" aria-selected="false">More Products</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="related" role="tabpanel" aria-labelledby="related-tab">
                            No more related products
                        </div>
                        <div class="tab-pane fade" id="nearby" role="tabpanel" aria-labelledby="nearby-tab">
                            No more nearby products
                        </div>
                        <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
                            No more products
                        </div>

                    </div>
                </div>
                    <hr>
                <div class="col-md-2">
                    {{--<img src="{{asset('images/adv.png')}}" style="height: 600px;width:100%;">--}}
                </div>
            </div>
        </div>
    </div></div>
@endsection
@section('additional_js')
    <script>
    </script>
    <script src="{{ asset('js/lightslider.min.js') }}"></script>
    <script src="{{ asset('js/page/product/show.js') }}"></script>
@endsection
