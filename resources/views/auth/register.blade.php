@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 style="text-align: center;"><a href="{{ route('home') }}"><img src="{{asset('images/gamai-logo.png')}}" alt="" style="height: 30px;"></a></h1>
                    <p>Buy and sell quickly, safetly and localty. It's time to Gamai!</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <span>Create a new account</span>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="name" type="text" placeholder="Full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="username" type="text" placeholder="user name" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="mobile" type="text" placeholder="Contact Number" class="form-control " name="mobile" >

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                {{--<input type="checkbox" id="login_privacy">--}}
                                <input type="checkbox"  id="terms" name="terms" value="1" />
                                <label for="login_privacy"> <a href="{{asset('terms/terms.pdf')}}">Terms & Conditions and Privacy Police</a></label>
                                @error('terms')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{"check"}}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-signup">
                                    {{ __('SIGN UP') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <a href="{{ route('login') }}">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
