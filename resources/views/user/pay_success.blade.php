
<div class="pay-success" >
    <img src="{{asset('assets/tick 1.png')}}" alt="" style="height: 100px;">
    <h2>Plan upgrade completed!</h2>
    <h3>Hi {{$user->username}}! You have successfully upgraded </h3>
    <h3>your memberhship to {{$membership->membership_status}}</h3>

    <a href="{{url('/')}}" class="btn btn-success pay-success-redirect">Continue Shopping</a>

</div>
