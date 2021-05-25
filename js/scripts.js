// FUNCTION UPDATE POSTS
function updatePostsAjax(){
    $.post("post_update_ajax.php", function(data){
        $("#post-column").empty();
        $("#post-column").append(data);
    });
}

// FUNCTION UPDATE POSTS
function getSearchResultsAjax(){
    $.post("search_process.php", function(data){
        $("#post-column").empty();
        $("#post-column").append(data);
    });
}

// FUNCTION GET LOGIN FORM
function getLoginAjax(){
    $.post("login_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
        $.getScript("./js/scripts.js");
    });
}

// FUNCTION GET REGISTER FORM
function getRegisterAjax(){
    $.post("register_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
        $.getScript("./js/scripts.js");
    });
}

// FUNCTION GET POST FORM
function getPostformAjax(){
    $.post("post_create_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
        $.getScript("./js/scripts.js");
    });
}

// FUNCTION SEARCH POST FORM
function getSearchAjax(){
    $.post("search_ajax.php", function(data){
        $("#flex-container1").empty();
        $("#flex-container1").append(data);
        $.getScript("./js/scripts.js");
    });
}

// FUNCTION GET MENU
function getMenuAjax(){
    $.post("nav_menu_ajax.php", function(data){
        $("#nav-menu").empty();
        $("#nav-menu").append(data);
        $.getScript("./js/scripts.js");
    });
}

$(document).ready(function(){

    // SEND POST TO DATABASE
    $('#form-post').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'post_process_ajax.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){
                $('#msgtext').val('');
                $('#file').val(null);
                $('#post-column').append(response);
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
                updatePostsAjax();
            }
        });
    });

    // SEARCH POST IN DATABASE
    $('#form-search').submit(function(e) {
        e.preventDefault();

        var keyword = $('#search_text').val();

        $.ajax({
            url: 'search_process_ajax.php',
            type: 'POST',
            data: {
                'search': 1,
                'search_text': keyword,
            },
            success: function(response){
                clearInterval(postUpdate);
                $('#search_text').val('');
                $("#post-column").empty();
                $('#post-column').append(response);
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
                    $.getScript("./js/scripts.js");
                } else {
                    getLoginAjax();
                    $("#form-login").append("<p><br>Inloggningen misslyckades</p>");

                    getMenuAjax();
                    $.getScript("./js/scripts.js");
                }
            }
        })
    })

    // NAVIGATION MENU REGISTER
    $('#menu_register').click(function(e) {
        e.preventDefault();
        getRegisterAjax();
        $.getScript("./js/scripts.js");
    })

    // NAVIGATION MENU LOGIN
    $('#menu_login').click(function(e) {
        e.preventDefault();
        getLoginAjax();
        $.getScript("./js/scripts.js");
    })

    // NAVIGATION MENU SEARCH
    $('#menu_search').click(function(e) {
        e.preventDefault();
        getSearchAjax();
        $.getScript("./js/scripts.js");
    })

    // NAVIGATION MENU LOGIN
    /*$('#menu_home').click(function(e) {
        e.preventDefault();
        getPostformAjax();
        $.getScript("./js/scripts.js");
    })*/

    // NAVIGATION MENU LOGOUT
    $('#menu_logout').click(function(e) {
        e.preventDefault();
        $.post("logout_process.php", function(){
            location.href = "index.php";
            getLoginAjax();
            getMenuAjax();
            updatePostsAjax();
            $.getScript("./js/scripts.js");
        })
    })
});