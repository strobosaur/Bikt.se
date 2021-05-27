// DELETE POST FROM DATABASE
$('.link-delete-btn').click(function(e){
    e.preventDefault();
    var cid = $(this).data('cid');

    //var id = $('#postID').val();
    $.ajax({
        url: 'post_delete_ajax.php',
        type: 'POST',
        data: {
            'post-delete': 1,
            'postID': cid,
        },
        success: function(){
            updatePostsAjax();
            setBottomBarMessage("Post raderad");
        }
    });
});