// LOGIN HANDLING
$('#form-login').submit(function(e){
    if (checkLoginInput()){
        e.preventDefault();

        var uname = $("#login_email").val();
        var pwd = $("#login_password").val();

        $.ajax({
            url: 'login_process_ajax.php',
            type: 'POST',
            data: {
                'login': 1,
                'login_email': uname,
                'login_password': pwd,
            },
            success: function(response){
                if (response == true) {
                    getPostformAjax();
                    getMenuAjax();
                    updatePostsAjax();
                    setBottomBarMessage("Du är nu inloggad")
                } else {
                    setBottomBarMessage("Inloggningen misslyckades")
                }
            }
        })
    }
})