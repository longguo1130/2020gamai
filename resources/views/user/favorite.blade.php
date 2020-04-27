<div class="row">
    @forelse($products as $post)
        <div class="col-md-3 ">
            <div class="product-thumb">

                @if(!is_null($post->productInfo))
                    <a href="{{ route('products.show',['id'=>$post->productInfo->id])}}"><img src="{{ asset('images/'.$post->productInfo->firstImage['path']) }}"  style="width: 50%;height: 50%;"/></a>
                    @else
                    <a href="/"><img src="{{'product_images/no_image.png'}}" /></a>
                @endif

                <p class="title">{{ $post->productInfo['title']}}</p>
                PHP{{ $post->productInfo['price'] }}
                    <a href="#"><img src="{{asset('assets/heart-o.png')}}" alt="" style="height: 20px;width: 20px; margin-left: 70px;"/></a>
            </div>
        </div>
    @empty
        No products now...
    @endforelse
</div>
