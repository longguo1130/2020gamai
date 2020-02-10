
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding-top:4px;padding-bottom:4px;">

    <div class="header_row ">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{asset('images/gamai-logo.png')}}" alt="" style="height: 30px;">

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
                <li class="nav-item">
                    @include('home.nav.logged')
                </li>

            @endguest
        </ul>
    </div>

</nav>

