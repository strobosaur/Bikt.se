// FUNCTION UPDATE POSTS
function getPostsAjax(){
    $.get("post_update_ajax.php", function(data){
        $("#post-column").empty();
        $("#post-column").append(data);
    });
}

setInterval(getPostsAjax, 1000);

// FUNCTION GET LOGIN FORM
function getLoginAjax(){
    $.get("login_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
    });
}

// FUNCTION GET REGISTER FORM
function getRegisterAjax(){
    $.get("register_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
    });
}

// FUNCTION GET POST FORM
function getPostformAjax(){
    $.get("post_create_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
    });
}

// FUNCTION GET MENU
function getMenuAjax(){
    $.get("nav_menu_ajax.php", function(data){
        $("#nav-menu").empty();
        $("#nav-menu").append(data);
    });
}

$(document).ready(function(){

    // SEND POST TO DATABASE
    $('#form-post').submit(function(e) {
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

    // DELETE POST FROM DATABASE
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
                getPostsAjax();
                console.log(data);
            }
        });
    });

    // LOGIN HANDLING
    $('#form-login').submit(function(e){
        e.preventDefault();

        var uname = $("#login_email").val();
        var pwd = $("#login_password").val();

        $.ajax({
            url: 'login_process.php',
            type: 'POST',
            data: {
                'login': 1,
                'login_email': uname,
                'login_password': pwd,
            },
            success: function(response){
                if (response == true) {
                    getPostformAjax();
                    $("#form-post").append("<p><br>Inloggningen lyckades</p>");

                    getMenuAjax();
                } else {
                    getLoginAjax();
                    $("#form-login").append("<p><br>Inloggningen misslyckades</p>");

                    getMenuAjax();
                }
            }
        })
    })

    // NAVIGATION MENU REGISTER
    $('#menu_register').click(function(e) {
        e.preventDefault();
        getRegisterAjax();
    })

    // NAVIGATION MENU LOGIN
    $('#menu_login').click(function(e) {
        e.preventDefault();
        getLoginAjax();
    })

    // NAVIGATION MENU LOGOUT
    $('#menu_logout').click(function(e) {
        e.preventDefault();
        $.get("logout_process.php", function(){
            getLoginAjax();
            getMenuAjax();
        })
    })
});