

var typeTimer=false;
if (window.Laravel.user_id != '' || window.Laravel.user_id != null) {


window.Echo.private(`users-notification.${window.Laravel.user_id}`)
    .notification((notification) => {
        var notify_count = $('.notify_count').text();
        new Audio(window.Laravel.notification).play();
        $('.notify_count').text(++notify_count);
        $('.notify_count').show();
        new Noty({
            text: notification.message,
            type: 'info',
            timeout: 6000,
        }).show();
    }).listen('Chat.ChatEvent', (e) => {
        if (e.chat_id != window.Laravel.chat_id) {
            var all_msg_count = $('.msg_count').text();
            var msg_count = $('.msg_count_'+e.sender_id).text();
            new Audio(window.Laravel.notification).play();
            new Noty({
                text: e.notification_message,
                type: 'info',
                timeout: 6000,
            }).show();
            $('.msg_count_'+e.sender_id).text(++msg_count);
            $('.msg_count_'+e.sender_id).show();
            // All Messages Section
            $('.msg_count').text(++all_msg_count);
            $('.msg_count').show();
            var msg_content =`<li class="media">
                <div class="mr-3">
                    <a href="${ e.route }" class="btn bg-success-400 rounded-round btn-icon"><img src='${ e.avatar }'
                            style='width: 30px;' /> </a>
                </div>

                <div class="media-body">
                    <a href="${ e.route }">${ e.sender_fullname }</a>
                    <p>
                    ${(() => {
                        if (e.message_type == 'text') {
                            return ` ${ e.message.length > 250 ? e.message.substring(0,250) : e.message }`;
                        }else if(e.message_type == 'store'){
                             return `<i class="icon-store"></i>`;
                        }else if(e.message_type == 'product'){
                             return `<i class="icon-cart"></i>`;
                        }else if(e.message_type == 'image'){
                             return `<i class="icon-image2"></i>`;
                        }
                    })()}
                    </p>
                    <div class="font-size-sm text-muted mt-1">${ e.created_at}</div>
                </div>
            </li>`
            $('.user_msgs').find('ul').prepend(msg_content)


            $('#client_typing_'+e.sender_id).find('span').html(`${e.message_type == 'text' ? e.message :  `<i class="icon-image2"></i>`}`);
            $('#client_typing_'+e.sender_id).find('i').css('display','none');
            $('#client_typing_'+e.sender_id).find('span').css('display','block');

            var ele = $(".all_clients_order").find('#client_num_'+e.sender_id);
            var index= $(ele).index();
            if (index > 0) {
                $(ele).insertBefore($(ele).parent().find("li").eq(index-1));
            }
        }
    });
}
