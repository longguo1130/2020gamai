<div class="row">
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>From User</th>
            <th>To User</th>
            <th>Type</th>
            <th>Rating</th>
            <th>Comments</th>
            <th>Date</th>


        </tr>
        @foreach($reviews as $review)
            <tr>
                <td><a href="{{ route('products.show',['id'=>$review->productInfo['id']])}}">{{$review->productInfo['title']}}</a></td>
                <td>{{$review->fromUser['username']}}</td>
                <td>{{$review->toUser['username']}}</td>
                <td>{{$review->feedback_type == 0?'Positve':'Negative'}}</td>
                <td>{{$review->rating}}</td>
                <td>{{$review->comments}}</td>
                <td>{{$review->created_at}}</td>
            </tr>


        @endforeach
    </table>

</div>
