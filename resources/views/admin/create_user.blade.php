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


                </div>


                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" value="" required>

                    </div>
                    <div class="form-group">
                        <label for="userrole" class="col-md-4 control-label">Userrole</label>
                        <input id="userrole" type="text" class="form-control" name="userrole" value="" >

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
