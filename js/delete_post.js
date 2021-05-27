// DELETE POST FROM DATABASE
$('#form-delete-btn').submit(function(e){
    e.preventDefault();

    var id = $('#postID').val();
    $.ajax({
        url: 'post_delete_ajax.php',
        type: 'POST',
        data: {
            'post-delete': 1,
            'postID': id,
        },
        success: function(){
            updatePostsAjax();
            setBottomBarMessage("Post raderad");
        }
    });
});