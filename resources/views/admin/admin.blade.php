@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <div class="admin-container">
        <div class="profile-contents">
            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="selling-tab" href="#users" aria-controls="users"
                       data-toggle="tab" role="tab" aria-selected="true">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bidding-tab" href="#bidding" aria-controls="bidding"
                       data-toggle="tab" role="tab" aria-selected="true">Bidding</a>
                </li>
                <li>
                    <a class="nav-link" id="sold-tab" href="#messages" aria-controls="messages" data-toggle="tab"
                       role="tab" aria-selected="false">Messages</a>
                </li>
                <li>
                    <a class="nav-link" id="favor-tab" href="#products" aria-controls="products" data-toggle="tab"
                       role="tab" aria-selected="false">Products</a>
                </li>
                <li>
                    <a class="nav-link" id="favor-tab" href="#reviews" aria-controls="reviews" data-toggle="tab"
                       role="tab" aria-selected="false">Reviews</a>
                </li>
                <li>
                    <a class="nav-link" id="favor-tab" href="#category" aria-controls="category" data-toggle="tab"
                       role="tab" aria-selected="false">Category</a>
                </li>
                <li>
                    <a class="nav-link" id="favor-tab" href="#city" aria-controls="city" data-toggle="tab"
                       role="tab" aria-selected="false">City</a>
                </li>
            </ul>
            <div class="tab-content">
                {{--<div class="tab-pane fade active show" id="active" role="tabpanel"--}}
                {{--aria-labelledby="active-tab">--}}

                {{--</div>--}}
                <div class="tab-pane fade active show" id="users" role="tabpanel" aria-labelledby="users-tab">
                </div>
                <div class="tab-pane fade" id="bidding" role="tabpanel" aria-labelledby="bidding-tab">
                </div>
                <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    Messages...
                </div>
                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                    products...
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="favor-tab">
                    Reviews...
                </div>
                <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                    Category...
                </div>
                <div class="tab-pane fade" id="city" role="tabpanel" aria-labelledby="city-tab">
                    City...
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('additional_js')
    <script>
        var admin_detail_url = '{{ route('admin.detail') }}';

        $(function () {
            $.ajax({
                url: admin_detail_url,
                type: "get",
                datatype: "json",
                data: {},
                success:function(data) {
                    $('#users').html(data.users_html);
                    $('#reviews').html(data.review_html);
                    $('#messages').html(data.message_html);
                    $('#products').html(data.product_html);
                    $('#bidding').html(data.bidding_html);
                    $('#category').html(data.category_html);
                    $('#city').html(data.city_html);
                }
            });
        });
    </script>
@endsection
