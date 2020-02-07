
<a id="" class="nav-logged-btn" href="javascript:void(0);" onclick="openNav()">
    @if(auth()->user()->provider)
        <img src="{{auth()->user()->avatar}}" alt="" style="height: 36px;">
    @else
    <img src="{{ asset('avatars/'.auth()->user()->avatar) }}" class="user-avatar" alt="" style="height: 36px;">
        @endif
</a>

<div class="logged_bar sidenav" id="mySidenav">
    <div class="login_bar_section">
        <div class="login_bar_title">
            <a href="javascript:void(0);">{{ Auth::user()->name }}</a>
            <span>{{ Auth::user()->email }}</span>
        </div>
        @if(Auth::user()->provider)

            <img src="{{ Auth::user()->avatar }}" alt=""
                 style="border-radius: 50%;width: 70px;">
        @else
            <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt=""
                 style="border-radius: 50%;width: 70px">
        @endif
    </div>
    <hr>
    <div class="login_bar_section1">
        <p><a href="{{ route('profile') }}"><i class="fa fa-user"></i> Profile</a></p>
        {{--<p><a href="{{ route('user.make_deposit',['id'=>Auth::user()->id]) }}"><i class="fa fa-money"></i> Make Deposit</a></p>--}}
        <p><a href="{{ route('user.membership',['id'=>Auth::user()->id]) }}"><i class="fa fa-users"></i>Membership</a></p>
        <p><a href="{{route('profile.chatting',['id'=>Auth::user()->id])}}"><i class="fa fa-comments-o"></i> Chat</a></p>
        <p><a href="{{route('user.change_password',['id'=>Auth::user()->id])}}"><i class="fa fa-lock"></i> Change Password</a></p>
{{--        <p><a href="{{view('user.change_password',['user'=>Auth::user()])}}"><i class="fa fa-lock"></i> Change Password</a></p>--}}
        <p><a href=""><i class="fa fa-exclamation-circle"></i> About Gamai</a></p>
        <p><a href=""><i class="fa fa-file-text-o"></i> Terms and Condition</a></p>
        <p><a href=""><i class="fa fa-lock"></i> Privacy Police</a></p>
        <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> {{ __('Logout') }}</a></p>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>
    <hr>
    <div class="login_bar_section2">
        <button class="btn"><i class="fa fa-facebook"></i></button>
        <button class="btn"><i class="fa fa-instagram"></i></button>
        <button class="btn"><i class="fa fa-twitter"></i></button>
        <button class="btn"><i class="fa fa-youtube-play"></i></button>
    </div>
</div>
<div id="myCanvasNav" class="overlay_nav" onclick="closeNav()"></div>

<script type="application/javascript">

    function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
        document.getElementById("mySidenav").style.height = "80%";
        document.getElementById("mySidenav").style.overflowY = "scroll";
        document.getElementById("myCanvasNav").style.width = "100%";
        document.getElementById("myCanvasNav").style.opacity = "0.8";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("myCanvasNav").style.width = "0%";
        document.getElementById("myCanvasNav").style.opacity = "0";
    }
</script>
