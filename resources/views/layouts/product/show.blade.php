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
                                            <img src="{{ asset('images/'.$image->path) }}" style=" height: 300px;"/>
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
                <div class="col-md-10">
                    <div class="bidder_list">
                     @if(!is_null($bid))

                    @foreach($bid as $post)
                        <div class="bidder_content">
                            <div class="title">
                                <span>Bid:{{$post->bid_price}} </span><span>Duration:{{$post->duration}} </span>
                                <span><a href="{{route('bidder.review',['id'=>App\User::where('id',$post->buyer_id)->first()->id])}}">{{App\User::where('id',$post->buyer_id)->first()->rating*20}}% Positive</a></span>
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

                                    <span class="accept-button"><a href="javascript:void(0);" class="chat-toggle" data-id="{{ $post->buyer_id }}" data-user="{{App\User::where('id',$post->buyer_id)->first()->username}}">Open chat</a></span>
                                    @else
                                    <span class="accept-button"><a href="{{route('bidders.accept',['buyer_id'=>$post->buyer_id,'id'=>$post->product_id])}}">Accept</a></span>
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
