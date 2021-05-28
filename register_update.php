<?php
session_start();

// VALIDATE INPUT AND STORE IN DATABASE
if (!isset($_POST['update']) || !isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';    

    // CHECK PASSWORD INPUT
    if (passwordMatchesDB($_SESSION['userEmail'], $_POST['password0']) === false) {
        header("location: index.php");
        exit();
    }
    
    if (updateUserProfile($_SESSION['userID'], $_POST['fname'], $_POST['lname'], $_POST['nname'], $_POST['email'], $_POST['password1'], $_POST['password2'])){
        header("Location: index.php?error=updsuccess");
        exit();
    } else {
        header("Location: index.php?error=updfailed");
        exit();
    }
}

?>