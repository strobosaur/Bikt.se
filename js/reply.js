// REPLY TO POST
$('.link-reply-btn').click(function(e){
    e.preventDefault();
    var cid = $(this).data('cid');

    $.ajax({
        url: 'post_reply_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'get-reply': 1,
            'postID': cid,
        },
        success: function(response){
            stopUpdatePosts();
            $("#flex-container1").empty();
            $("#flex-container1").append(response.replyform);
            $("#flex-container2").empty();
            $("#flex-container2").append(response.originalpost);
            $.getScript("./js/reply_process.js");
        }
    });
});