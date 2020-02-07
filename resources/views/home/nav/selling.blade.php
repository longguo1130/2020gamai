<a id="" class="" href="javascript:void(0);" onclick="openSellNav()">
    <img src="{{asset('assets/Asset 1@4x.png')}}" alt="Sell Asset" style="height: 50px;" >
</a>
<link href="{{ asset('css/page/product/sell.css') }}" rel="stylesheet">
<div class="logged_bar sidenav" id="mySellnav">

    <div class="login_bar_section1">

        <h5 style="margin: 3%; ">What are you selling?</h5>



        <form id="product-thumb-upload" action="{{ route('product.image.upload') }}" method="POST" enctype="multipart/form-data" style="margin-top:3%;">
            {{ csrf_field() }}
            {{--<select class="form-control" name="category_id" id="category_id" style="margin-right: 3%;border-radius: 10px;">--}}
                {{--<option value="0">Select Category</option>--}}
                {{--@foreach(App\Category::get() as $category)--}}
                    {{--<option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->category}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            <div class="dz-wrap" >
                <div class="dz-message "><i class="fa fa-photo"></i>
                    <h5>Drag and drop, or browse</h5>
                    <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                </div>
            </div>
            {{-- thumnail slide  --}}
            <ul class="thumbs-wrap">

            </ul>

        </form>
        <div class="proceed-button" id="proceed_button">
            <a href="javascript:void(0);" onclick="openForm()">
                Proceed
            </a>
        </div>
        <div id="productSellInfo" hidden>


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
                <input id="location" type="text" placeholder="Location" class="form-control" name="location" value="{{ old('location') }}">
                <input id="city_id" type="hidden" class="form-control" name="city_id" value="{{ old('city_id') }}">
            </div>
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">

                <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Type your price"
                       required>
            </div>
            <div class="form-group{{ $errors->has('transaction_type') ? ' has-error' : '' }}">
                <select class="form-control" name="transaction_type" id="transaction_type">
                    <option value="0">Select Type</option>
                    <option value="1" {{ old('transaction_type') == 1 ? 'selected' : '' }}>RENT</option>
                    <option value="2" {{ old('transaction_type') == 2 ? 'selected' : '' }}>RENT OR SELL</option>
                </select>
            </div>
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Type your title" required
                       autofocus>
            </div>
            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

                <textarea id="text" class="form-control" name="text" rows="5" placeholder="Type your Description">{{ old('text') }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
        </div>



    </div>


</div>
<div id="mySellCanvasNav" class="overlay_nav" onclick="closeSellNav()"></div>

<script type="application/javascript">
    function openSellNav() {
        document.getElementById("mySellnav").style.width = "300px";
        document.getElementById("mySellnav").style.height = "80%";
        document.getElementById("mySellnav").style.overflowY = "scroll";
        document.getElementById("mySellCanvasNav").style.width = "100%";
        document.getElementById("mySellCanvasNav").style.opacity = "0.8";
    }

    function openForm(){


        document.getElementById("productSellInfo").hidden = false;
        document.getElementById("proceed_button").hidden = true;
    }
    function closeSellNav() {
        document.getElementById("mySellnav").style.width = "0";

        document.getElementById("mySellCanvasNav").style.width = "0%";
        document.getElementById("mySellCanvasNav").style.opacity = "0";
    }
    var image_uploaded_url = '{{ route('product.image.uploaded') }}';
    var city_autocomplete_url = '{{ route('city.autocomplete') }}';
</script>



