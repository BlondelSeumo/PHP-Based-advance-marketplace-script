/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

/*----------------------------------------------------------------------
| Function to send message
------------------------------------------------------------------------*/
$(document).on('keypress', '.chat-textarea', function(e){
        var txtarea = $(this);
        var message = txtarea.val();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if(message !== "" && e.which == 13){
            txtarea.val('');
            // save the message 
            $.ajax({ type: "POST", url: baseUrl  + "chat/save_message", data: {message: message, user : $('#chat_buddy_id').val(),[csrfName]: csrfHash},dataType: "json",cache: false,
                success: function(response){
                    msg = response.response.message;
                    chatMsg = '<div class="message-bubble me">'+
                    '<div class="message-bubble-inner">'+
                    '<div class="message-avatar"><img src="'+baseUrl+'assets/img/users/'+msg.avatar+'" alt="" /></div>'+
                    '<div class="message-text"><p>'+msg.body+'</p></div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                    $('#chat-message').append(chatMsg);
                    $('#chat-message').animate({scrollTop: $('#chat-message').prop("scrollHeight")}, 500);
                }
            });
        }
});

/*----------------------------------------------------------------------
| Function to send message on Send Button Click
------------------------------------------------------------------------*/
$(document).on('click', '.sendMsg', function(e){
        var txtarea = $('#chat_message');
        var message = txtarea.val();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if(message !== ""){
            txtarea.val('');
            // save the message 
            $.ajax({ type: "POST", url: baseUrl  + "chat/save_message", data: {message: message, user : $('#chat_buddy_id').val(),[csrfName]: csrfHash},dataType: "json",cache: false,
                success: function(response){
                    msg = response.response.message;
                    chatMsg = '<div class="message-bubble me">'+
                    '<div class="message-bubble-inner">'+
                    '<div class="message-avatar"><img src="'+baseUrl+'assets/img/users/'+msg.avatar+'" alt="" /></div>'+
                    '<div class="message-text"><p>'+msg.body+'</p></div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                    $('#chat-message').append(chatMsg);
                    $('#chat-message').animate({scrollTop: $('#chat-message').prop("scrollHeight")}, 500);
                    $('.txt_csrfname').val(response.token);
                }
            });
        }
});


/*----------------------------------------------------------------------
| Function to send message Directly
------------------------------------------------------------------------*/
$(document).on('submit','.msgOwnerForm',function(e){
        e.preventDefault();
        var txtarea = $('.txt_msg');
        var message = txtarea.val();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if(message !== ""){
            txtarea.val('');
            // save the message 
            $.ajax({ type: "POST", url: baseUrl  + "chat/save_message", data: {message: message, user : $('.owner_id').val(),[csrfName]: csrfHash},dataType: "json",cache: false,
                success: function(response){
                    bootstrap_alert.success('Succesfully Sent the message','#validationMsg');
                    $('.txt_csrfname').val(response.token);
                    return;
                }
            });
        }
        else
        {
            bootstrap_alert.error('Please enter a message','#validationMsg');
            return;
        }
});

/*----------------------------------------------------------------------
| Click Chat User Function
------------------------------------------------------------------------*/
$(document).on('click', '.chat-user', function(e){
        var chatid  = $(this).attr("data-chatfriend");
        var myid    = $(this).attr("data-mychat");
        $('#chat-message').empty();
        load_thread(chatid);
});


/*----------------------------------------------------------------------
| Function to load threaded messages or user conversation
------------------------------------------------------------------------*/
var limit = 5;
var currentDate = "";
function load_thread(user, limit=5){
       var csrfName = $('.txt_csrfname').attr('name');
       var csrfHash = $('.txt_csrfname').val();
        //send an ajax request to get the user conversation 
       $.ajax({ type: "POST", url: baseUrl  + "chat/message", data: {user : user, limit:limit,[csrfName]: csrfHash },dataType: "json",cache: false,
        success: function(response){
        if(response.response.success){
            $('.txt_csrfname').val(response.token);
            chat = response.response.chat;
            status = chat.status == 1 ? 'Online' : 'Offline';
            statusClass = chat.status == 1 ? 'user-status is-online' : 'user-status is-offline';

            $('#chat-message').empty();
            if(chat.more){
                $('#message-loading').show();
                $('#chat-message').append('<a id="load-more-wrap" onclick="javascript: load_thread(\''+chat.id+'\', \''+chat.limit+'\')" class="centerButtons" style="text-align:center;width:100%">View older messsages('+chat.remaining+')</a>');
                $('#message-loading').hide();
            }

            $('#chat_buddy_id').val(chat.id);
            $('#ChatName').html(chat.name);

            threads = response.response.thread;
            $.each(threads, function(key,thread) {

                if(currentDate !== new Date(thread.time).getDate())
                {  
                    currentDate = new Date(thread.time).getDate();
                    timeSlot =  '<div class="message-time-sign">'+
                                '<span>'+timeSince(new Date(thread.time).getTime())+' ago '+'</span>'+
                                '</div>';

                    $('#chat-message').append(timeSlot);
                }

                if(thread.sender === userID )
                {   
                    chatMsg = '<div class="message-bubble me">'+
                    '<div class="message-bubble-inner">'+
                    '<div class="message-avatar"><img src="'+baseUrl+'assets/img/users/'+thread.avatar+'" alt="" /></div>'+
                    '<div class="message-text"><p>'+thread.body+'</p></div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                }
                else if(thread.recipient === userID)
                {
                    chatMsg = '<div class="message-bubble">'+
                    '<div class="message-bubble-inner">'+
                    '<div class="message-avatar"><img src="'+baseUrl+'assets/img/users/'+thread.avatar+'" alt="" /></div>'+
                    '<div class="message-text"><p>'+thread.body+'</p></div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
                }

                $('#chat-message').append(chatMsg);
                $('.messages-inbox').load(location.href + " .messages-inbox");

                if(chat.scroll){
                    $('ul.chat-box-body').animate({scrollTop: $('ul.chat-box-body').prop("scrollHeight")}, 500);
                }
            });
                
            }
            $('.txt_csrfname').val(response.token);
    }});
}


/*----------------------------------------------------------------------------------------------------
| Function to load messages
-------------------------------------------------------------------------------------------------------*/
function bootChat()
{
    refresh = setInterval(function(){
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    
    $.ajax(
        {
            type: 'GET',
            url : baseUrl + "chat/updates/",
            data :{[csrfName]: csrfHash },
            async : true,
            cache : false,
            success: function(data){
                if(data.token !==''){
                    $('.txt_csrfname').val(data.token);
                }
                
                if(data !== ''){
                if(data.response.success){
                     thread = data.response.messages;
                     senders = data.response.senders;
                     $.each(thread, function() {
                        if($("#chat_buddy_id").val() !== ''){
                            chatbuddy = $("#chat_buddy_id").val();
                                if(this.sender == chatbuddy){
                                    if(currentDate !== new Date(this.time).getDate())
                                    {  
                                        currentDate = new Date(this.time).getDate();
                                        timeSlot =  '<div class="message-time-sign">'+
                                        '<span>'+timeSince(new Date(this.time).getTime())+' ago '+'</span>'+
                                        '</div>';

                                        $('#chat-message').append(timeSlot);
                                    }


                                    if(this.sender === userID )
                                    {   
                                        chatMsg =   '<div class="message-bubble me">'+
                                                    '<div class="message-bubble-inner">'+
                                                    '<div class="message-avatar"><img src="'+baseUrl+'assets/img/users/'+this.avatar+'" alt="" /></div>'+
                                                    '<div class="message-text"><p>'+this.body+'</p></div>'+
                                                    '</div>'+
                                                    '<div class="clearfix"></div>'+
                                                    '</div>';
                                    }
                                    else if(this.recipient === userID)
                                    {
                                        chatMsg =   '<div class="message-bubble">'+
                                                    '<div class="message-bubble-inner">'+
                                                    '<div class="message-avatar"><img src="'+baseUrl+'assets/img/users/'+this.avatar+'" alt="" /></div>'+
                                                    '<div class="message-text"><p>'+this.body+'</p></div>'+
                                                    '</div>'+
                                                    '<div class="clearfix"></div>'+
                                                    '</div>';
                                    }

                                    $('#chat-message').append(chatMsg);
                                    $('#chat-message').animate({scrollTop: $('#chat-message').prop("scrollHeight")}, 500);
                                    //Mark this message as read
                                    $.ajax({ type: "POST", url: baseUrl + "chat/mark_read", data: {id: this.msg,[csrfName]: csrfHash}});
                                }
                                else{
                                    from = this.sender;
                                    $.each(senders, function() {
                                        if(this.user == from){
                                            $(".chat-group").find('span[rel="'+from+'"]').text(this.count);
                                        }
                                    });
                                }
                         }
                         else{
                            from = this.sender;
                            $.each(senders, function() {
                                if(this.user == from){
                                    $(".chat-group").find('span[rel="'+from+'"]').text(this.count);
                                }
                            });
                            
                         }
                     });
                }
                }
            },
                error : function(XMLHttpRequest, textstatus, error) { 
                            console.log(error); 
                }
        }
    );

       }, 2000);
}


/*----------------------------------------------------------------------------------------------------
| Calculate time ago
-------------------------------------------------------------------------------------------------------*/
function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = Math.floor(seconds / 31536000);

  if (interval > 1) {
    return interval + " years";
  }
  interval = Math.floor(seconds / 2592000);
  if (interval > 1) {
    return interval + " months";
  }
  interval = Math.floor(seconds / 86400);
  if (interval > 1) {
    return interval + " days";
  }
  interval = Math.floor(seconds / 3600);
  if (interval > 1) {
    return interval + " hours";
  }
  interval = Math.floor(seconds / 60);
  if (interval > 1) {
    return interval + " minutes";
  }
  return Math.floor(seconds) + " seconds";
}

