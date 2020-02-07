@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title m-b-md" style="text-align:left;">
                <?php  echo $product->title;
                // echo $product->singleImage['path'];
                ?>
            </div>
           @guest
            <div class="form-wrap">
                <div class="row">
                    <div class="col-sm-5">
                        <form id="product-thumb-upload">
                            <div class="dz-wrap">
                                <img src=" {{asset('images/'.$product->singleImage['path']) }}">
                            </div>
                            {{-- thumnail slide  --}}
                            <ul class="thumbs-wrap">
                                <a href="{{route('home')}}">Back to main page</a>
                            </ul>
                        </form>
                    </div>
                    <div class="col-sm-7">
                        <form id="product-info" class="form-horizontal" >


                            <div class="form-group">
                                <label for="location" class="col-md-4 control-label">Category</label>
                                <p class="form-control"><?php echo $product->category_id; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-md-4 control-label">Location</label>
                                <p class="form-control"><?php echo $product->location; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-md-4 control-label">Price</label>
                                <p class="form-control"><?php echo $product->price; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-md-4 control-label">Transaction Type</label>
                                <p class="form-control"><?php echo $product->transaction_type; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-md-4 control-label">Description</label>
                                <p class="form-control"><?php echo $product->text; ?></p>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            @endguest
        </div>
    </div>
@endsection
