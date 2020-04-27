@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="choose-plan" style="text-align: center;">
            <h2 style="padding: 10px; color: rgba(86,85,255,0.64);">Choose a plan</h2>
            <h6>Select a plan that suits you need</h6>
            <div class="switch-button">
                <p>Monthly</p>
                <label class="switch">
                    <input type="checkbox" class="membership_checked" checked >
                    <span class="slider round"></span>
                </label>
                <p>Yearly</p>
            </div>

        </div>

        <div class="row membership-row" id="membership_monthly" hidden>
            @foreach($membership as $post)

                @if($post->id==1)
                    @if(30-\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now())>0)
                        <div class="membership-pack-monthly pack{{$post->id}} col-xl-3 col-lg-3 col-md-5 col-sm-5 col-10">
                            <h4>{{$post->membership_status}}</h4>
                            <h3>&#8369; {{number_format($post->amount_monthly, 2, '.', ',')}}</h3>
                            @if($post->id==1)
                                <h6>{{30-\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now())}}Days left</h6>

                            @else
                                <h6>Monthly</h6>
                            @endif
                            {{--<h4 class="inclusion">INCUSIONS</h4>--}}
                            {{--<ul>--}}
                            {{--<li>sample inclusion</li>--}}

                            {{--</ul>--}}
                            <h4 class="inclusion">Bid Limit</h4>
                            <h5>&#8369;{{number_format($post->bid_limit, 2, '.', ',')}}</h5>
                            @if(Auth::user()->membership)
                                @if($post->id == Auth::user()->membership)
                                    <label for="" class="current-membership">Your current membership</label>
                                @else
                                    <label for="" class="current-membership">This membership is expired </label>
                                @endif
                            @else
                                <a href="javascript:void(0)" class="sellect-plan" data-toggle="modal" data-target="#shareList" data-membership="{{$post->id}}" data-amount="{{$post->amount_monthly}}" data-id="{{Auth::user()->id}}" data-type="2">Select Plan</a>
                            @endif
                        </div>
                    @endif
                @endif
                @if($post->id>1 && $post->id<5)
                    <div class="membership-pack-monthly pack{{$post->id}} col-xl-3 col-lg-3 col-md-5 col-sm-5 col-10">
                        <h4>{{$post->membership_status}}</h4>
                        <h3>&#8369; {{number_format($post->amount_monthly, 2, '.', ',')}}</h3>

                        <h6>Monthly</h6>

                        {{--<h4 class="inclusion">INCUSIONS</h4>--}}
                        {{--<ul>--}}
                        {{--<li>sample inclusion</li>--}}

                        {{--</ul>--}}
                        <h4 class="inclusion">Bid Limit</h4>
                        <h5>&#8369;{{number_format($post->bid_limit, 2, '.', ',')}}</h5>
                        @if($post->id == Auth::user()->membership && Auth::user()->membership_type ==2)
                            <label for="" class="current-membership">Your current membership</label>
                        @else
                            <a href="javascript:void(0)" class="sellect-plan" data-toggle="modal" data-target="#shareList" data-membership="{{$post->id}}" data-amount="{{$post->amount_monthly}}" data-id="{{Auth::user()->id}}" data-type="2">Select Plan</a>
                        @endif
                    </div>
                @endif

            @endforeach
        </div>
        <div class="row membership-row" id="membership_yearly" >
            @foreach($membership as $post)
                @if($post->id>1)
                    <div class="membership-pack pack{{$post->id}} col-xl-3 col-lg-3 col-md-5 col-sm-5 col-10">
                        <h4>{{$post->membership_status}}</h4>
                        <h3>&#8369; {{number_format($post->amount_yearly, 2, '.', ',')}}</h3>
                        <h6>Anunally</h6>
                        {{--<h4 class="inclusion">INCUSIONS</h4>--}}
                        {{--<ul>--}}
                        {{--<li>sample inclusion</li>--}}

                        {{--</ul>--}}
                        <h4 class="inclusion">Bid Limit</h4>
                        <h5>&#8369;{{number_format($post->bid_limit, 2, '.', ',')}}</h5>
                        @if($post->id == Auth::user()->membership && Auth::user()->membership_type ==1)
                            <label for="" class="current-membership">Your current membership</label>
                        @else
                            <a href="javascript:void(0)" class="sellect-plan" data-toggle="modal" data-target="#shareList" data-membership="{{$post->id}}" data-amount="{{$post->amount_yearly}}" data-id="{{Auth::user()->id}}" data-type="1">Select Plan</a>
                        @endif
                    </div>

                @endif


            @endforeach
        </div>
        <div id="paypal_success" style="text-align: center;color:blue;"></div>

        <div class="modal fade" id="shareList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="margin-top: 10%;">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="paypal-button-container" style="text-align: center;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('additional_js')
    <script>
        $(function () {
            var pay_return_url ='{{ route('paypal.success')}}';
            $('.membership_checked').on('click',function () {
                let checked = $('.membership_checked')[0].checked;
                if (checked){
                    $('#membership_yearly')[0].hidden=false;
                    $('#membership_monthly')[0].hidden=true;

                }

                else{
                    $('#membership_yearly')[0].hidden=true;
                    $('#membership_monthly')[0].hidden=false;
                }

            });
            $('.sellect-plan').on('click',function () {
                // if ($('#paypal-button-container'))
                // {
                //     $('#paypal-button-container')[0].remove();
                // }
                $('.paypal-button-container').empty();
                var amount  = $(this).data('amount');
                let user_id = $(this).data('id');
                let membership = $(this).data('membership');
                let type = $(this).data('type');

                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value:amount


                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {

                        return actions.order.capture().then(function(details) {
                            $(function () {
                                $.ajax({
                                    url: pay_return_url,
                                    type: "get",
                                    datatype: "json",
                                    data: {user_id:user_id,membership:membership, type:type, _token: $("meta[name='csrf-token']").attr("content")},
                                    success: function (data) {
                                        // $('.choose-plan').empty();
                                        // $('.choose-plan').html(data.success_html);
                                        // $('.paypal-button-container').remove();
                                        $('.modal-content').html(data.success_html);


                                    }
                                });
                            })
                        });
                    }
                }).render('.paypal-button-container');
            })

        })
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id=AeEdn_BEw-EUcR1q8Y_1D5CpnI3AcXYx3JAN6_0rtJHKX4OoqjvRBZj842vIlwW_Ek4vVaHriR6r1QqC&currency=PHP"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>

@endsection
