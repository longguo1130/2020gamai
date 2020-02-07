
<div class="row" style="overflow:scroll;">
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Number of Bids</th>
            <th>Status</th>

        </tr>
        @foreach($products as $post)
            <tr>
                <td><a href="{{ route('products.show',['id'=>$post->id])}}">{{$post->title}}</a></td>
                <td>{{$post->price}}</td>
                <td>{{$post->bidsNum()}}</td>
                {{--<td>{{$post->status == 1 ? 'accepted':'waiting'}}</td>--}}
                <td>
                    @if($post->status == 0)
                        Waiting
                        @elseif($post->status ==2)
                        <select name="active" id="active" onchange="location = this.value;">
                            <option value="0">Active</option>
                            <option value="{{route('bidders.cancel',['id'=>$post->id])}}">Looking</option>
                            <option value="{{route('bidders.complete',['id'=>$post->id])}}">Completed</option>
                        </select>

                        @else
                        Completed
                        @endif

                </td>
            </tr>


        @endforeach
    </table>

</div>
