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
                    <input id="verify_status" type="text" class="form-control" name="verify_status" value="{{ $user->verify_status }}"
                    >


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
                    <input id="user_role" type="text" class="user_role form-control" name="user_role" value="{{ $user->user_role }}"
                           required>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-info">Submit</button> <button class="btn btn-success">Dismiss</button>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection
