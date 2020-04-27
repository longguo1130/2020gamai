
$(function () {
    fm_dropzone_main = new Dropzone("#product-thumb-upload", {
        maxFilesize: 5,
        acceptedFiles: "image/png,image/jpeg",
        dataType: 'json',
        init: function () {
            this.on("complete", function (file) {
                this.removeFile(file);
            });
            this.on("success", function (file,response) {
                // console.log("addedfile");
                loadUploadedFiles(response.upload_id);
                var imgelement = '<input type="hidden" name="image[]" class="image_'+response.upload_id+'" value="'+response.upload_id+'">';
                $('#product-info').append(imgelement);
            });

        }
    });

    // var thumbs = $('#product-thumb-upload').detach();
    // $('#product-thumb-area').append(thumbs);

    /*$('.thumbs-wrap').on('click','.thumb',function () {
       $('.thumb').removeClass('active');
       $(this).addClass('active');
       $('.active_image').val($(this).data('id'));
    });*/

    // drag and drop for thumbs

    // remove a thumb
    $('.thumbs-wrap').on('click','i',function () {
        var thumb = $(this).closest('li');
        thumb.remove();
        var image_id = thumb.data('id');
        $('.image_'+image_id).remove();
    });

    // location autocomplete
    $('input#location').autocomplete({
        serviceUrl: city_autocomplete_url,
        onSelect: function (suggestion) {
            var city_id = suggestion.data;
            var city_name = suggestion.value;
            $('#location').val(city_name);
            $('#city_id').val(city_id);
        }
    });


});

function loadUploadedFiles(upload_id) {
    // load folder files


    $.ajax({
        dataType: 'json',
        url: image_uploaded_url,
        data: {upload_id:upload_id},
        success: function ( json ) {
            var img_url = json.img_url;

            if ($(".dz-message")[0].childNodes[0].tagName != "IMG") {

                $('.dz-message').empty();
                var first_url = '<img src="'+img_url+'" style="width:80%;height: 70%;" ><i class="fa fa-plus" style="width:25%;height: 25%;">';
                $('.dz-message').append(first_url);
            }
            var avatar_url = '<img src="'+img_url+'" style="border-radius: 50%;width:120px;height: 120px;"  >';
            $(".user-avatar").empty();
            $(".user-avatar").append(avatar_url);


            var thumb_url = json.thumb_url;
            var thumb = '<li class="thumb" data-id="'+json.image_id+'">' +
                '<a data-fancybox="gallery" href="'+img_url+'">' +
                '<img src="'+thumb_url+'"><i class="fa fa-close"></i></a></li>';
            $('.thumbs-wrap').append(thumb);
        }
    });
}
