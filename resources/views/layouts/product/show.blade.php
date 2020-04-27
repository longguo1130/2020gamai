@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">
    <style>
        .tooltip1{
            display: inline;
        }
        .tooltip1 .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        .tooltip1:hover .tooltiptext {
            visibility: visible;
        }
    </style>
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
                                <div class="first-image" style="margin: auto;width: 50%">
                                    <a data-fancybox="gallery" href="{{ asset('images/'.$product->firstImage->path) }}">

                                        <img src="{{ asset('thumbnails/'.$product->firstImage->path) }}" alt="" style="width: 100%;border: 2px solid #d7d7d7;">
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
                                    <div class="fb-share-button"
                                         data-href="{{url()->current()}}"
                                         data-layout="button_count">
                                    </div>
                                    @if(!(Auth::user()))
                                        <a  href="{{ route('login') }}" class="favor_btn favor_btn_{{ $product->id }}" data-id="{{ $product->id }}" data-user="">
                                            <img src="{{asset('assets/heart.png')}}" alt="" style="height: 20px">
                                        </a>
                                    @else

                                        <a  href="javascript:void(0);" class= "favor_btn_detail favor_btn_{{ $product->id }}" data-id="{{ $product->id }}" data-user="{{ Auth::user()->id }}">
                                            {{--<i class="fa fa-heart{{ in_array($post->id,$favorites)? '' : '-o' }}"></i>--}}
                                            @if(in_array($product->id,App\Favorite::where('user_id',Auth::user()->id)->pluck('product_id')->all()))
                                                <img src="{{asset('assets/heart-o.png')}}" alt="" style="height: 20px;">
                                            @else
                                                <img src="{{asset('assets/heart.png')}}" alt="" style="height: 20px; ">
                                            @endif

                                        </a>
                                    @endif
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="shareList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document" style="margin-top: 10%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2>Share this listing</h2>
                                            </div>
                                            <div class="modal-body">
                                                <div class="fb-share-button"
                                                     data-href="https://gamai.co/products/show/1"
                                                     data-layout="button_count">
                                                </div>
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

                            @yield('main_content')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-other-wrap py-4">
        <div class="container py-4">
            <h4>Active Bidders</h4>
            <div class="row ">
                <div class="col-md-12">
                    <div class="bidder_list">
                     @if(!is_null($bid))

                    @foreach($bid as $post)
                        <div class="bidder_content">
                            <div class="title">
                                <span>Bid:{{$post->bid_price}}&#8369; </span><span>Duration:{{$post->duration}} </span>
                                <span><a href="{{route('bidder.review',['id'=>App\User::where('id',$post->buyer_id)->first()->id])}}">{{App\User::where('id',$post->buyer_id)->first()->rating*20}}% Positive</a></span>
                                @if(App\User::where('id',$post->buyer_id)->first()->membership)

                                  <div class="tooltip1"><img src="{{asset('assets/'.App\Membership::where('id',App\User::where('id',$post->buyer_id)->first()->membership)->first()->icon)}}" alt="" style="height: 30px;" ><span class="tooltiptext">{{App\Membership::where('id',App\User::where('id',$post->buyer_id)->first()->membership)->first()->membership_status}}</span></div>
                                @endif
                                @if($post->buyer_id == Auth::user()->id)
                                    @if($post->status == 1)
                                    <span>Your bid Awarded</span>

                                    @elseif($post->status ==0)

                                        <select name="active" id="active" onchange="location = this.value;" class="bid-modify">
                                            <option value="0">Modify</option>
                                            <option value="{{route('bidders.edit',['id'=>$post->id])}}">Edit</option>
                                            <option value="{{route('bidders.destroy',['id'=>$post->id])}}">Delete</option>


                                        </select>
                                     @else
                                        <span>your bid was accepted</span>
                                    @endif
                                @endif

                                @if($post->seller_id == Auth::user()->id)
                                    @if($post->status == 2)

                                    <span class="accept-button"><a href="javascript:void(0);" class="chat-toggle" data-product="{{$post->product_id}}" data-id="{{ $post->buyer_id }}" data-user="{{App\User::where('id',$post->buyer_id)->first()->username}}">Open chat</a></span>
                                    @else
                                        @if(App\Product::where('id',$post->product_id)->first()->status == 0)
                                            <span class="accept-button"><a id="first_message" href="{{route('bidders.accept',['buyer_id'=>$post->buyer_id,'id'=>$post->product_id])}}" data-to-user="{{App\User::where('id',$post->buyer_id)->first()->id}}" data-product = "{{$post->product_id}}">Accept</a></span>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            <div class="note">
                                <p>Note:{{$post->comments}}</p>
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
                        {{--<div class="tab-pane fade" id="owner" role="tabpanel" aria-labelledby="owner-tab">--}}
                            {{--Favor...--}}
                        {{--</div>--}}
                    </div>
                </div>
                {{--<div class="col-md-2">--}}
{{--                    <img src="{{asset('images/adv.png')}}" style="height: 600px;width:100%;">--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

@endsection
@section('additional_js')

@endsection
