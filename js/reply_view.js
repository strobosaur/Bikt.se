// VIEW REPLIES TO POST
$('.link-view-reply-btn').click(function(e){
    e.preventDefault();
    var cid = $(this).data('cid');

    $.ajax({
        url: 'post_reply_view_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'view-reply': 1,
            'postID': cid,
        },
        success: function(response){
            stopUpdatePosts();
            $("#flex-container1").empty();
            $("#flex-container1").append(response.one);
            $("#flex-container2").empty();
            $("#flex-container2").append(response.two);
        }
    });
});