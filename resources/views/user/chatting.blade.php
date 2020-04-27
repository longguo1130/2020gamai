@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat_full.css') }}" rel="stylesheet">

@endsection
@section('content')


    <div id="frame">
        <div id="sidepanel" >
            <div id="profile">
                <div class="wrap">
                    <h3>Chat</h3>


                </div>

               <ul style="display: flex; list-style: none;padding-left: 0px; justify-content: space-around; margin: 0 -20px;" class="chat-group">
                   <li  data-status="group-all">All</li>
                   <li  data-status="group-selling">Selling</li>
                   <li  data-status="group-buying">Buying</li>
               </ul>
            </div>
            <div id="contacts">
                <ul class="contact-list">

                    @foreach($bid as $bidder)

                            <li class="contact  {{$bidder->getStatus()}} chat-toggle-man" data-id="{{ $bidder->getInfo()->id }}"
                                data-product="{{ $bidder->productInfo->id }}" data-bid="'{{$bidder->id}}">

                                <div class="wrap">


                                    <a href="{{route('products.show',['id'=>$bidder->productInfo->id])}}"><img src="{{asset('images/'.$bidder->productInfo->firstImage->path)}}" alt="" style="height: 40px;"></a>
                                    @if(App\Product::where('id',$bidder->product_id)->first())<a href="{{route('products.show',['id'=>$bidder->productInfo->id])}}">{{App\Product::where('id',$bidder->product_id)->first()->title}}</a>@endif
                                    <a href="{{route('transaction.delete',['id'=> $bidder->getInfo()->id])}}" class="btn btn-gray delete_transaction">Delete</a>

                                    
                                </div>

                            </li>

                    @endforeach


                </ul>
            </div>

        </div>
        <div class="content">
            <div class="row contact-profile">

                <div class="my-info col-md-4 col-sm-4 col-4">

                    <img src="{{Auth::user()->avatar}}"  alt="" ><span>{{Auth::user()->username}}</span>

                </div>
                <div class="transaction-action col-md-7 col-sm-7 col-8">

                </div>

            </div>
            <div class="messages {{Auth::user()->id}}">

            </div>
            <div class="message-input">
                <div class="wrap">
                    <input type="text" placeholder="Write your message..." class="full-chat-input"/>

                    <button class="full-btn-chat" data-to-user="" data-product="" data-user="{{Auth::user()->avatar}}">Send</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('additional_js')
    <script>
        var profile_url = '{{ route('profile') }}/';
        var delete_chat_url  = '{{route('chat.delete')}}/';
    </script>
    <script src="{{ asset('js/lightslider.min.js') }}"></script>
    <script src="{{ asset('js/page/product/show.js') }}"></script>
    <script src="{{ asset('js/chat_full.js') }}"></script>
@endsection
