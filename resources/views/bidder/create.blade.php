@extends('layouts.product.show')

@section('main_content')



    <form id="bid-info" class="bid-content" method="POST" action="{{ route('bidders.store',['buyer_id'=>Auth::user()->id,'seller_id'=>$product->user_id,'product_id'=>$product->id,'price'=>$product->price ]) }}">
        {{ csrf_field() }}
        @if(Auth::user()->bid_count>=$product->price)
        <div class="form-group">
            <div class="row">

                <div class="col-md-6 form-group {{ $errors->has('bid_price') ? ' has-error' : '' }}">

                    <span>Bid</span>

                    <input id="bid_price" type="text" class="form-control bid-count" name="bid_price" data-count = "{{Auth::user()->bid_count}}">
                    <span class="bid-max-count" hidden style="color:red;" >You can't bid more than PHP {{Auth::user()->bid_count}}</span>

                </div>
                <div class="col-md-6 form-group {{ $errors->has('duration') ? ' has-error' : '' }}">
                    <span>Duration</span>
                    {{--<input id="duration" type="text" class="form-control" name="duration">--}}
                    <select class="form-control" name="duration" id="duration">
                        <option value="0">Select Duration</option>
                        {{--<option value="Day" {{ old('duration') == 1 ? 'selected' : '' }}>Day</option>--}}
                        {{--<option value="Week" {{ old('duration') == 2 ? 'selected' : '' }}>Week</option>--}}
                        <option value="Month" {{ old('duration') == 3 ? 'selected' : '' }}>Month</option>
                        <option value="Year" {{ old('duration') == 4 ? 'selected' : '' }}>Year</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('comments') ? ' has-error' : '' }}">
            <div class="row">
                <div class="col-md-12">
                    <span>Comments</span>
                    <textarea id="comments" type="text" name="comments" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info" >Submit</button>
            <a href="" class="btn btn-wide btn-default">Discard</a>
        </div>
        @else
            <a href="{{route('user.membership',['id'=>Auth::user()->id])}}" class="btn btn-gray">Upgrade to premium</a>
            <p style="color: red;">You can not bid more than {{Auth::user()->bid_count}}</p>
        @endif

    </form>


@endsection
@section('additional_js')
    <script>

        $(function(){

            $('.bid-count').on('keyup',function () {
                let count = $('.bid-count').data('count');

                if ($('.bid-count').val()>count){
                    $('.bid-max-count')[0].hidden = false;
                    $('.btn-info')[0].disabled = true;
                }
                else
                {
                    $('.bid-max-count')[0].hidden = true;
                    $('.btn-info')[0].disabled = false;
                }


            })
        });

    </script>


@endsection
