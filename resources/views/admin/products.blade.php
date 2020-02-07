<div class="row">
    <a href="{{route('export.excel',['user'=>'product'])}}" class="btn btn-success">Export Products to Excel</a>
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Type</th>
            <th>Category</th>
            <th>Description</th>
            <th>Date</th>

        </tr>
        @foreach($products as $product)
            <tr>
                <td><a href="{{ route('products.show',['id'=>$product->id])}}">{{$product->title}}</a></td>
                <td>{{$product->seller}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->transaction_type == 1?'Rent':'Rent or Sell'}}</td>
                <td>{{App\Category::where('id',$product->category_id)->first()->category}}</td>
                <td>{{$product->text}}</td>
                <td>{{$product->created_at}}</td>
            </tr>


        @endforeach
    </table>

</div>
