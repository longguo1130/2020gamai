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
                        <form id="product-info" class="form-horizontal" action="{{route('user.social',['id'=>$user->id])}}">


                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">

                                <label>Input your username</label>
                                <input id="username" type="text" placeholder="username" class="form-control @error('email') is-invalid @enderror" name="username" value="" required autocomplete="username">
                                @if(isset($duplicate))
                                <strong style="color: red;">{{$duplicate}}</strong>
                                    @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">

                                <label>Input your password</label>
                                <input id="password" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" minlength="8" required >

                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">

                                <label>Input your password again</label>
                                <input id="confirm_password" type="password" placeholder="confirm" class="form-control @error('password') is-invalid @enderror" name="confirm_password" value="" required >
                                <span id='message'></span>
                            </div>

                            {{--<div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">--}}
                                {{--<label>Input your Location</label>--}}
                                {{--<input id="location" type="text" class="form-control" name="location" value="" required>--}}
                                {{--<input id="city_id" type="hidden" class="form-control" name="city_id" value="">--}}
                            {{--</div>--}}
                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label>Input your Location <span class="text-danger"></span></label>
                                <input type="text" name="autocomplete" id="user_location" placeholder="Location..." class="form-control" value="">
                                @if($errors->has(['location']))
                                    <p class="text-danger">{{ $errors->first('location') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{--<div class="overlay_success"></div>--}}
            </div>
        </div>
    </div>

@endsection
@section('additional_js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7DF6McPxX3EaMwltYNDp5VLbfRpy3dro &libraries=places&callback=initAutocomplete"
            async defer></script>
    <script>
        var image_uploaded_url = '{{ route('product.image.uploaded') }}';
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';
        $(function() {

            $('#username').on('keypress', function(e) {
                if (e.which == 32){
                    window.alert("No Space is allowed");
                    return false;
                }
            });
            $('#password, #confirm_password').on('keyup', function () {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#message').html('Matching').css('color', 'green');
                } else
                    $('#message').html('Not Matching').css('color', 'red');
            });

        });
        function initAutocomplete(){

            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };

            var input = document.getElementById('user_location');
            input.setAttribute('placeholder','Enter the street address (e.g. 2401 Tampa Dr, Orlando Fl 34219)');


            var user_location = new google.maps.places.Autocomplete(input, {types: ['geocode']});
            google.maps.event.addListener(user_location, 'place_changed', function() {
                var data = $(".city_select").val();

                $('.city_select').closest('.dropdown-menu').removeClass('show');
                $('.city_select').closest('.category_item').find('.bottom_cat_name').html(data);
                Front.bringContent(1);

            });
        }



    </script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>


@endsection
