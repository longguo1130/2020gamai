@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
        </div>

        <div class="panel-body">
            <div class="container" style="padding:12px;border: 1px solid #ddd; border-radius: 12px;">
                <div class="row" style="overflow:scroll;">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4" style="border-right: 1px solid #ddd;">
                        <div class="media">
                            <div class="d-flex" style="padding-right: 15px;">
                                @if($review->provider)

                                    <img src="{{ $review->avatar }}" alt=""
                                         style="width: 128px;height: 128px;border-radius: 50%;">
                                @else
                                    <img src="{{ asset('avatars/'.$review->avatar) }}" alt=""
                                         style="width: 128px;height: 128px;border-radius: 50%;">
                                @endif
                            </div>
                            <div class="media-body" style="vertical-align: middle;align-self: center;">
                                <h2>{{$review->username}}</h2>
                                @if($review->address1)
                                    <p><i class="fa fa-map-marked"></i> {{$review->address1}}</p>
                                @endif
                                <div class="star-ratings-sprite"><span style="width:{{$review->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="status" style="display: flex;">
                            <h4>Verification Status</h4>
                            <h4 style="margin-left: 60%;">{{$review->verify_status}}%</h4>
                        </div>

                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$review->verify_status}}%;"></div>
                        </div>
                        Verified with <span></span>

                    </div>

                </div>
            </div>


            <section>
                <div class="container">
                    <div class="profile-contents">
                        <ul class="nav nav-tabs" role="tablist">


                            <li>
                                <a class="nav-link" id="favor-tab" href="#reviews" aria-controls="reviews" data-toggle="tab"
                                   role="tab" aria-selected="true">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">


                            <div class="row">
                                @forelse(App\Feedback::where('to_user',$review->id)->get() as $review)
                                    <div class="review">
                                        <div class="transaction-title">
                                            {{App\Product::where('id',$review->product_id)->first()->title}}
                                        </div>
                                        <div class="transaction-rating">

                                            {{--@endfor--}}
                                            @if($review->feedback_type == 0)
                                                <span class="fa fa-plus"></span>
                                            @else
                                                <span class="fa fa-minus"></span>
                                            @endif
                                            <div class="star-ratings-sprite" style="margin-top:-3px;"><span style="width:{{$review->rating*20}}%" class="star-ratings-sprite-rating"></span></div>


                                            <h3 style="margin: -8px 30px;">{{App\Product::where('id',$review->product_id)->first()->seller==Auth::user()->username?'Seller':'Buyer'}}</h3>
                                        </div>
                                        <div class="transaction-comments">
                                            {{$review->comments}}
                                        </div>
                                        <div class="transaction-time">
                                            By {{App\User::where('id',$review->from_user)->first()->username}}:{{$review->created_date()}}
                                        </div>
                                    </div>
                                @empty
                                    No Reviews now...
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <style>
        .profile-contents .nav.nav-tabs {
            display: block;
            border: none;
            padding: 10px 0px;
        }

        .profile-contents .nav.nav-tabs li {
            display: inline-block;
            margin-right: 7px;
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
        });
    </script>
@endsection
