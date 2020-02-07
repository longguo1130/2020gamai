<a id=""  href="javascript:void(0);" onclick="opensellNav()"><img src="{{asset('assets/Asset 1@4x.png')}}" alt="Sell Asset" style="height: 50px;" >

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
        <p><i class="fa fa-"></i> About Gamai</p>
        <p><i class="fa fa-"></i> Terms and Condition</p>
        <p><i class="fa fa-"></i> Privacy Policy</p>
    </div>
    <hr>
    <div class="login_bar_section2">
        <button class="btn"><i class="fa fa-facebook"></i></button>
        <button class="btn"><i class="fa fa-instagram"></i></button>
        <button class="btn"><i class="fa fa-twitter"></i></button>
        <button class="btn"><i class="fa fa-youtube"></i></button>
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
