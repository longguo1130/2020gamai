@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
        </div>

        <div class="panel-body">
            <div class="container" style="padding:12px;border: 1px solid #ddd; border-radius: 12px;">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 col-12" style="border-right: 1px solid #ddd;">
                        <div class="media">
                            <div class="d-flex" style="padding-right: 15px;display: inline-block!important;">
                                <img src="{{ $review->avatar }}" alt=""
                                     style="border-radius: 50%;width:120px;height: 120px;">
                            </div>
                            <div class="media-body" style="vertical-align: middle;align-self: center;">
                                <h2>{{$review->username}}
                                    @if($review->membership)
                                        <img src="{{asset('assets/'.App\Membership::where('id',$review->membership)->first()->icon)}}" alt="" style="height: 20px;"></h2>
                                @endif
                                @if($review->address1)
                                    <p><i class="fa fa-map-marked"></i> {{$review->address1}}</p>
                                @endif
                                <div class="star-ratings-sprite"><span style="width:{{$review->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-6 col-sm12-col-12">
                        <div class="status" style="display: flex;">
                            <h4>Verification Status:{{$review->verify_status}}%</h4>


                        </div>

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


                                            <h3 style="margin: -8px 30px;">{{App\Product::where('id',$review->product_id)->first()->seller==$review->username?'Seller':'Buyer'}}</h3>
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
