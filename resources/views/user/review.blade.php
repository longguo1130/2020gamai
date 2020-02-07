<div class="row" style="overflow:scroll;">
    @forelse($reviews as $review)
    <div class="review">
        <div class="transaction-title">
            {{App\Product::where('id',$review->product_id)->first()->title}}
        </div>
        <div class="transaction-rating">

            {{--@endfor--}}
            @if($review->feedback_type == 0)
            <span class="fa fa-plus"></span>
            @else
            <span class="fa fa-minus"></span>
            @endif
            <div class="star-ratings-sprite" style="margin-top:-3px;"><span style="width:{{$review->rating*20}}%" class="star-ratings-sprite-rating"></span></div>


           <h3 style="margin: -8px 30px;">{{App\Product::where('id',$review->product_id)->first()->seller==Auth::user()->username?'Seller':'Buyer'}}</h3>
        </div>
        <div class="transaction-comments">
            {{$review->comments}}
        </div>
        <div class="transaction-time">
            By {{App\User::where('id',$review->from_user)->first()->username}}:{{$review->created_date()}}
        </div>
    </div>
    @empty
        No Reviews now...
    @endforelse
</div>
