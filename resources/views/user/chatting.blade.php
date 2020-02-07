@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat_full.css') }}" rel="stylesheet">

@endsection
@section('content')


    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                <div class="wrap">
                    <h3>Chats</h3>


                </div>

               <ul style="display: flex; list-style: none;padding-left: 0px; justify-content: space-around; margin: 0 -20px;" class="chat-group">
                   <li  data-status="group-all">All</li>
                   <li  data-status="group-selling">Selling</li>
                   <li  data-status="group-buying">Buying</li>
                   <li  data-status="group-blocked">Blocked</li>
               </ul>
            </div>
            <div id="contacts">
                <ul class="contact-list">
                    <li class="contact choose-option" style="display: flex;justify-content: space-around" hidden >
                        <div class="choose-options-back" style="width: 50px; margin-top: 17px;">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </div>
                        <div class="choose-options-viewprofile">
                            <a href="" class="viewprofile"><img src="{{asset('avatars/default.png')}}" alt="" width="30px;"><p>view profile</p></a>
                        </div>
                        <div class="choose-options-block">
                            <img src="{{asset('avatars/default.png')}}" alt="" width="30px;"><p>block</p>
                        </div>
                        <div class="choose-options-delete">
                            <a href="" class="delete-chat"><img src="{{asset('avatars/default.png')}}" alt="" width="30px;"><p>delete chat</p></a>
                        </div>
                    </li>

                    @foreach($bid as $bidder)

                            <li class="contact  {{$bidder->getStatus()}} chat-toggle-man" data-id="{{ $bidder->getInfo()->id }}"
                                data-user="{{ $bidder->getInfo()->id }}">

                                <div class="wrap">
                                    {{--<span class="contact-status online"></span>--}}
                                    @if($bidder->getInfo()->provider)
                                        <img src="{{$bidder->avatar()}}" alt="" style="height: 40px;">
                                    @else
                                    <img src="{{asset('avatars/'.$bidder->avatar())}}" alt="" style="height: 40px;"/>
                                    @endif
                                    <div class="meta">
                                        <p class="name">{{$bidder->getInfo()->name}}</p>
                                        <a href="javascript:void(0)" class="view-option" data-id = "{{$bidder->getInfo()->id}}"><img src="{{asset('assets/toggle.png')}}"  alt="" style="margin-top: -50px; float: right ;"></a>

                                    </div>
                                </div>

                            </li>

                    @endforeach


                </ul>
            </div>

        </div>
        <div class="content">
            <div class="contact-profile">
                <img src="{{asset('avatars/'.Auth::user()->avatar)}}" alt="" style="height: 50px;width: 50px;"/>
                <p>{{Auth::user()->username}}</p>
                <div class="social-media">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </div>
            </div>
            <div class="messages {{Auth::user()->id}}">

            </div>
            <div class="message-input">
                <div class="wrap">
                    <input type="text" placeholder="Write your message..." class="full-chat-input"/>

                    <button class="full-btn-chat" data-to-user="">Send</button>
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
