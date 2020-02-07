@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="product-success">
        <div class="container">
            <div class="row ">
                <div class="success col-8">
                    <div class="success-dialog">

                        <h2>Congratulations!</h2>
                        <form id="product-info" class="form-horizontal" action="{{route('user.social',['user'=>$user])}}">


                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">

                                <lable>Input your username</lable>
                                <input id="username" type="text" placeholder="username" class="form-control @error('email') is-invalid @enderror" name="username" value="" required autocomplete="username">
                                @if(isset($duplicate))
                                <strong style="color: red;">{{$duplicate}}</strong>
                                    @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">

                                <lable>Input your password</lable>
                                <input id="username" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autocomplete="username">

                            </div>
                            <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <label>Input your Location</label>
                                <input id="location" type="text" class="form-control" name="location" value="" required>
                                <input id="city_id" type="hidden" class="form-control" name="city_id" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overlay_success"></div>
            </div>
        </div>
    </div>

@endsection
@section('additional_js')
    <script>
        var image_uploaded_url = '{{ route('product.image.uploaded') }}';
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';
    </script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>
@endsection
