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
                updatePostsAjax();
            } else {
                getLoginAjax();
                $("#form-login").append("<p><br>Inloggningen misslyckades</p>");

                getMenuAjax();
                updatePostsAjax();
            }
        }
    })
})