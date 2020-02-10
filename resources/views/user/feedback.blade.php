@extends('layouts.app')
@section('additional_css')
    <link href="{{ asset('css/common/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page/product/product.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="product-success">
        <div class="container">
            <div class="row ">
                <div class="success col-8">
                    <div class="success-dialog">
                        <h2>Congratulations!</h2>

                        <form class="form-horizontal" action="{{route('bidders.feedback',['bid'=>$bid])}}">
                            <div class="form-group">
                                <label for="">Feedback</label>
                            </div>
                            <div class="form-group">
                                <select name="feedback_type" id="feedback_type">
                                    <option value="0">Positive</option>
                                    <option value="1">Negative</option>

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">How your experience</label>
                            </div>

                            <div class="form-group">
                              @for($i=1;$i<6;$i++)  <span class="fa fa-star" data-id = "{{$i}}"></span>@endfor
                                  <input type="text" class="rating" name="rating" value="" hidden>

                            </div>
                            <div class="form-group">
                                <textarea name="comments" id="comments" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overlay_success"></div>
            </div>
        </div>
    </div>

@endsection
@section('additional_js')
    <script>
        $(function(){

            $('.fa-star').on('click',function () {
               let checked_num = $(this).data('id');
               $('.rating')[0].value = checked_num;
                for ( var i=0; i<5; i++) {
                    // use myclass[i] here
                    $('.fa-star')[i].style.color = "#636b6f";

                }
                for ( var i=0; i<checked_num; i++) {
                    // use myclass[i] here
                    $('.fa-star')[i].style.color = "orange";

                }
            });
        });
    </script>
    <script src="{{ asset('js/lightslider.min.js') }}"></script>
    <script src="{{ asset('js/page/product/show.js') }}"></script>
@endsection
