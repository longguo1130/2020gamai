@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/page/profile/profile.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">


@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title " style="text-align:left;">
                Account Settings

            </div>


            <div class="form-wrap">
                <div class="row">
                    <form id="product-thumb-upload" action="{{ route('profile.image.upload') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="dz-wrap">
                            <div class="dz-message user-avatar">
                                <img src="{{App\User::find(Auth::user()->id)->avatar}}" alt="" class="thumbs-profile">

                            </div>

                        </div>



                    </form>
                    <div class="upload_image">


                        <h5 style="padding-top: 20%;padding-left: 5%;">Image must be in JPG or PNG and under 5mb.</h5>
                    </div>
                </div>

                <hr>

                <form id="product-info" class="form-horizontal" method="POST" action="{{ route('profile.store',['id'=>Auth::user()->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="active_image" class="active_image" value="0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <label for="fullname" class="col-md-4 control-label">Full Name</label>
                                <input id="fullname" type="text" class="form-control" name="fullname" value="{{App\UserAccount::find($post->id)->firstName.' '.App\UserAccount::find($post->id)->middleName.' '.App\UserAccount::find($post->id)->lastName }}" disabled
                                       required>
                            </div>

                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Location</label>
                                <input id="location" type="text" class="form-control" name="address1" value="{{$post->address1}}" required>

                            </div>
                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-6 control-label">Mobile Number</label>
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $post->mobile }}"
                                       required>
                            </div>
                            <hr>
                            <div class="form-group">

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-6 control-label">Email Address</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ $post->email }}" disabled
                                       required>
                                @if(isset($message))<label for="">{{$message}}</label>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="col-md-4 control-label">Birthday</label>
                                <input id="birthday" type="text" class="birthday form-control" name="birthday" value="{{ $post->birthday }}"
                                       required>
                            </div>

                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Save profile</button> <a href="{{route('profile',['id'=>Auth::user()->id])}}" class="btn btn-success">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('additional_js')
    <script>
        var image_uploaded_url = '{{ route('profile.image.uploaded') }}';
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';
        $(function(){

            $('.birthday').datepicker({
                format: 'mm-dd-yyyy'
            });

        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>

@endsection
