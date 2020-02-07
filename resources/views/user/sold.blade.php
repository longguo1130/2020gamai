<div class="row" style="overflow:scroll;">
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>User</th>
            <th>Transaction Type</th>
            <th>Date Completed</th>
            <th>Your feedback</th>
            <th>User's feedback</th>


        </tr>
        @foreach($products as $post)
            @if($post->sellerInfo['id'] == Auth::user()->id)
                <tr>
                    <td>
                        <a href="{{ route('products.show',['id'=>$post->productInfo['id']])}}">{{$post->productInfo['title']}}</a>
                    </td>
                    <td>{{$post->buyerInfo['username']}}</td>

                    <td>Seller</td>
                    <td>{{$post->updated_at}}</td>
                    @if(!empty(App\Feedback::where('product_id' ,$post->product_id)->where('from_user',Auth::user()->id)->first()))
                        <td>{{App\Feedback::where('product_id' ,$post->product_id)->where('from_user',Auth::user()->id)->first()->feedback_type==0?'Positive':'Negative'}}:
                            {{App\Feedback::where('product_id' ,$post->product_id)->where('from_user',Auth::user()->id)->first()->rating}}</td>
                    @else
                        <td><a href="{{route('bidders.feed',['id'=>$post->id])}}">Write Review</a></td>
                    @endif
                    @if(!empty(App\Feedback::where('product_id' ,$post->product_id)->where('to_user',Auth::user()->id)->first()))
                        <td>{{App\Feedback::where('product_id' ,$post->product_id)->where('to_user',Auth::user()->id)->first()->feedback_type==0?'Positive':'Negative'}}:{{App\Feedback::where('product_id' ,$post->product_id)->where('to_user',Auth::user()->id)->first()->rating}}</td>
                    @else
                        <td>Waiting</td>
                    @endif

                </tr>
            @endif
            @if($post->buyerInfo['id'] == Auth::user()->id)
                <tr>
                    <td>
                        <a href="{{ route('products.show',['id'=>$post->productInfo['id']])}}">{{$post->productInfo['title']}}</a>
                    </td>
                    <td>{{$post->sellerInfo['username']}}</td>
                    <td>Buyer</td>
                    <td>{{$post->updated_at}}</td>
                    @if(!empty(App\Feedback::where('product_id' ,$post->product_id)->where('from_user',Auth::user()->id)->first()))
                        <td>{{App\Feedback::where('product_id' ,$post->product_id)->where('from_user',Auth::user()->id)->first()->feedback_type==0?'Positive':'Negative'}}:{{App\Feedback::where('product_id' ,$post->product_id)->where('from_user',Auth::user()->id)->first()->rating}}</td>
                    @else
                        <td><a href="{{route('bidders.feed',['id'=>$post->id])}}">Write Review</a></td>
                    @endif
                    @if(!empty(App\Feedback::where('product_id' ,$post->product_id)->where('to_user',Auth::user()->id)->first()))
                        <td>{{App\Feedback::where('product_id' ,$post->product_id)->where('to_user',Auth::user()->id)->first()->feedback_type==0?'Positive':'Negative'}}:{{App\Feedback::where('product_id' ,$post->product_id)->where('to_user',Auth::user()->id)->first()->rating}}</td>
                    @else
                        <td>Waiting</td>
                    @endif

                </tr>
            @endif


        @endforeach
    </table>

</div>
