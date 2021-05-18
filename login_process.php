<?php

    if (!isset($_POST["login"])) {
        header("Location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        if (loginUser($_POST['login_email'], $_POST['login_password'])){
            header("Location: loggedIn.php");
            exit();
        } else {            
            header("Location: loggedInFailed.php");
            exit();
        }
    }
?>