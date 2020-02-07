@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title m-b-md" style="text-align:left;">
                What are you selling?
            </div>

            <div class="form-wrap">
                <div class="row">
                    <div class="col-sm-5">
                        <form id="product-thumb-upload" action="{{ route('product.image.upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="dz-wrap">
                                <div class="dz-message "><i class="fa fa-photo"></i>
                                    <h2>Drag and drop, or browse</h2>
                                    <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                                </div>
                            </div>
                            {{-- thumnail slide  --}}
                            <ul class="thumbs-wrap">
                                @foreach($postImage as $img)
                                    <li class="thumb" data-id="{{ $img->id }}">
                                        <a data-fancybox="gallery" href="{{ asset('images/'.$img->path) }}">
                                            <img src="{{ asset('thumbnails/'.$img->path) }}">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </form>
                    </div>
                    <div class="col-sm-7">

                        <form id="product-info" class="form-horizontal" method="post" action="{{ route('products.update',['id'=>$post->id])}}" >
                            {{ csrf_field() }}
                            @foreach($postImage as $img)
                                <input type="hidden" name="image[]" class="image_{{ $img->id }}" value="{{ $img->id }}">
                            @endforeach

                            <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                {{--<select class="form-control" name="category_id" id="category_id">--}}
                                    {{--<option value="0">Select Category</option>--}}
                                    {{--<option value="1" {{ $post->category_id == 1 ? 'selected' : '' }}>Cloth</option>--}}
                                {{--</select>--}}
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="0">Select Category</option>
                                    @foreach(App\Category::get() as $category)
                                        <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->category}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Enter Price</label>
                                <input id="price" type="text" class="form-control" name="price" value="{{ $post->price }}"
                                       required>
                            </div>
                            <div class="form-group{{ $errors->has('transaction_type') ? ' has-error' : '' }}">
                                <label for="transaction_type" class="col-md-4 control-label">Transaction Type</label>
                                <select class="form-control" name="transaction_type" id="transaction_type">
                                    <option value="0">Select Type...</option>
                                    <option value="1" {{ $post->transaction_type == 1 ? 'selected' : '' }}>Type 1</option>
                                    <option value="2" {{ $post->transaction_type == 2 ? 'selected' : '' }}>Type 2</option>
                                </select>

                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}" required
                                       autofocus>

                            </div>
                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Description</label>
                                <textarea id="text" class="form-control" name="text" rows="5">{{ $post->text }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('additional_js')
    <script>
        var image_uploaded_url = '{{ route('product.image.uploaded') }}';
    </script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>

@endsection
