$(function () {
    $('.chat-toggle-man').on('click', function () {
        let user_id = $(this).data('id');
        $('.full-btn-chat').attr('data-to-user',user_id);

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
                // chat_area.find(".loader").remove();
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

        $.ajax({
            url: base_url + "/send",
            data: {to_user: to_user, kind:'full', message: message, _token: $("meta[name='csrf-token']").attr("content")},
            method: "POST",
            dataType: "json",
            beforeSend: function () {
                // if(chat_area.find(".loader").length  == 0) {
                //     chat_area.append(loaderHtml());
                // }
            },
            success: function (response) {
                if(response.state == 1) {
                    $('.messages'+to_user).html(response.html);
                }
            },
            complete: function () {
               
                $(".message-input").find(".full-chat-input").val("");


            }
        });
    }
    $(document).on("click", ".full-btn-chat", function (e) {
        send($(this).attr('data-to-user'), $(".message-input").find(".full-chat-input").val());
        
    });

    $('.view-option').on('click', function () {
        let user_id = $(this).data('id');



        $(".contact.choose-option").attr("hidden",false);
        $(".choose-options-viewprofile").find(".viewprofile").attr("href",profile_url+user_id);
        $(".choose-options-delete").find(".delete-chat").attr("href",delete_chat_url+user_id);

    });


});
