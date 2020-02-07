@extends('layouts.product.show')

@section('main_content')



    <form  class="bid-content">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">

                    <span>You already sent a bid to this product</span>

                    <h2>{{$success}}</h2>


                </div>

            </div>
        </div>

    </form>


@endsection
