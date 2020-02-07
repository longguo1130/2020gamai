@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title " style="text-align:left;">
                What are you selling?
            </div>

            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

                                </ul>

                            </form>
                        </div>
                        <div class="col-sm-7">
                            <form id="product-info" class="form-horizontal" method="POST" action="{{ route('products.store') }}" >
                                {{ csrf_field() }}
                                <input type="hidden" name="active_image" class="active_image" value="0">
                            <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="0">Select Category</option>
                                    @foreach(App\Category::get() as $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                    <label for="location" class="col-md-4 control-label">Location</label>
                                    <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">
                                    <input id="city_id" type="hidden" class="form-control" name="city_id" value="{{ old('city_id') }}">
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label for="price" class="col-md-4 control-label">Enter Price</label>
                                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}"
                                           required>
                                </div>
                                <div class="form-group{{ $errors->has('transaction_type') ? ' has-error' : '' }}">
                                    <label for="transaction_type" class="col-md-4 control-label">Transaction Type</label>
                                    <select class="form-control" name="transaction_type" id="transaction_type">
                                        <option value="0">Transaction Type...</option>
                                        <option value="1" {{ old('transaction_type') == 1 ? 'selected' : '' }}>RENT</option>
                                        <option value="2" {{ old('transaction_type') == 2 ? 'selected' : '' }}>RENT OR SELL</option>
                                    </select>
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required
                                       autofocus>
                            </div>
                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Description</label>
                                <textarea id="text" class="form-control" name="text" rows="5">{{ old('text') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Submit</button>
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
        var city_autocomplete_url = '{{ route('city.autocomplete') }}';
    </script>
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('js/page/product/create.js') }}"></script>

@endsection
