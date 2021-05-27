// REPLY TO POST
$('#form-reply-btn').submit(function(e){
    e.preventDefault();

    var id = $('#postID').val();
    $.ajax({
        url: 'post_reply_process_ajax.php',
        type: 'POST',
        data: {
            'post-reply': 1,
            'postID': id,
        },
        success: function(data){
            updatePostsAjax();
            setBottomBarMessage("Kommentar postad");
        }
    });
});