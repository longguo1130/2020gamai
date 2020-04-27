
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding-top:4px;padding-bottom:4px;background: #FAF0E6!important;">

    <div class="header_row ">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{asset('assets/gamai-logo.png')}}" alt="" style="height: 30px;">

        </a>
        <ul class="navbar-nav ml-auto" style="flex-direction: row;">
            <a href="{{ route('products.create') }}"  >
                <img src="{{asset('assets/Asset 1@4x.png' )}}" style="height: 30px; margin-top: 4px;" alt="">
            </a>
            @guest
                <li class="nav-item">
                    @include('home.nav.login')
                    {{--<a id=""  href="javascript:void(0);" onclick="showLogin()"><img src="{{asset('assets/Asset 5@4x.png')}}" alt="" height="40px"></a>--}}
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

                            <a class="dropdown-item" href="{{route('products.show',['id'=>$notifications->data['product_id']])}}" id="first_click_notification">
                                {{$notifications->data['message']}}
                            </a>
                        @endforeach
                        {{-- <a href="{{route('MarkAsRead')}}" class="text-center btn btn-link">Mark All as Read</a> --}}
                    </div>
                </li>
                <li>
                    @if(Auth::user()->user_role == 1)
                        <a href="{{route('admin' ,['admin'=>Auth::user()->user_role])}}" class="btn btn-success" style="height: 30px;margin-top: 4px;margin-left: 4px;padding: 3px;">Go to Admin page</a>
                    @endif
                </li>
                <li>
                    @if(Auth::user()->user_role == 2)

                        <a href="{{route('moderator' ,['moderator'=>Auth::user()->user_role])}}" class="btn btn-success" style="height: 30px;margin-top: 4px;margin-left: 4px;padding: 3px;">Go to Moderator</a>
                    @endif
                </li>
                <li>
                    @if(Auth::user()->user_role == 3)

                        <a href="{{route('moderator' ,['moderator'=>Auth::user()->user_role])}}" class="btn btn-success" style="height: 30px;margin-top: 4px;margin-left: 4px;padding: 3px;">Go to Verifier</a>
                    @endif
                </li>
                <li class="nav-item">
                    @include('home.nav.logged')
                </li>

            @endguest
        </ul>
    </div>

</nav>

@include('chat.chat-box')

@if(Auth::check())
    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
@endif
<input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
<input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />

<div id="chat-overlay" class="row"></div>
