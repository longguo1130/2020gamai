<div class="row">
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>Seller</th>
            <th>Buyer</th>
            <th>Price</th>
            <th>Bid Price</th>
            <th>Duration</th>
            <th>Comments</th>
            <th>Status</th>

        </tr>
        @foreach($bids as $bid)
            <tr>
                <td><a href="{{ route('products.show',['id'=>$bid->productInfo['id']])}}">{{$bid->productInfo['title']}}</a></td>
                <td>{{$bid->sellerInfo['username']}}</td>
                <td>{{$bid->buyerInfo['username']}}</td>
                <td>{{$bid->price}}</td>
                <td>{{$bid->bid_price}}</td>
                <td>{{$bid->duration}}</td>
                <td>{{$bid->comments}}</td>
                <td>{{$bid->status == 2 ? 'accepted':'pending'}}</td>
            </tr>


        @endforeach
    </table>

</div>
