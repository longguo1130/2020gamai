@extends('layouts.product.show')

@section('main_content')



    <form class="bid-content" >
        {{ csrf_field() }}
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    @if($product->status == 0)


                        <div class="form-group">
                            <a href="{{route('products.edit',['id'=>$product->id])}}" class="btn btn-gray" style="width: 40%;">Edit Post</a>
                            <a href="{{route('products.destroy',['id'=>$product->id])}}" class="btn btn-gray" style="width: 40%;">Delete</a>
                        </div>
                        <hr>
                        <div class="form-group">
                            <p>{{ $product->text }}</p>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex" style="padding-right: 15px;">
                                @if(App\User::find($product->user_id)->provider)
                                    <img src="{{App\User::find($product->user_id)->avatar}}" alt=""
                                         style="width: 128px;height: 128px;border-radius: 50%;">
                                @else
                                <img src="{{ asset('avatars/'.App\User::find($product->user_id)->avatar) }}" alt=""
                                     style="width: 128px;height: 128px;border-radius: 50%;">
                                    @endif
                            </div>
                            <div class="media-body" style="vertical-align: middle;align-self: center;">
                                <h6>{{Auth::user()->name}}</h6>
                                <p><i class="fa fa-map-marked"></i> China</p>
                                <div class="star-ratings-sprite"><span style="width:{{App\User::find($product->user_id)->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>
                            </div>

                        </div>
                    @elseif ($product->status ==2)
                        <span>You are discussing with customer</span>
                        @else
                        <span>This is your sold product</span>

                        @endif




                </div>

            </div>
        </div>

    </form>


@endsection
