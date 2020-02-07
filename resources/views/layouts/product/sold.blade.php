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
                                        <div data-thumb="{{ asset('thumbnails/'.$image->path) }}">
                                            <img src="{{ asset('images/'.$image->path) }}"/>
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
    <div class="product-other-wrap py-4">
        <div class="container py-4">
            <h3>Awarded Bidder</h3>
            <div class="row ">
                <div class="col-md-10">
                    <div class="bidder_list">
                        @if(!is_null($bid))

                            @foreach($bid as $post)
                                <div class="bidder_content">
                                    <div class="title">
                                        <span>Bid:{{$post->bid_price}} </span><span>Duration:{{$post->duration}} </span><span>100% Positive</span>
                                        @if($post->buyer_id == Auth::user()->id)
                                            <span><a href="{{route('bidders.edit',['id'=>$post->id])}}">Edit your bid</a></span>
                                            <span><a href="{{route('bidders.destroy',['id'=>$post->id])}}">Delete your bid</a></span>
                                        @endif

                                        @if($post->seller_id == Auth::user()->id)
                                            @if($post->status == 2)

                                                <span><a href="">Chat</a></span>
                                            @else
                                                <span>Awarded</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="note">
                                        <p><b>Note:{{$post->comments}}</b>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
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
                        <!--<li>-->
                        <!--    <a class="nav-link" id="owner-tab" href="#owner" aria-controls="owner" data-toggle="tab"-->
                    <!--       role="tab" aria-selected="false">Posted by {{ Auth::user()->name }}</a>-->
                        <!--</li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="related" role="tabpanel" aria-labelledby="related-tab">
                        </div>
                        <div class="tab-pane fade" id="nearby" role="tabpanel" aria-labelledby="nearby-tab">
                            Sold...
                        </div>
                        <div class="tab-pane fade" id="owner" role="tabpanel" aria-labelledby="owner-tab">
                            Favor...
                        </div>
                    </div>
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
