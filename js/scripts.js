function getPostsAjax(){
    $.get("post_update_ajax.php", function(data){
        $("#ajax").empty();
        $("#ajax").append(data);
        //console.log(data);
    });
}

setInterval(getPostsAjax, 1000);

$(document).ready(function(){

    // SEND POST TO DATABASE
    $('#form').submit(function(e) {
        e.preventDefault();

        var username = $('#name').val();
        var post_text = $('#msgtext').val();
        var email = $('#email').val();
        var userID = $('#userID').val();
        //var img_upload = $('#file');

        $.ajax({
            url: 'post_process_ajax.php',
            type: 'POST',
            data: {
                'post_send': 1,
                'username': username,
                'post_text': post_text,
                'email': email,
                'userID': userID,
                //'img_upload': img_upload,
            },
            success: function(response){
                $('#name').val('');
                $('#msgtext').val('');
                $('#ajax').append(response);
                console.log(data);
            }
        });
    });

    // delete from database
    $('#form-delete-btn').submit(function(e){
        e.preventDefault();

        var id = $('#postID').val();
        $.ajax({
            url: 'post_process_ajax.php',
            type: 'POST',
            data: {
            'post_delete': 1,
            'postID': id,
        },
        success: function(data){
            // remove the deleted comment
            getPostsAjax();
            console.log(data);
        }
        });
    });

    /*var edit_id;
    var $edit_comment;
    $(document).on('click', '.edit', function(){
        edit_id = $(this).data('id');
        $edit_comment = $(this).parent();
        // grab the comment to be editted
        var name = $(this).siblings('.display_name').text();
        var comment = $(this).siblings('.comment_text').text();
        // place comment in form
        $('#name').val(name);
        $('#comment').val(comment);
        $('#submit_btn').hide();
        $('#update_btn').show();
    });
    $(document).on('click', '#update_btn', function(){
        var id = edit_id;
        var name = $('#name').val();
        var comment = $('#comment').val();
        $.ajax({
        url: 'server.php',
        type: 'POST',
        data: {
            'update': 1,
            'id': id,
            'name': name,
            'comment': comment,
        },
        success: function(response){
            $('#name').val('');
            $('#comment').val('');
            $('#submit_btn').show();
            $('#update_btn').hide();
            $edit_comment.replaceWith(response);
        }
        });		
    });*/
});

    $('#menu_register').click(function(e) {
        e.preventDefault();
        $.get("register_ajax.php", function(data){
            $("#flex-container1").empty();
            $("#flex-container1").append(data);
        })
    })

    $('#menu_login').click(function(e) {
        e.preventDefault();
        $.get("login_ajax.php", function(data){
            $("#flex-container1").empty();
            $("#flex-container1").append(data);
        })
    })

    /*$('#menu_logout').click(function(e) {
        e.preventDefault();
        $.post("logout_ajax.php", function(data){
            $("#flex-container1").empty();
            $("#flex-container1").append(data);
        })
    })*/