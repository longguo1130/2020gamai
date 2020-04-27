@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="about-header">
                <h1>Let us help you!</h1>
                <h5>Message us your problem and will get back to you  </h5>
                <h5>soon as we can</h5>
            </div>
        </div>
        <form id="product-info" class="form-horizontal" method="POST" action="{{route('contact.send',['type'=>'support'])}}">
            {{ csrf_field() }}

            <div class="row">


                <div class="col-sm-6" style="margin: auto;">

                    <div class="form-group">
                        <label for="" class="col-md-4 col-form-label ">Name/Organization</label>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name"  required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-md-4 col-form-label">Email Address</label>

                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email"  required>

                        </div>
                        {{--<label for=""> 6 characters with a number and a letter</label>--}}
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col-md-10 col-form-label">Contact Number(Optional)</label>

                        <div class="col-md-12">
                            <input type="number" class="form-control" name="contact"  >

                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="" class="col-md-4 col-form-label">Message</label>

                        <div class="col-md-12">
                            <textarea id="text" class="form-control" name="message" rows="5"></textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6" style="text-align: center;margin:auto">
                            <button type="submit" class="pay-success-redirect" s>Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
