// FUNCTION UPDATE POSTS
function getSearchResultsAjax(){
    $.ajax({
        url: 'search_process_ajax.php',
        type: 'POST',
        data: {
            'search': 1,
        },
        success: function(response){
            $("#post-column").empty();
            $("#post-column").append(response);
        }
    });
}

// FUNCTION GET LOGIN FORM
function getLoginAjax(){
    $.ajax({
        url: './include/views/login_ajax.php',
        type: 'POST',
        data: {
            'get_login': 1,
        },
        success: function(response){
            $("#flex-container1").empty();
            $("#flex-container1").append(response);
            $.getScript("./js/login.js");
        }
    });
}

// FUNCTION GET REGISTER FORM
function getRegisterAjax(){
    $.ajax({
        url: './include/views/register_ajax.php',
        type: 'POST',
        data: {
            'get_register': 1,
        },
        success: function(response){
            $("#flex-container1").empty();
            $("#flex-container1").append(response);
        }
    });
}

// FUNCTION GET POST FORM
function getPostformAjax(){
    $.ajax({
        url: './include/views/post_create_ajax.php',
        type: 'POST',
        data: {
            'get_postform': 1,
        },
        success: function(response){
            $("#flex-container1").empty();
            $("#flex-container1").append(response);
            $.getScript("./js/post.js");
        }
    });
}

// FUNCTION SEARCH POST FORM
function getSearchAjax(){
    $.ajax({
        url: './include/views/search_ajax.php',
        type: 'POST',
        data: {
            'get_search': 1,
        },
        success: function(response){
            $("#flex-container1").empty();
            $("#flex-container1").append(response);
        }
    });
}

// FUNCTION GET MENU
function getMenuAjax(){
    $.ajax({
        url: './include/views/nav_menu_ajax.php',
        type: 'POST',
        data: {
            'get_menu': 1,
        },
        success: function(response){
            $("#nav-menu").empty();
            $("#nav-menu").append(response);
            $.getScript("./js/scripts.js");
        }
    });
}

// WAIT FOR DOCUMENT LOAD
$(document).ready(function(){

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
            getMenuAjax();
            updatePostsAjax();
            $.getScript("./js/scripts.js");
            $.getScript("./js/login.js");
        })
    })
});