<a id=""  href="javascript:void(0);" onclick="opensellNav()"><img src="{{asset('assets/toggle.png')}}" alt="Sell Asset" style="height: 30px;" >

</a>
<div class="login_bar sidenav" id="mySellnav">
    <div class="login_bar_section">
        <div class="login_bar_title">
            <a href="{{ route('login') }}">Login Now </a>
            <span>You're not login</span>
        </div>
        <img src="{{ asset('avatars/default.png') }}" alt="" style="">
    </div>
    <hr>
    <div class="login_bar_section1">
        <p><i class="fa fa-exclamation-circle"></i> <a href="{{route('about_us')}}">About Gamai</a></p>
        <p><a href="{{route('term_condition')}}"><i class="fa fa-exclamation-circle"></i> Terms and Condition</a></p>
        <p><a href="{{route('police')}}"><i class="fa fa-exclamation-circle"></i> Privacy Police</a></p>
        <p><a href="{{route('contact_us')}}"><i class="fa fa-exclamation-circle"></i> Contact Us</a></p>

    </div>
    <hr>
    <div class="login_bar_section2">
        <button class="btn"><a href="https://www.facebook.com/Gamaiph"><i class="fa fa-facebook"></i></a></button>
        <button class="btn"><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></button>
        <button class="btn"><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></button>
        <button class="btn"><a href="https://www.youtube.com"><i class="fa fa-youtube"></i></a></button>
    </div>
</div>
<div id="mySellCanvasNav" class="overlay_nav" onclick="closeSellNav()"></div>
<script type="application/javascript">
    function opensellNav() {
        document.getElementById("mySellnav").style.width = "300px";
        document.getElementById("mySellnav").style.height = "80%";
        document.getElementById("mySellnav").style.overflowY = "scroll";
        document.getElementById("mySellCanvasNav").style.width = "100%";
        document.getElementById("mySellCanvasNav").style.opacity = "0.8";
    }
    function closeSellNav() {
        document.getElementById("mySellnav").style.width = "0";
        document.getElementById("mySellCanvasNav").style.width = "0%";
        document.getElementById("mySellCanvasNav").style.opacity = "0";
    }
</script>
