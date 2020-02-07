
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Front.init();
});

var price_min = 0;
var price_max = 0;
var sort_id = 0;
var category_id = 0;
var city_id = 0;
var next_page = 0;

Front = {

    initNav: function(){

        /* search bar */
        $('.nav-search').on('click', function () {
            $('.search_menu').toggle().addClass('menu_fixed  ');
            // $('.main_menu').toggle();
            $('.navbar-search').focus();
            document.getElementById("myCanvasNav").style.width = "100%";
            document.getElementById("myCanvasNav").style.opacity = "0.8";
            document.getElementById("myCanvasNav").style.transitionDuration="0.025s"


        });
        $('.dropdown-toggle').on('click', function () {

            document.getElementById("myCanvasNav").style.width = "100%";
            document.getElementById("myCanvasNav").style.opacity = "0.8";

        });

        $(".navbar-search").focusout(function(){
            // $('.main_menu').toggle();
            $('.search_menu').toggle();
        });
        /* product search on top*/
        $('.navbar-search').on('keyup', function(e){
           if(e.keyCode === 13){
               $('#product-search-form').submit();
           }
        });

        /*  */

        /* city */
        $('input.city_select').autocomplete({
            serviceUrl: city_autocomplete_url,
            onSelect: function (suggestion) {
                $('.category_city').removeClass('open');
                //
                city_id = suggestion.data;
                $(this).closest('.category_item').find('.bottom_cat_name').html(suggestion.value);
                Front.bringContent(1);
                // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });
        $('.category_city').on('click','.btn-reset',function () {
            $('.city_select').val('');
            $(this).closest('.category_item').find('.bottom_cat_name').html('City');
            city_id = 0;
            $(this).closest('.category_detail').removeClass('open');
            //
            Front.bringContent(1);
        });


        /* price */
        $('.category_price').on('click','.btn-reset',function () {
            $('.price_input').val('');
            $(this).closest('.category_item').find('.bottom_cat_name').html('Range');
            price_min = price_max = 0;
            $(this).closest('.category_detail').removeClass('open');
            //
            Front.bringContent(1);
        }).on('click','.btn-apply',function () {

            price_min = Number($('.min_price').val());
            price_max = Number($('.max_price').val());
            if(price_max !== 0 && price_min !== 0){
                $(this).closest('.category_item').find('.bottom_cat_name').html(price_min+' to '+price_max);
                //
                Front.bringContent(1);
            }
            $(this).closest('.category_detail').removeClass('open');
        });

        /* sort */
        $('.category_sort').on('click','li',function () {
            $('.category_sort li').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.category_item').find('.category_detail').addClass('open');
            $(this).closest('.category_detail').removeClass('open');
            //
            $(this).closest('.category_item').find('.bottom_cat_name').html($(this).html());
            sort_id = $(this).data('id');
            Front.bringContent(1);
        });

        /* category */
        $('.category_kind').on('click','li',function () {
            $('.category_kind li').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.category_item').find('.category_detail').addClass('open');
            $(this).closest('.category_detail').removeClass('open');
            //
            $(this).closest('.category_item').find('.bottom_cat_name').html($(this).html());
            category_id = $(this).data('id');
            Front.bringContent(1);
        });
    },

    initFavor: function(){
        $('.product_list').on('click', '.favor_btn', function () {
            var product_id = $(this).data('id');
            var user_id = $(this).data('user');
            $.ajax({
                url: set_favor_url,
                type: "post",
                datatype: "json",
                data: {
                    product_id: product_id,
                    user_id: user_id,
                },
                success:function(data) {
                    var icon = $('.favor_btn_'+data.product_id);
                    if(data.status === 'checked'){
                        icon.html('<img src="assets/heart-o.png" alt="" style="height: 20px"</i>');
                    }else{
                        icon.html('<img src="assets/heart.png" alt="" style="height: 20px"</i>');
                    }
                }
            });
        })
    },

    bringContent: function (page) {
        var product_wrap = $('.product_list');
        if(page === 1){
            product_wrap.html('');
        }
        product_wrap.append('<div class="fa-3x bring-timer"><i class="fa fa-circle-notch fa-spin"></i></div>');
        $.ajax({
            url: bring_products_url,
            type: "get",
            datatype: "json",
            data: {
                page: page,
                query: query,
                city_id: city_id,
                price_min:price_min,
                price_max:price_max,
                sort_id:sort_id,
                category_id:category_id,
            },
            success:function(data) {
                $('.product_list').data('page',data.next_page).data('last_page',data.last_page).append(data.products).fadeIn();
                $('.bring-timer').remove();
            }
        });

    },

    init: function () {

        Front.initNav();
        Front.initFavor();
        Front.bringContent(1);

        $(window).scroll( function () {

            var window_top = $(window).scrollTop() + 1;

            // bring products by scrolling on home page
            if (window_top == $(document).height() - $(window).height()) {
                // ajax call get data from server and append to the div
                var product_list = $('.product_list');
                var page = product_list.data('page');
                if(next_page === page) return;
                next_page = page;
                var last_page = product_list.data('last_page');
                if(last_page >= next_page){
                    Front.bringContent(next_page);
                }
            }

            // top menu
            if (window_top > 400) {
                $('.main_menu').show().addClass('menu_fixed animated fadeInDown');
            } else {
                $('.main_menu').hide().removeClass('menu_fixed animated fadeInDown');
            }


        });
    },
};
