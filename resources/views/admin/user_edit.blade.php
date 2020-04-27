@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="product-info" class="form-horizontal" method="POST" action="{{ route('admin.user.store',['id'=>$user->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="active_image" class="active_image" value="0">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fullname" class="col-md-4 control-label">Username</label>
                        <input id="fullname" type="text" class="form-control" name="username" value="{{ $user->username }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="location" class="col-md-4 control-label">email</label>
                        <input id="location" type="text" class="form-control" name="email" value="{{$user->email}}" required>

                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-md-4 control-label">Mobile Number</label>
                        <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $user->mobile }}"
                        >
                    </div>


                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label ">verify status</label>
                        <input id="verify_status" type="number" min="0" max="100" step="5" class="form-control" name="verify_status" value="{{ $user->verify_status }}">


                    </div>


                </div>


                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="rating" class="col-md-4 control-label">rating</label>
                        <input id="rating" type="text" class="form-control" name="rating" value="{{ $user->rating }}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="address2" class="col-md-4 control-label">Transaction</label>
                        <input id="transaction_count" type="text" class="form-control" name="transaction_count" value="{{ $user->transaction_count }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="col-md-4 control-label">Bid Count</label>
                        <input id="bid_count" type="text" class="birthday form-control" name="bid_count" value="{{ $user->bid_count }}"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="userrole" class="col-md-4 control-label">User Role</label>
                        <select class="form-control" name="role" id="duration">
                            <option value="0">Select Userrole</option>
                            <option value="1" {{ $user->user_role == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $user->user_role == 2 ? 'selected' : '' }}>Moderator</option>
                            <option value="3" {{ $user->user_role == 3 ? 'selected' : '' }}>Verifier</option>
                            <option value="4" {{ $user->user_role == 4 ? 'selected' : '' }}>Normal User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="membership " class="col-md-4 control-label">Membership</label>
                        <select class="form-control" name="membership" id="membership">
                            <option value="0">Select Membership</option>
                            <option value="1" {{ $user->membership == 1 ? 'selected' : '' }}>Trial Pack</option>
                            <option value="2" {{ $user->membership == 2 ? 'selected' : '' }}>Starter Pack</option>
                            <option value="3" {{ $user->membership == 3 ? 'selected' : '' }}>Advance Pack</option>
                            <option value="4" {{ $user->membership == 4 ? 'selected' : '' }}>Master Pack</option>
                            <option value="5" {{ $user->membership == 5 ? 'selected' : '' }}>Bronze Pack</option>
                            <option value="6" {{ $user->membership == 6 ? 'selected' : '' }}>Silver Pack</option>
                            <option value="7" {{ $user->membership == 7 ? 'selected' : '' }}>Gold Pack</option>
                            <option value="8" {{ $user->membership == 8 ? 'selected' : '' }}>Platinum Pack</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Submit</button> <button class="btn btn-success">Dismiss</button>
                    </div>
                </div>
            </div>
        </form>

        {{--@if(empty(\App\Moderator::where('user_id',$user->id)->where('type',1)->first()))--}}
        {{--<a href="{{route('admin.users.moderator',['user'=>$user,'type'=>1])}}" class="btn btn-success">Make this user Moderater 1</a>--}}
        {{--@else--}}

        {{--@endif--}}
        {{--@if(empty(\App\Moderator::where('user_id',$user->id)->where('type',2)->first()))--}}
        {{--<a href="{{route('admin.users.moderator',['user'=>$user,'type'=>2])}}" class="btn btn-success">Make this user Moderater 2</a>--}}
        {{--@else--}}

        {{--@endif--}}


    </div>
@endsection
