<div class="form-group">
    <a href="" class="btn btn-gray">Start Bidding</a>
</div>
<hr>
<div class="form-group">
    <p>{{ $product->text }}</p>
</div>
<hr>
<div class="seller_info_wrap media">
    <img src="{{ asset('avatars/default.png') }}" class="seller_avatar" alt="">
    <div class="seller_info media-body" style="vertical-align: middle;align-self: center;">
        <span>Seller Name ,{{ $product->location_id }}</span>
        <div>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>

</div>