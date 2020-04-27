$(function () {

    $('.chat-toggle-man').on('click', function () {
        let user_id = $(this).data('id');
        let bid_id = $(this).data('bid')
        $('.full-btn-chat').attr('data-to-user',user_id);

        $.ajax({
            url: base_url + "/load-transaction-info",
            data: {bid_id: bid_id,user_id:user_id, _token: $("meta[name='csrf-token']").attr("content")},
            method: "GET",
            dataType: "json",
            beforeSend: function () {
            },
            success: function (response) {
                if(response.status == 1) {
                    $('.transaction-action').html(response.html);
                }
            },
            complete: function () {

            }
        });
        $.ajax({
            url: base_url + "/load-latest-messages",
            data: {user_id: user_id,kind:'full', _token: $("meta[name='csrf-token']").attr("content")},
            method: "GET",
            dataType: "json",
            beforeSend: function () {
                // if(chat_area.find(".loader").length  == 0) {
                //     chat_area.html(loaderHtml());
                // }
            },
            success: function (response) {
                if(response.state == 1) {
                    $('.messages').html(response.html);
                }
            },
            complete: function () {
                $('.messages').animate({scrollTop: $('.messages').offset().top + $(document).height()}, 800, 'swing');
            }
        });


    });

    // toggle chat group
    $('.chat-group li').on('click', function () {
        let group_status = $(this).data('status');
        $('.contact-list li').hide();
        if(group_status === 'group-all') $('.contact-list li').show();
        $('.'+group_status).show();
    });

    function send(to_user, message)
    {
        // let chat_box = $("#chat_box_" + to_user);
        // let chat_area = chat_box.find(".chat-area");
        var original_avatar = $('.full-btn-chat').data('user');
        $.ajax({
            url: base_url + "/send",
            data: {to_user: to_user,kind:'full',message: message, _token: $("meta[name='csrf-token']").attr("content")},
            method: "POST",
            dataType: "json",
            beforeSend: function () {
                // if(chat_area.find(".loader").length  == 0) {
                //     chat_area.append(loaderHtml());
                // }
            },
            success: function (response) {
            },
            complete: function () {
                $('.messages').animate({scrollTop: $('.messages').offset().top + $(document).height()}, 800, 'swing');

                $('.full-chat-area').append('<li class="sent"><p>'+$(".message-input").find(".full-chat-input").val()+'</p><img src="'+original_avatar+'" style="width: 30px;height: 30px;"></li>');
                $(".message-input").find(".full-chat-input").val("");


            }
        });
    }
    $(document).on("click", ".full-btn-chat", function (e) {
        send($(this).attr('data-to-user'), $(".message-input").find(".full-chat-input").val());
        // send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val());
    });
    $(document).on("keypress", ".full-chat-input", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            send($('.full-btn-chat').attr('data-to-user'), $(".message-input").find(".full-chat-input").val());

        }
        // send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val());
    });


    $('.view-option').on('click', function () {
        let user_id = $(this).data('id');
        $(".choose-options-viewprofile").find(".viewprofile").attr("href",profile_url+user_id);
        $(".choose-options-delete").find(".delete-chat").attr("href",delete_chat_url+user_id);

    });


});
