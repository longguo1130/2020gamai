@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/page/profile/profile.css') }}" rel="stylesheet">


@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title " style="text-align:center;">
                Deposit Settings
            <p style="text-align: center; color:gray">You have {{Auth::user()->deposit}}$ in your deposit</p>
            </div>
                @if(isset($message))
                    <strong>{{$message}}</strong>
            @endif
                <form action="{{route('user.store_deposit',['id'=>Auth::user()->id])}}" class="deposit-form col-6" >
                    <div class="currency">
                        <label>Deposit Currency</label>
                        <select name="" id="">
                            <option value="0">US Dollar</option>
                        </select>
                    </div>
                    <div class="amount">
                        <label for="amount">Deposit Amount</label>
                        <input type="text" name="amount" class="pay-amount" value="">
                    </div>
                    <div class="fee">
                        <label for="fee">Processing Fee</label>
                        <label for="fee_amount" class="fee_amount" style="float:right;"></label>
                    </div>
                    <div class="total-price">
                        <label for="fee">Totoal Price </label>
                        <label for="total-fee" class="total-fee" style="float:right;" ></label>
                    </div>
                    <div class="pay-request">
                        {{--<button class="btn-success" type="submit">Confirm and Pay</button>--}}
                        <div id="paypal-button-container"></div>
                    </div>



                    <p>You agree to authorize the use of your PayPal account for this deposit and future payments.
                        </p>
                    <p>PayPal does not support Prepaid and gift cards as a funding source.</p>

                </form>




        </div>
    </div>
@endsection
@section('additional_js')
    <script>
        $(function () {
            $('.pay-amount').on('keyup',function () {
                var amount = parseFloat(this.value);
               var fee =amount*2.5/100;
               var total = amount + fee;
               $('.fee_amount')[0].innerText = fee+'$';
               $('.total-fee')[0].innerText = total+'$';


            })
        })
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id=Acv_M03CmX7sEVDej7AAB2ZG9UBDBNsV7KQX7fuU6OZtUDNH-fRa79d4KxCN5AC89-QC0WlODBAmrxFj"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>
    <script>

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 50
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Call your server to save the transaction
                    return fetch('/paypal-transaction-complete', {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID
                        })
                    });
                });
            }
        }).render('#paypal-button-container');

    </script>

@endsection
