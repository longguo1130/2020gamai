@extends('layouts.product.sold')

@section('main_content')



    <form class="bid-content" >
        {{ csrf_field() }}
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                   <span>This is sold product</span>



                </div>

            </div>
        </div>

    </form>


@endsection
