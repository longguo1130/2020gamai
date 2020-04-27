@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="product-info" class="form-horizontal" method="POST" action="{{ route('admin.newuser.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="active_image" class="active_image" value="0">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fullname" class="col-md-4 control-label">Username</label>
                        <input id="fullname" type="text" class="form-control" name="username" value=""
                        >
                    </div>

                    <div class="form-group">
                        <label for="location" class="col-md-4 control-label">Email</label>
                        <input id="location" type="text" class="form-control" name="email" value="" required>

                    </div>
                    <div class="form-group">
                        <label for="membership " class="col-md-4 control-label">Membership</label>
                        <select class="form-control" name="membership" id="membership">
                            <option value="0">Select Membership</option>
                            <option value="1" {{ old('membership') == 1 ? 'selected' : '' }}>Trial Pack</option>
                            <option value="2" {{ old('membership') == 2 ? 'selected' : '' }}>Starter Pack</option>
                            <option value="3" {{ old('membership') == 3 ? 'selected' : '' }}>Advance Pack</option>
                            <option value="4" {{ old('membership') == 4 ? 'selected' : '' }}>Master Pack</option>
                            <option value="5" {{ old('membership') == 5 ? 'selected' : '' }}>Bronze Pack</option>
                            <option value="6" {{ old('membership') == 6 ? 'selected' : '' }}>Silver Pack</option>
                            <option value="7" {{ old('membership') == 7 ? 'selected' : '' }}>Gold Pack</option>
                            <option value="8" {{ old('membership') == 8 ? 'selected' : '' }}>Platinum Pack</option>
                        </select>
                    </div>


                </div>


                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" value="" required>

                    </div>
                    <div class="form-group">
                        <label for="userrole" class="col-md-4 control-label">User Role</label>
                        <select class="form-control" name="role" id="duration">
                            <option value="0">Select Userrole</option>
                            <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Moderator</option>
                            <option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Verifier</option>
                            <option value="4" {{ old('role') == 4 ? 'selected' : '' }}>Normal User</option>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for=""></label>
                        <button type="submit" class="btn btn-info">Submit</button> <button class="btn btn-success">Dismiss</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
