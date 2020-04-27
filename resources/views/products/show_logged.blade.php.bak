@extends('layouts.product.show')

@section('main_content')
    <div class="form-group">
        <h3>{{$success}}</h3>
        <a href="{{ route('bidders.create',['product_id'=>$product->id]) }}" class="btn btn-gray">Start Bidding</a>

    </div>
    <hr>
    <div class="form-group">
        <p>{{ $product->text }}</p>
    </div>
    <hr>
    <div class="seller_info_wrap media">
        @if(App\User::find($product->user_id)->provider)
            <img src="{{App\User::find($product->user_id)->avatar}}" alt=""
                 style="width: 128px;height: 128px;border-radius: 50%;">
        @else
            <img src="{{ asset('avatars/'.App\User::find($product->user_id)->avatar) }}" alt=""
                 style="width: 128px;height: 128px;border-radius: 50%;">
        @endif
        <div class="seller_info media-body" style="vertical-align: middle;align-self: center;">
            <span>Seller Name :{{App\User::find($product->user_id)->name }}</span>
            <div class="star-ratings-sprite"><span style="width:{{App\User::find($product->user_id)->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>
        </div>
    </div>
@endsection
