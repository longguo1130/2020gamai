
    @foreach($products as $index=>$post)
        @if($index % 4 == 0) <div class="row"> @endif
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 ">
            <div class="product-thumb">
                <a href="{{ route('products.show',['id'=>$post->id])}}" class="product-img">
                    @if(!empty($post->firstImage['path']))
                    <img src="{{ asset('thumbnails/'.$post->firstImage['path']) }}" />
                        @else
                        <img src="{{ asset('images/no-image.png') }}" />
                        @endif
                </a>
                <div style="padding:12px 4px;">
                    <p class="title" style="margin-bottom: -12px; margin-top: 0px; ">{{ $post->title }}</p>
                    <div class="product-info">
                        <span>{{App\City::find($post->city_id)->city}}</span>
                        @if(is_null($user_id))
                            <a  href="{{ route('login') }}" class="favor_btn favor_btn_{{ $post->id }}" data-id="{{ $post->id }}" data-user="{{ $user_id }}">
                                <img src="{{asset('assets/heart.png')}}" alt="" style="height: 20px">
                            </a>
                        @else
                            <a  href="javascript:void(0);" class= "favor_btn favor_btn_{{ $post->id }}" data-id="{{ $post->id }}" data-user="{{ $user_id }}">
                                {{--<i class="fa fa-heart{{ in_array($post->id,$favorites)? '' : '-o' }}"></i>--}}
                                @if(in_array($post->id,$favorites))
                                    <img src="{{asset('assets/heart-o.png')}}" alt="" style="height: 20px">
                                    @else
                                <img src="{{asset('assets/heart.png')}}" alt="" style="height: 20px">
                                    @endif

                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
            @if($index % 4 == 3) <hr></div> @endif
    @endforeach

