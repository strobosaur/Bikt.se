// DELETE POST FROM DATABASE
$('.link-delete-reply-btn').click(function(e){
    e.preventDefault();
    var cid = $(this).data('cid');
    
    $.ajax({
        url: 'post_reply_delete_ajax.php',
        type: 'POST',
        data: {
            'reply-delete': 1,
            'replyID': cid,
        },
        success: function(response){
            setBottomBarMessage("Kommentar raderad");
            updateRepliesAjax(response);
        }
    });
});