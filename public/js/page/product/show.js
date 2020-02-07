$(function () {
    var product_overview = $('.product_slider_img #vertical');
    product_overview.lightSlider({
        gallery:true,
        item:1,
        verticalHeight:300,
        thumbItem:4,
        slideMargin:0,
        speed:600,
        autoplay: true,
        responsive : [
            {
                breakpoint:991,
                settings: {
                    item:1,
                }
            },
            {
                breakpoint:576,
                settings: {
                    item:1,
                    slideMove:1,
                    verticalHeight:250,
                }
            }
        ]
    });
});
