// FUNCTION VALIDATE EMAIL INPUT
function isEmail(email) {
    if ((email.indexOf("@") == -1) 
    || (email.indexOf(".") == -1)
    || (email.length < 6)
    || (email.lastIndexOf(".") < email.lastIndexOf("@"))) {
        return false;
    } else {
        return true;
    }
}

// FUNCTION SET FORM FIELD ERROR
function setErrorFor(input, msg) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    
    small.innerText = msg;
    formControl.className = 'form-control error';
}

// FUNCTION SET FORM FIELD SUCCESS
function setSuccessFor(input) {
    const formControl = input.parentElement;  
    formControl.className = 'form-control success';
}

function setBottomBarMessage(msg){
    $("#message-bar").empty();
    $("#message-bar").append("<div class='fade-out' id='fade-out'><p class='message' id='btm-msg'>" + msg + "</p></div>");
}

// FUNCTION CHECK POST INPUTS
function checkPostInput() {
    const msgtext = document.getElementById('msgtext');
    const msgtextValue = msgtext.value.trim();

    var isOk = new Boolean(1);
    
    // CHECK MESSAGE TEXT
    if ((msgtextValue === '') || (msgtextValue.length < 10)) {
        setErrorFor(msgtext, 'Skriv en bekännelse');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(msgtext);
    }

    if (isOk == false){
        if (event.preventDefault){
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
    }

    return isOk;
}

// FUNCTION CHECK REG INPUTS
function checkRegInput() {
    const fname = document.getElementById('fname');
    const lname = document.getElementById('lname');
    const nname = document.getElementById('nname');
    const email = document.getElementById('email');
    const password1 = document.getElementById('password1');
    const password2 = document.getElementById('password2');

    const fnameValue = fname.value.trim();
    const lnameValue = lname.value.trim();
    const nnameValue = nname.value.trim();
    const emailValue = email.value.trim();
    const password1Value = password1.value;
    const password2Value = password2.value;

    var isOk = new Boolean(1);
    
    // CHECK USER FIRST NAME
    if ((fnameValue === '') || (fnameValue.length < 2)) {
        setErrorFor(fname, 'Ange ett förnamn');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(fname);
    }
    
    // CHECK USER LAST NAME
    if ((lnameValue === '') || (lnameValue.length < 2)) {
        setErrorFor(lname, 'Ange ett efternamn');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(lname);
    }
    
    // CHECK USER LAST NAME
    if ((nnameValue === '') || (nnameValue.length < 2)) {
        setErrorFor(nname, 'Ange ett användarnamn');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(nname);
    }
    
    // CHECK EMAIL
    if ((emailValue === '') || (!isEmail(emailValue))) {
        setErrorFor(email, 'Ange en korrekt epostadress');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(email);
    }
    
    // CHECK MESSAGE TEXT
    if ((password1Value === '') 
    || (password1Value.length < 8)) {
        setErrorFor(password1, 'Lösenordet måste vara minst 8 tecken');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(password1);
    }

    if (password2Value.length < 8) {
        setErrorFor(password2, 'Lösenordet måste vara minst 8 tecken');
        isOk = new Boolean(0);
    } else if (password1Value !== password2Value) {  
        setErrorFor(password2, 'Lösenorden matchar inte');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(password2);
    }

    if (isOk == false){
        setBottomBarMessage("Registreringen misslyckades");
        if (event.preventDefault){
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
    }

    return isOk;
}

// FUNCTION CHECK LOGIN INPUTS
function checkLoginInput() {
    const email = document.getElementById('login_email');
    const password = document.getElementById('login_password');

    const emailValue = email.value.trim();
    const passwordValue = password.value;

    var isOk = new Boolean(1);
    
    // CHECK EMAIL
    if (emailValue === '') {
        setErrorFor(email, 'Ange användarnamn / e-post');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(email);
    }
    
    // CHECK PASSWORD
    if ((passwordValue === '') 
    || (passwordValue.length < 8)) {
        setErrorFor(login_password, 'Lösenordet måste vara minst 8 tecken');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(password);
    }

    if (isOk == false){
        if (event.preventDefault){
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
    }

    return isOk;
}

// FUNCTION CHECK LOGIN INPUTS
function checkReplyInput() {
    const replyText = document.getElementById('msgtext');
    const replyTextVal = replyText.value.trim();

    var isOk = new Boolean(1);
    
    // CHECK EMAIL
    if (replyTextVal.length < 5) {
        setErrorFor(replyText, 'Svaret är för kort');
        isOk = new Boolean(0);
    } else {
        setSuccessFor(replyText);
    }

    if (isOk == false){
        if (event.preventDefault){
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
    }

    return isOk;
}

// FUNCTION GET SEARCH RESULT POSTS
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
            updatePostsAjax();
            $.getScript("./js/search.js");
        }
    });
}

// FUNCTION SEARCH POST FORM
function getProfileAjax(){
    $.ajax({
        url: 'profile_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'get_profile': 1,
        },
        success: function(response){
            stopUpdatePosts();
            $('#flex-container1').empty();
            $('#flex-container1').append(response.left);
            $('#flex-container2').empty();
            $('#flex-container2').append(response.right);
            $.getScript("./js/profile_img_update.js");
            $.getScript("./js/profile_img_delete.js");
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
            $.getScript("./js/nav_menu.js");
        }
    });
}

// FUNCTION UPDATE POSTS
function updatePostsAjax(){
    $.ajax({
        url: 'post_update_ajax.php',
        type: 'POST',
        data: {
            'update_posts': 1,
        },
        success: function(response){
            $("#flex-container2").empty();
            $("#flex-container2").append(response);
            $.getScript("./js/delete_post.js");
            $.getScript("./js/reply.js");
            $.getScript("./js/reply_view.js");
        }
    });
}

// FUNCTION UPDATE POSTS
function updateRepliesAjax(postID){
    $.ajax({
        url: 'post_reply_view_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'view-reply': 1,
            'postID': postID,
        },
        success: function(response){
            $("#flex-container2").empty();
            $("#flex-container2").append(response.two);
            $.getScript("./js/reply_delete.js");
        }
    });
}

// FUNCTION CLEAR UPDATES
function stopUpdatePosts(){
    clearInterval(intervalUpdatePosts);
}

// FUNCTION START UPDATING POSTS
function startUpdatePosts(){
    clearInterval(intervalUpdatePosts);
    intervalUpdatePosts = setInterval(updatePostsAjax, 2500);
}