@extends('layouts.product.show')

@section('main_content')



    <form class="bid-content" >
        {{ csrf_field() }}
        <div class="form-group">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @if($product->status == 0)


                        <div class="form-group">
                            <a href="{{route('products.edit',['id'=>$product->id])}}" class="btn btn-gray" style="width: 40%;">Edit Post</a>
                            <a href="{{route('products.destroy',['id'=>$product->id])}}" class="btn btn-gray" style="width: 40%;">Delete</a>
                        </div>
                        <div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="updateProduct" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin-top: 10%;">
                                <div class="modal-content">
                                    <h3>You updated your product successfully</h3>

                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <p>{{ $product->text }}</p>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex" style="padding-right: 15px;">
                                <img src="{{App\User::find($product->user_id)->avatar }}" alt=""
                                     style="width: 128px;height: 128px;border-radius: 50%;">
                            </div>
                            <div class="media-body" style="vertical-align: middle;align-self: center;">
                                <h6>{{Auth::user()->username}}</h6>
                                <p><i class="fa fa-map-marked"></i>{{Auth::user()->address1}} </p>
                                <div class="star-ratings-sprite"><span style="width:{{App\User::find($product->user_id)->rating/5*100}}%" class="star-ratings-sprite-rating"></span></div>
                            </div>

                        </div>
                    @elseif ($product->status ==2)
                        <span>You are discussing with customer</span>
                        @else
                        <span>This is your sold product</span>

                        @endif




                </div>

            </div>
        </div>

    </form>


@endsection
@section('additional_js')
    @if(!empty(Session::get('update')) && Session::get('update') == 1)
        <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.4.3.1.min.js') }}" type="text/javascript"></script>

        <script>
            $(function() {
                $('#updateProduct').modal('show');
            });
        </script>
    @endif
@endsection
