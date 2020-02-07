<div class="footer">
    <div class="footer-logo">
        <img src="{{asset('assets/Asset 6@4x.png')}}" alt="">
    </div>
    <div class="footer-content">
        <a href="#">About</a>
        <a href="#">Support</a>
        <a href="#">Contact Us</a>
        <a href="#">Terms and conditions</a>
        <a href="#">Privacy policy</a>
    </div>
    <div class="footer-social">
        <a href="http://facebook.com">
            <img src="{{asset('assets/Asset 7@4x.png')}}" alt="" height="20px">
        </a>
        <a href="http://linkedin.com">
            <img src="{{asset('assets/Asset 8@4x.png')}}" alt="" height="20px">
        </a>
        <a href="http://twitter.com">
            <img src="{{asset('assets/Asset 9@4x.png')}}" alt="" height="20px">
        </a>
        <a href="http://youtube.com">
            <img src="{{asset('assets/Asset 10@4x.png')}}" alt="" height="20px">
        </a>

    </div>
    <div class="footer-email">
        @ &nbsp; gamai 2019
    </div>
    @include('chat.chat-box')

    @if(Auth::check())
    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
    @endif
    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
    
    <div id="chat-overlay" class="row"></div>
    <audio id="chat-alert-sound" style="display: none" autoplay="">
        <source src="{{ asset('sound/facebook_chat.mp3') }}" />
    </audio>


</div>
