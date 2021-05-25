// SEND POST TO DATABASE
$('#form-post').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('post-submit', 1);

    $.ajax({
        url: 'post_process_ajax.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            //console.log(response);
            $('#msgtext').val('');
            $('#file').val(null);
            $('#post-column').append(response);
            updatePostsAjax();
        }
    });
});