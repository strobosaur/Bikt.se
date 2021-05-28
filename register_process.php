<?php

// VALIDATE INPUT AND STORE IN DATABASE
if (!isset($_POST['submit'])) {
    header("location: register.php");
    exit();
} else {

    require_once './include/login.inc.php';
    
    if (registerUserToDB($_POST['fname'], $_POST['lname'], $_POST['nname'], $_POST['email'], $_POST['password1'], $_POST['password2'])){
        header("location: index.php?error=regsuccess");
        exit();
    } else {
        header("location: index.php=regfailed");
        exit();
    }
}

?>