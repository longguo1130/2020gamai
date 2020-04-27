@extends('layouts.app')
@section('additional_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

@endsection
@section('content')
    <div class="content">
        <div class="container ">
            <a href="" class="profile-title">My profile</a>
        </div>

        <div class="panel-body">
            <div class="container" style="padding:12px;border: 1px solid #ddd; border-radius: 12px;">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-8 col-12" style="border-right: 1px solid #ddd;">
                        <div class="media">
                            <div class="d-flex" style="padding-right: 15px;display: inline-block!important;">
                                {{--<img src="{{ Auth::user()->avatar }}" alt=""--}}
                                     {{--style="border-radius: 50%;width:120px;height: 120px;">--}}
                                <form id="product-thumb-upload" action="{{ route('profile.image.upload') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="dz-wrap">
                                        <div class="dz-message user-avatar">
                                            <img src="{{App\User::find(Auth::user()->id)->avatar}}" alt="" class="thumbs-profile" style="border-radius: 50%;width:120px;height: 120px;">

                                        </div>

                                    </div>



                                </form>
                                <div class="edit-profile">@if(Auth::user()->id == $user->id && App\UserAccount::find($user->id))
                                        <a href="{{route('profile.edit',['id'=>$user->id])}}" >Edit profile <i class="fa fa-user"></i></a>
                                    @endif</div>
                            </div>
                            <div class="media-body" style="vertical-align: middle;align-self: center;">
                                <h2>{{$user->username}}
                                    @if(Auth::user()->membership)
                                        <img src="{{asset('assets/'.App\Membership::where('id',Auth::user()->membership)->first()->icon)}}" alt="" style="height: 20px;"></h2>
                                     @endif
                                @if($user->address1)
                                    <p><i class="fa fa-map-marked"></i> {{$user->address1}}</p>
                                @endif
                                <div class="star-ratings-sprite"><span style="width:{{$user->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-7 col-sm12-col-12">
                        <div class="status" style="display: flex;">
                            <h4>Verification Status:{{$user->verify_status}}%</h4>
                            <h5 class="credit_status" >Available Credit: &#8369;{{Auth::user()->bid_count}}<br><a href="{{ route('user.membership',['id'=>Auth::user()->id]) }}" >Increase Limit?  </a>
                            </h5>

                        </div>


                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$user->verify_status}}%;"></div>
                        </div>
                        Verified with <span></span>
                        @if(empty(App\SocialAccount::where('user_id',Auth::user()->id)->where('provider','sign-in-with-apple')->first()))
                            <a href="{{route('auth.provider',['provider'=>'sign-in-with-apple']) }}" >
                                <img src="{{asset('assets/apple-logo.png')}}" style="height: 20px;" alt="">
                            </a>
                        @endif
                        @if(empty(App\SocialAccount::where('user_id',Auth::user()->id)->where('provider','google')->first()))
                            <a href="{{route('auth.provider',['provider'=>'google']) }}" >
                                <img src="{{asset('assets/google-512.png')}}" alt="" style="height: 15px;">
                            </a>
                        @endif
                        @if(empty(App\SocialAccount::where('user_id',Auth::user()->id)->where('provider','facebook')->first()))
                            <a href="{{route('auth.provider',['provider'=>'facebook']) }}" >
                                <img src="{{asset('assets/Asset 11@4x.png')}}" style="height: 15px;" alt="">
                            </a>
                        @endif


                        {{--<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http%3A%2F%2Fkoshk.dev&pubid=USERNAME&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google"/></a>--}}
                        @if(empty($user->valid_id))
                            <div class="validate-account">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validateModal">
                                    Validate My Account
                                </button>

                            </div>
                        @endif

                            <div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="validateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 800px;">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="validateModalLabel">Validate your account to do more!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="product-info" class="form-horizontal" method="POST" action="{{ route('profile.validate.id',['id'=>Auth::user()->id]) }}">
                                                {{ csrf_field() }}
                                                <div class="row" >
                                                    <div class="col-12">
                                                        <h2>Step 1</h2>
                                                        <div class="form-group{{ $errors->has('limit_bid') ? ' has-error' : '' }}">
                                                            <label for="limit_bid" class="col-md-6 control-label">Allowable limit of : {{Auth::user()->bid_count}} </label>
                                                            {{--<input id="limit_bid" type="text" class="col-md-4" name="fullname" value=""--}}
                                                            {{--required>--}}
                                                        </div>

                                                        <div class="form-group{{ $errors->has('limit_product') ? ' has-error' : '' }}">
                                                            <label for="limit_product" class="col-md-6 control-label">Allowable active Post:{{Auth::user()->verify_status}}</label>
                                                            {{--<input id="limit_product" type="text" class=" col-md-4" name="address1" value="" required>--}}

                                                        </div>
                                                        <div class="form-group{{ $errors->has('name_description') ? ' has-error' : '' }}">
                                                            <label for="name_description" class="control-label col-md-10">Name can not be changed later*</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="validate-account-row col-sm-12" >
                                                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="firstName" class=" control-label">First Name</label>
                                                            <input id="firstName" type="text" class="form-control" name="firstName" value="" required>
                                                        </div>

                                                        <div class="form-group{{ $errors->has('middleName') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="middleName" class=" control-label">Middle Name</label>
                                                            <input id="middleName" type="text" class="form-control" name="middleName" value="" >

                                                        </div>
                                                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="lastName" class=" control-label">Last Name</label>
                                                            <input id="lastName" type="text" class="form-control" name="lastName" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="validate-account-row col-sm-12" >

                                                        <div class="form-group{{ $errors->has('house_number') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="house_number" class=" control-label">Unit/House Number</label>
                                                            <input id="house_number" type="text" class="form-control" name="house_number" value="" required>

                                                        </div>
                                                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="street" class=" control-label">Building/Street</label>
                                                            <input id="street" type="text" class="form-control" name="street" value="" required>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('town') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="town" class=" control-label">District</label>
                                                            <input id="town" type="text" class="form-control" name="town" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="validate-account-row col-sm-12" >


                                                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="city" class=" control-label">City</label>
                                                            <input id="city" type="text" class="form-control" name="city" value="" required>

                                                        </div>
                                                        <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="province" class=" control-label">Province</label>
                                                            <input id="province" type="text" class="form-control" name="province" value="" required >
                                                        </div>

                                                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="country" class=" control-label">Country</label>
                                                            <input id="country" type="text" class="form-control" name="country" value="" required>

                                                        </div>

                                                    </div>
                                                    <div class="validate-account-row col-sm-12" >

                                                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="zipcode" class=" control-label">Zipcode</label>
                                                            <input id="zipcode" type="number" class="form-control" name="zipcode" value="" required>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }} col-md-4 col-12">
                                                            <label for="birthday" class=" control-label">Birthday</label>
                                                            <input id="birthday" type="text" class="birthday form-control" name="birthday" value="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"  >Send</button>
                                                    </div>
                                                </div>


                                            </form>

                                        </div>

                                        <div class="modal-body upload_id">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2>Step 2</h2>

                                                        <form action="{{route('upload.id',['id'=>Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            <input type="file" name="image" class="custom-file-upload">
                                                            <button type="submit">Validate my government ID</button>
                                                            <div class="progress">
                                                                <div class="progress-bar upload" role="progressbar" aria-valuenow=""
                                                                     aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                                    0%
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <div id="success">

                                                            </div>
                                                        </form>

                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary hide_modal"  >Done</button>
                                        </div>


                                    </div>
                                </div>
                            </div>


                    </div>

                </div>
            </div>



            <section>
                <div class="container">

                    <div id='cssmenu' style="margin: 3%;position: relative;">
                        <ul class="nav nav-tabs" >

                            <li class="nav-item userinfo">
                                <a class="nav-link active" id="selling-tab" href="#selling" aria-controls="selling"
                                   data-toggle="tab" role="tab" aria-selected="true">Selling</a>
                            </li>
                            <li class="nav-item userinfo">
                                <a class="nav-link" id="bidding-tab" href="#bidding" aria-controls="bidding"
                                   data-toggle="tab" role="tab" aria-selected="true">Bidding</a>
                            </li>
                            <li class="nav-item userinfo">
                                <a class="nav-link" id="sold-tab" href="#sold" aria-controls="sold" data-toggle="tab"
                                   role="tab" aria-selected="false">History</a>
                            </li>
                            <li class="nav-item userinfo">
                                <a class="nav-link" id="favor-tab" href="#favor" aria-controls="favor" data-toggle="tab"
                                   role="tab" aria-selected="false">Favorites</a>
                            </li>
                            <li class="nav-item userinfo">
                                <a class="nav-link" id="favor-tab" href="#reviews" aria-controls="reviews" data-toggle="tab"
                                   role="tab" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                    </div>

                        <div class="tab-content">

                            <div class="tab-pane fade active show" id="selling" role="tabpanel" aria-labelledby="selling-tab">
                            </div>
                            <div class="tab-pane fade" id="bidding" role="tabpanel" aria-labelledby="bidding-tab">
                            </div>
                            <div class="tab-pane fade" id="sold" role="tabpanel" aria-labelledby="sold-tab">
                                Sold...
                            </div>
                            <div class="tab-pane fade" id="favor" role="tabpanel" aria-labelledby="favor-tab">
                                Favor...
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="favor-tab">
                                Reviews...
                            </div>
                        </div>


                </div>
            </section>

        </div>
    </div>


@endsection

@section('additional_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>
    <script>
        var profile_detail_url = '{{ route('profile.detail') }}';
        var image_uploaded_url = '{{ route('profile.image.uploaded') }}';
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';

        $(function () {

            $('.birthday').datepicker({
                format: 'mm-dd-yyyy'
            });
            $('.hide_modal').on('click',function () {
                setTimeout(function()
                {
                    location.reload();  //Refresh page
                }, 500);
            });
            $.ajax({
                url: profile_detail_url,
                type: "get",
                datatype: "json",
                data: {},
                success:function(data) {
                    $('#selling').html(data.selling_html);
                    $('#reviews').html(data.review_html);
                    $('#sold').html(data.sold_html);
                    $('#favor').html(data.favor_html);
                    $('#bidding').html(data.bidding_html);
                }
            });
            $('form').ajaxForm({
                beforeSend:function(){
                    $('#success').empty();
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.upload').text(percentComplete + '%');
                    $('.upload').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                        $('.upload').text('0%');
                        $('.upload').css('width', '0%');
                        $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.upload').text('Uploaded');
                        $('.upload').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');

                    }
                }
            });
        });
    </script>

@endsection
