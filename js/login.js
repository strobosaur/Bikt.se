// LOGIN HANDLING
$('#form-login').submit(function(e){
    if (checkLoginInput()){
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
                    setBottomBarMessage("Inloggningen lyckades")

                    getMenuAjax();
                    updatePostsAjax();
                    $.getScript("./js/scripts.js");
                } else {
                    //getLoginAjax();
                    setBottomBarMessage("Inloggningen misslyckades")

                    //getMenuAjax();
                    //updatePostsAjax();
                }
            }
        })
    }
})