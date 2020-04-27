<a id=""  href="javascript:void(0);" onclick="openLogin()"><img src="{{asset('assets/Asset 5@4x.png')}}" alt="" height="30px">

</a>
<div class="login_bar sidenav" id="mySidenav">



</div>
<div id="myModal" class="showmodal">

    <!-- Modal content -->
    <div class="showmodal-content">
        <div class="card-body">
            <h1 style="text-align: center;"><a href="{{ route('home') }}"><img src="{{asset('assets/gamai-logo.png')}}" alt="" style="height: 40px;margin-top:-40px"></a></h1>
            {{--<h4 style="text-align: center;"><p style="font-size: 18px;">Get what you need,<br>when you need it. <br>--}}
            {{--Quickly, Safely, Efficiently. <br>--}}
            {{--It's time to Gamai!</p></h4>--}}

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <span>Sign in with your</span>
                <div class="form-group row login-social" style="justify-content: center;">
                    <a href="{{route('auth.provider',['provider'=>'facebook']) }}" class="login100-social-item" >
                        <img src="{{asset('assets/Facebook.png')}}" alt="" >
                    </a>

                    <a href="{{route('auth.provider',['provider'=>'google']) }}" class="login100-social-item"   >
                        <img src="{{asset('assets/google.png')}}" alt="" >
                        {{--<div id="my-signin2" data-redirecturi="{{route('auth.provider.callback',['provider'=>'google'])}}">></div>--}}
                    </a>
                    <a href="{{route('auth.provider',['provider'=>'sign-in-with-apple']) }}" class="login100-social-item" >
                        <img src="{{asset('assets/apple.png')}}" alt="" >
                    </a>

                    <a href="{{ url('register') }}" class="login100-social-item" >
                        <img src="{{asset('assets/Sign-up.png')}}" alt="">
                    </a>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="login" type="text" placeholder="Username or email"
                               class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                               name="login" value="{{ old('username') ?: old('email') }}" required
                               autofocus>

                        @if ($errors->has('username') || $errors->has('email'))
                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="password" type="password" placeholder="Password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sign" style="">
                            {{ __('SIGN IN') }}
                        </button>
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom: -10px">
                    <div class="col-md-12">
                        <a href="{{route('password.request')}}">Forget Password?</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

<div id="myCanvasNav" class="overlay_nav" onclick="closeNav()"></div>
<script type="application/javascript">

    function openNav() {
        document.getElementById("mySidenav").style.width = "50%";
        document.getElementById("mySidenav").style.height = "80%";
        document.getElementById("mySidenav").style.position = "0px";
        document.getElementById("mySidenav").style.overflowY = "scroll";
        document.getElementById("myCanvasNav").style.width = "100%";
        document.getElementById("myCanvasNav").style.opacity = "0.8";
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("myCanvasNav").style.width = "0%";
        document.getElementById("myCanvasNav").style.opacity = "0";
    }

    function openLogin(){

        document.getElementById("myModal").style.display = "block";

    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal")) {
            document.getElementById("myModal").style.display = "none";
        }
    }

    // function onSuccess(googleUser) {
    //
    // }
    // function onFailure(error) {
    //
    // }
    // function renderButton() {
    //     gapi.signin2.render('my-signin2', {
    //         'scope': 'profile email',
    //
    //         'longtitle': true,
    //         'theme': 'dark',
    //         'onsuccess': onSuccess,
    //         'onfailure': onFailure
    //     });
    // }
</script>

