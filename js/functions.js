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
  $("#footer-bar").empty();
  $("#footer-bar").append("<div class='fade-out' id='fade-out'><p class='message' id='btm-msg'>" + msg + "</p></div>");
  //$("#btm-msg").append(
    /*document.getElementById("footer-bar").innerHTML +=
    "<div class='fade-out' id='fade-out'><p class='message' id='btm-msg'>" + msg + "</p></div>";*/
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

// FUNCTION UPDATE POSTS
function updatePostsAjax(){
  $.ajax({
      url: 'post_update_ajax.php',
      type: 'POST',
      data: {
          'update_posts': 1,
      },
      success: function(response){
          $("#post-column").empty();
          $("#post-column").append(response);
          $.getScript("./js/delete_post.js");
      }
  });
}