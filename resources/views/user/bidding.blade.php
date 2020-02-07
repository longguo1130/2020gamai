<div class="row" style="overflow:scroll;">
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Bid Price</th>
            <th>Duration</th>
            <th>Comments</th>
            <th>Status</th>

        </tr>
        @foreach($products as $post)
            <tr>
                <td><a href="{{ route('products.show',['id'=>$post->productInfo['id']])}}">{{$post->productInfo['title']}}</a></td>
                <td>{{$post->sellerInfo['username']}}</td>
                <td>{{$post->price}}</td>
                <td>{{$post->bid_price}}</td>
                <td>{{$post->duration}}</td>
                <td>{{$post->comments}}</td>
                <td>{{$post->status == 2 ? 'accepted':'pending'}}</td>
            </tr>


        @endforeach
    </table>

</div>
