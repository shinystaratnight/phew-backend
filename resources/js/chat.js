var typeTimer=false;
var newUl=$('.load-ul');
var dashboardUl=$('.dashboard_li');
if (window.Laravel.chat_id != '') {
window.Echo.private(`users-chat.${window.Laravel.chat_id}`)
    .listen('Chat.ChatEvent', (e) => {
        $('.no_message').remove();
        var div = $('.chat_list');
        $('.load-ul').hide();
        $('.dashboard_li').hide();
        if (e.sender_id == window.Laravel.user_id) {
            $('#client_typing_'+e.receiver_id).find('span').html(`${e.message_type == 'text' ? e.message :  `<i class="icon-image2"></i>`}`);
            var client_html= `<ul class="list-unstyled messages-list messages-send" id="message_${ e.id }">
                    <li>
                        <div class="message">
                            <div class="avatar">
                                <img src="${ e.avatar }" alt="sender" class="img-fluid">
                            </div>
                            <div class="message-content">
                                <div class="single-massege">
                                ${(() => {
                                    if (e.message_type == 'text') {
                                        return `<p class="message-text white-font bg-grey"> ${ e.message } </p>`;
                                    }else if(e.message_type == 'store'){
                                         return `<div class="single-item f-width">
                                             <img src="${ e.message.logo_url }" class="img-fluid" style="height:150px;" alt="product">
                                             <p class="item-name grey-bg">
                                                 ${ e.message.name }
                                             </p>
                                         </div>`;
                                    }else if(e.message_type == 'product'){
                                         return `<div class="single-item f-width">
                                             <img src="${ e.message.image_url }" class="img-fluid" style="height:150px;" alt="product">
                                             <p class="item-name grey-bg">
                                                 ${ e.message.name } - ${e.message.price}
                                             </p>
                                         </div>`;
                                    }else{
                                         return `<div class="single-item f-width">
                                       <p> <img src="${ e.message }" class="img-fluid" alt="product"></p>
                                    </div>`;
                                    }
                                })()}
                                <span class="check-icon received"  id="check_msg_client_${ e.id }">
                                    <i class="fas fa-check text-muted"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>`;
            var dashboard_html= `<li class="media" id="message_${ e.id }">
                <div class="mr-3">
                    <a href="${ e.avatar }">
                        <img src="${ e.avatar }" class="rounded-circle" width="40" height="40" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <div class="media-chat-item">
                    ${(() => {
                        if (e.message_type == 'text') {
                            return `<p> ${ e.message } </p>`;
                        }else if(e.message_type == 'store'){
                             return `<a href="#">
                                 <img src="${e.message.logo_url}" style="width:250px">
                                 <p class="text-center text-default">
                                     ${ e.message.name }
                                 </p>
                             </a>`;
                        }else if(e.message_type == 'product'){
                             return `<a href="#">
                                 <img src="${e.message.image_url}" style="width:250px">
                                 <p class="text-center text-default">
                                     ${ e.message.name } - ${e.message.price}
                                 </p>
                             </a>`;
                        }else if(e.message_type == 'image'){
                             return `<img src="${e.message}" style="max-width: 100%; max-height: 245px;">`;
                        }
                    })()}
                    </div>
                    <div class="font-size-sm text-muted mt-2">${ e.created_at}
                    <a href="#" id="check_msg_${ e.id }">
                        <i class="icon-checkmark2 ml-2 text-muted"></i>
                    </a>
                    </div>
                </div>
            </li>`;


            div.find('.dashboard_li').before(dashboard_html);
            //
            div.find('.load-ul').before(client_html);
        }else{
            $('#client_typing_'+e.sender_id).find('span').html(`${e.message_type == 'text' ? e.message :  `<i class="icon-image2"></i>`}`);
            $('#client_typing_'+e.sender_id).find('i').css('display','none');
            $('#client_typing_'+e.sender_id).find('span').css('display','block');
            div.find('.load-ul').before(`<ul class="list-unstyled messages-list messages-receive" id="message_${ e.id }">
                          <li>
                              <div class="message">
                                  <div class="avatar">
                                      <img src="${e.avatar}" alt="receiver" class="img-fluid">
                                  </div>
                                  <div class="message-content">
                                      <div class="single-massege">
                                      ${(() => {
                                          if (e.message_type == 'text') {
                                              return `<p class="message-text white-font bg-grey"> ${ e.message } </p>`;
                                          }else if(e.message_type == 'store'){
                                               return `<div class="single-item f-width">
                                                   <img src="${ e.message.logo_url }" class="img-fluid" style="height:150px;" alt="product">
                                                   <p class="item-name grey-bg">
                                                       ${ e.message.name }
                                                   </p>
                                               </div>`;
                                          }else if(e.message_type == 'product'){
                                               return `<div class="single-item f-width">
                                                   <img src="${ e.message.image_url }" class="img-fluid" style="height:150px;" alt="product">
                                                   <p class="item-name grey-bg">
                                                       ${ e.message.name } - ${e.message.price}
                                                   </p>
                                               </div>`;
                                          }else{
                                               return `<div class="single-item f-width">
                                             <p> <img src="${ e.message }" class="img-fluid" alt="product"></p>
                                          </div>`;
                                          }
                                      })()}
                                      <span class="check-icon received"  id="check_msg_client_${ e.id }">
                                          <i class="fas fa-check text-muted"></i>
                                      </span>
                                      </div>
                                  </div>
                              </div>
                          </li>
                      </ul>`);
            div.find('.dashboard_li').before(`<li class="media media-chat-item-reverse" id="message_${ e.id }">
                                            <div class="media-body">
                                                <div class="media-chat-item">
                                                ${(() => {
                                                    if (e.message_type == 'text') {
                                                        return `<p> ${ e.message } </p>`;
                                                    }else if(e.message_type == 'store'){
                                                        return `<a href="#">
                                                            <img src="${e.message.logo_url}" style="width:250px">
                                                            <p class="text-center text-default">
                                                                ${ e.message.name }
                                                            </p>
                                                        </a>`;
                                                    }else if(e.message_type == 'product'){
                                                         return `<a href="#">
                                                             <img src="${e.message.image_url}" style="width:250px">
                                                             <p class="text-center text-default">
                                                                 ${ e.message.name } - ${e.message.price}
                                                             </p>
                                                         </a>`;
                                                    }else if(e.message_type == 'image'){
                                                         return `<img src="${e.message}" style="max-width: 100%; max-height: 245px;">`;
                                                    }
                                                })()}
                                                </div>
                                                <div class="font-size-sm text-muted mt-2">${ e.created_at}
                                                <a href="#" id="check_msg_${ e.id }">
                                                    <i class="icon-checkmark2 ml-2 text-muted"></i>
                                                </a>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <a href="${ e.avatar }">
                                                <img src="${ e.avatar }" class="rounded-circle" width="40" height="40" alt="">
                                                </a>
                                            </div>
                                        </li>`);
        }

        div.scrollTop(div.prop('scrollHeight'));
    }).listenForWhisper('typing', (e) => {
        console.log(e);
         if (typeTimer) {
             clearTimeout(typeTimer);
         }
         var ul=$('.chat_list');
             // $('.whisper').find('img').attr('src',e.image);
             $('.typing').attr('src',e.avatar);
             // $('.whisper .name').textContent = e.fullname;
             $('.load-ul').show();
             $('.dashboard_li').show();
             $('#client_typing_'+e.id).find('i').css('display','block');
             $('#client_typing_'+e.id).find('span').css('display','none');
             ul.scrollTop(ul.prop('scrollHeight'));
             typeTimer=setTimeout(function(){
                 $('.load-ul').hide();
                 $('.dashboard_li').hide();
                 $('#client_typing_'+e.id).find('i').css('display','none');
                 $('#client_typing_'+e.id).find('span').css('display','block');
              }, 4000);
         }).listen('Chat.MessageIsDeliveredEvent', (e) => {
             e.messages.forEach((message, i) => {
                 $(`#check_msg_${message.id}`).html(`<i class="icon-checkmark2 ml-2 text-muted"></i>`);
             });

         }).listen('Chat.MessageIsSeenEvent', (e) => {
             e.messages.forEach((message, i) => {
                 $(`#check_msg_${message.id}`).html(`<i class="icon-checkmark2 ml-2 text-primary"></i>`);
                 $(`#check_msg_client_${message.id}`).html(`<i class="fas fa-check text-primary"></i>`);
             });
         })
}
// Check Online
window.Echo.join(`online`)
    .here((users) => {
        users.forEach((user, i) => {
            $(`#online_${user.id}`).html(`<span class="badge badge-mark bg-success border-success"></span>`);
        });

    })
    .joining((user) => {
        $(`#online_${user.id}`).html(`<span class="badge badge-mark bg-success border-success"></span>`)
    })
    .leaving((user) => {
        $(`#online_${user.id}`).html(`<span class="badge badge-mark bg-grey border-grey"></span>`)
    });
