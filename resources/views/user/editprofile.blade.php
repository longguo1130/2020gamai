@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/page/profile/profile.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title " style="text-align:left;">
                Account Settings

            </div>

            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-wrap">
                <div class="row">
                    <form id="product-thumb-upload"  method="POST" >
                        {{ csrf_field() }}

                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}


                    </form>

                </div>
                <hr>

                    <form id="product-thumb-upload" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                        <label for="fullname" class="col-md-4 control-label">Full Name</label>
                                        <input id="fullname" type="text" class="form-control" name="fullname" value="{{ $post->fullname }}"
                                           required>
                                    </div>
                                    <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                        <label for="address1" class="col-md-4 control-label">Address 1</label>
                                        <input id="address1" type="text" class="form-control" name="address1" value="{{ $post->address1 }}"
                                               required>
                                    </div>
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-4 control-label">Mobile Number</label>
                                        <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $post->mobile }}"
                                               required>
                                    </div>
                                    <hr>
                                    <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                                        <label for="newpassword" class="col-md-4 control-label">New Password</label>
                                        <input id="newpassword" type="text" class="form-control" name="newpassword" value="{{ $post->newpassword }}"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <button>Upload Valid ID</button>List of Valid ID's
                                    </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email Address</label>
                                    <input id="email" type="text" class="form-control" name="email" value="{{ $post->email }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="address2" class="col-md-4 control-label">Address 2(Optional)</label>
                                    <input id="address2" type="text" class="form-control" name="address2" value="{{ $post->address2 }}"
                                           required>
                                </div>
                                <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                    <label for="birthday" class="col-md-4 control-label">Birthday</label>
                                    <input id="birthday" type="text" class="form-control" name="birthday" value="{{ $post->birthday }}"
                                           required>
                                </div>
                                <hr>
                                {{--<div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">--}}
                                    {{--<label for="newpassword" class="col-md-4 control-label">New Password</label>--}}
                                    {{--<input id="newpassword" type="text" class="form-control" name="newpassword" value="{{ old('newpassword') }}"--}}
                                           {{--required>--}}
                                {{--</div>--}}
                                <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                                    <button type="submit" class="btn btn-info">Save profile</button> <button class="btn btn-success">Logout</button>
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
        var image_uploaded_url = '{{ route('product.image.uploaded') }}';
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';
    </script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>

@endsection
