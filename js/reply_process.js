// SEND POST TO DATABASE
$('#form-reply').submit(function(e) {
    e.preventDefault();
    
    var replierID = $("#replierID").val();
    var postID = $("#postID").val();
    var msgtext = $("#msgtext").val();

    $.ajax({
        url: 'post_reply_process_ajax.php',
        type: 'POST',
        data: {
            'post-reply': 1,
            'postID': postID,
            'replierID': replierID,
            'msgtext': msgtext,
        },
        success: function(response){
            if(response != true){
                $("#msgtext").val('');
                setBottomBarMessage("Något gick fel...");
            } else {                
                setBottomBarMessage("Kommentaren postad");
                getPostformAjax();
                updatePostsAjax();
                startUpdatePosts();
            }
        }
    });
});