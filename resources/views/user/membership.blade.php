@extends('layouts.app')

@section('content')
    @if(empty(Auth::user()->membership))
    <div class="trial-membership">

        <a href="javascript:void(0)" class="btn btn-success membership-amount" data-type="2" data-id="{{Auth::user()->id}}" data-membership="1" data-amount="100">Premium Trial</a>
    </div>
    @endif
    <div class="custom" style="width: 90%;margin: auto;">
        @if(isset($message))
            <p>{{$message}}</p>
        @endif


            <div class="col-lg-4 col-12 col-sm-12 membership-table">
                <div class="monthly-memberhship"><h2>Monthly</h2></div>
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        @foreach($membership as $post)
                            @if($post->id>1 && $post->id<5)
                            <th>{{$post->membership_status}}
                                <p>PHP{{$post->amount_monthly}}</p></th>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td></td>
                        @for($i=2; $i<5; $i++)
                            @if($i== Auth::user()->membership && Auth::user()->membership_type == 2)
                                <td>Current</td>
                            @else
                                <td><a href="javascript:void(0);" class="btn btn-default membership-amount" data-amount="{{App\Membership::where('id',$i)->first()->amount_monthly}}" data-id="{{Auth::user()->id}}" data-membership="{{$i}}" data-type="2">Select</a></td>
                            @endif
                        @endfor
                    </tr>
                    <tr>
                        <th>Options</th>
                        <th></th>
                        <th></th>
                        <th></th>


                    </tr>
                    <tr>
                        <td>Bid limit</td>
                        @foreach($membership as $post)
                            @if($post->id>1 && $post->id<5)
                            <td>{{$post->bid_limit}}</td>
                            @endif
                        @endforeach

                    </tr>
                    {{--<tr>--}}
                    {{--<td>Product Fee</td>--}}
                    {{--@foreach($membership as $post)--}}
                    {{--<td>{{$post->fee}}%</td>--}}
                    {{--@endforeach--}}
                    {{--</tr>--}}
                </table>

            </div>
            <div class="col-lg-8 col-12 col-sm-12 membership-table">
                <div class="yearly-membership"><h2>Yearly</h2></div>
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        @foreach($membership as $post)
                            @if($post->id>1)
                                <th>{{$post->membership_status}}
                                    <p>PHP{{$post->amount_yearly}}</p></th>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td></td>
                        @for($i=2; $i<9; $i++)
                            @if($i== Auth::user()->membership && Auth::user()->membership_type == 1)
                                <td>Current</td>
                            @else
                                <td><a href="javascript:void(0);" class="btn btn-default membership-amount" data-amount="{{App\Membership::where('id',$i)->first()->amount_yearly}}" data-id="{{Auth::user()->id}}" data-membership="{{$i}}" data-type="1">Select</a></td>
                            @endif
                        @endfor
                    </tr>
                    <tr>
                        <th>Options</th>

                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Bid limit</td>
                        @foreach($membership as $post)
                            @if($post->id>1)
                                <td>{{$post->bid_limit}}</td>
                            @endif
                        @endforeach

                    </tr>

                </table>

            </div>




    </div>
    <div id="paypal_success" style="text-align: center;color:blue;"></div>
    <div id="paypal-button-container" style="text-align: center;"></div>
@endsection

@section('additional_js')
    <script>
        var pay_return_url ='{{ route('paypal.success')}}';
        $(function () {
           $('.membership-amount').on('click',function () {
               // console.log($(this).data('amount'));
               var amount  = $(this).data('amount');
               let user_id = $(this).data('id');
               let membership = $(this).data('membership');
               let type = $(this).data('type');

               paypal.Buttons({
                   createOrder: function(data, actions) {
                       return actions.order.create({
                           purchase_units: [{
                               amount: {
                                   value:'2'


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
                                   data: {details,user_id:user_id,membership:membership, type:type},
                                   success: function (data) {
                                       $('#paypal_success').html(data.success_html);
                                       $('#paypal-button-container').remove();


                                   }
                               });
                           })
                       });
                   }
               }).render('#paypal-button-container');
           })
        })
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id=Acv_M03CmX7sEVDej7AAB2ZG9UBDBNsV7KQX7fuU6OZtUDNH-fRa79d4KxCN5AC89-QC0WlODBAmrxFj"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>


@endsection
