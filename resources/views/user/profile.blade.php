@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
        </div>

        <div class="panel-body">
            <div class="container" style="padding:12px;border: 1px solid #ddd; border-radius: 12px;">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4" style="border-right: 1px solid #ddd;">
                        <div class="media">
                            <div class="d-flex" style="padding-right: 15px;">
                                @if(Auth::user()->provider)

                                    <img src="{{ Auth::user()->avatar }}" alt=""
                                         style="border-radius: 50%;width: 140px;">
                                @else
                                    <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt=""
                                         style="border-radius: 50%;width: 140px">
                                @endif
                            </div>
                            <div class="media-body" style="vertical-align: middle;align-self: center;">
                                <h2>{{$user->username}}</h2>
                                @if($user->address1)
                                    <p><i class="fa fa-map-marked"></i> {{$user->address1}}</p>
                                @endif
                                <div class="star-ratings-sprite"><span style="width:{{$user->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="status" style="display: flex;">
                            <h4>Verification Status</h4>
                            <h4 class="verify-percent">{{$user->verify_status}}%</h4>
                        </div>

                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$user->verify_status}}%;"></div>
                        </div>
                        Verified with <span></span>

                        @if(empty(App\SocialAccount::where('user_id',Auth::user()->id)->where('provider','google')->first()))
                            <a href="{{route('auth.provider',['provider'=>'google']) }}" target="_blank">
                                <img src="{{asset('assets/google-512.png')}}" alt="" style="height: 15px;">
                            </a>
                        @endif
                        @if(empty(App\SocialAccount::where('user_id',Auth::user()->id)->where('provider','facebook')->first()))
                            <a href="{{route('auth.provider',['provider'=>'facebook']) }}" target="_blank">
                                <img src="{{asset('assets/Asset 11@4x.png')}}" style="height: 15px;" alt="">
                            </a>
                        @endif
                        @if(Auth::user()->id == $user->id)
                            <a href="{{route('profile.edit',['id'=>$user->id])}}" style="float:right;">Edit profile <i class="fa fa-user"></i></a>
                        @endif
                        {{--<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http%3A%2F%2Fkoshk.dev&pubid=USERNAME&ct=1&title=AddThis%20-%20Get%20likes%2C%20get%20shares%2C%20get%20followers&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google"/></a>--}}
                        @if(empty(Auth::user()->valid_id))
                            <form action="{{route('upload.id',['id'=>Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="file" name="image" class="custom-file-upload">
                                <button type="submit"><img src="{{asset('assets/img_378070.png')}}" style="height: 30px;" alt=""></button>
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
                        @endif
                    </div>

                </div>
            </div>


            <section>
                <div class="container">
                    <div class="profile-contents">
                        <ul class="nav nav-tabs" role="tablist">
                            {{--<li class="nav-item">--}}
                            {{--<a class="nav-link active" id="active-tab" href="#active" aria-controls="active"--}}
                            {{--data-toggle="tab" role="tab" aria-selected="true">active</a>--}}
                            {{--</li>--}}
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
                        <div class="tab-content">
                            {{--<div class="tab-pane fade active show" id="active" role="tabpanel"--}}
                            {{--aria-labelledby="active-tab">--}}

                            {{--</div>--}}
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
                </div>
            </section>

        </div>
    </div>

    <style>
        .custom-file-upload {
            color: transparent;
        }
        .custom-file-upload::-webkit-file-upload-button {
            visibility: hidden;
        }
        .custom-file-upload::before {
            content: 'Upload your valid ID';
            color: black;
            display: inline-block;
            background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
            border: 1px solid #999;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;
        }
        .custom-file-upload:hover::before {
            border-color: black;
        }
        .custom-file-upload:active {
            outline: 0;
        }
        .custom-file-upload:active::before {
            background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }
        .profile-contents .nav.nav-tabs {
            display: block;
            border: none;
            padding: 10px 0px;
        }
        .verify-percent{
            margin-left:60%;
        }

        .profile-contents .nav.nav-tabs li {
            display: inline-block;
            /*margin-right: 7px;*/
        }

        @media (max-width: 600px) {
            .profile-contents .nav.nav-tabs li {
                display: block;
                margin-bottom: 15px;
            }

            .userinfo{
                padding: 0px;
                width: 250px;
                margin: auto;
                text-align: center;
            }
            .verify-percent{
                margin-left:30%;
            }
        }

        .profile-contents .nav.nav-tabs li a.active {
            background: #2f7dfc;
            color: #fff;
            border-color: #2f7dfc;
        }

        .profile-contents .nav.nav-tabs li a {
            line-height: 38px;
            background: #fff;
            border: 1px solid #eeeeee;
            padding: 0 30px;
            color: #2a2a2a;
            font-size: 13px;
            font-weight: normal;
            border-radius: 50px;
        }

    </style>
@endsection

@section('additional_js')
    <script>
        var profile_detail_url = '{{ route('profile.detail') }}';

        $(function () {
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
