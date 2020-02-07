
    <li class="category_item">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" id="dropdownMenu1">
            <div class="category_item_left">
                <div class="top_cat_name">Location</div>
                <div class="bottom_cat_name">City</div>
            </div>
            <div class="category_item_right ">
                <a class="sortbtn"><i class="fa fa-angle-down"></i></a>
            </div>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @include('home.nav.city')
        </ul>
    </li>
    <li class="category_item">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" id="dropdownMenu2">
            <div class="category_item_left">
                <div class="top_cat_name">Price</div>
                <div class="bottom_cat_name">Range</div>
            </div>
            <div class="category_item_right ">
                <a class="sortbtn"><i class="fa fa-angle-down"></i></a>
            </div>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @include('home.nav.price')
        </ul>
    </li>
    <li class="category_item">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" id="dropdownMenu3">
            <div class="category_item_left">
                <div class="top_cat_name">Sort&nbsp;by</div>
                <div class="bottom_cat_name">Date</div>
            </div>
            <div class="category_item_right ">
                <a class="sortbtn"><i class="fa fa-angle-down"></i></a>
            </div>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
            @include('home.nav.sort')
        </ul>

    </li>
    <li class="category_item">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" id="dropdownMenu4">
            <div class="category_item_left">
                <div class="top_cat_name">Category</div>
                <div class="bottom_cat_name">Gadgets</div>
            </div>
            <div class="category_item_right ">
                <a class="sortbtn"><i class="fa fa-angle-down"></i></a>
            </div>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
            @include('home.nav.category')
        </ul>
    </li>
