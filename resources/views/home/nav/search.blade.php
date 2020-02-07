<a id=""  href="javascript:void(0);" onclick="openSearch()"><i class="fa fa-search" style="height: 20px;"></i>

</a>

<div id="mySearch" class="showmodal">

    <!-- Modal content -->
    <div class="showmodal-content">

            <form id="product-search-form" action="{{ route('home') }}" method="GET" style="">
                <i class="fa fa-search"></i>
                <input type="text" name="q" class="navbar-search" placeholder="Search" value="{{ $query }}">
            </form>

    </div>

</div>

<div id="myCanvasNav" class="overlay_nav" onclick="closeNav()"></div>
<script type="application/javascript">



    function openSearch(){

        document.getElementById("mySearch").style.display = "block";

    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("mySearch")) {
            document.getElementById("mySearch").style.display = "none";
        }
    }

</script>
