// WAIT FOR DOCUMENT LOAD
$(document).ready(function(){

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

    // NAVIGATION MENU SEARCH
    $('#menu_search').click(function(e) {
        e.preventDefault();
        getSearchAjax();        
        startUpdatePosts();
    })

    // NAVIGATION MENU LOGOUT
    $('#menu_logout').click(function(e) {
        e.preventDefault();
        $.post("logout_process.php", function(){
            
            getMenuAjax();
            getLoginAjax();            
            updatePostsAjax();
            startUpdatePosts();
            setBottomBarMessage("Du är nu utloggad")
        })
    })

    // NAVIGATION MENU LOGIN
    $('#menu_home').click(function(e) {
        e.preventDefault();
        getPostformAjax();
        updatePostsAjax();
        startUpdatePosts();
    })    
});