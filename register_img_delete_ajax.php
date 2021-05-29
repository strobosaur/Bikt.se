<?php
session_start();

// VALIDATE INPUT AND STORE IN DATABASE
if ((!isset($_POST['delete-img'])) || (!isset($_SESSION['userID'])))  {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php'; 

    $userID = $_SESSION['userID'];
    $fileDestination = null;

    if (changeProfileImg($userID,$fileDestination)) {
        $_SESSION['userProfileImg'] = $fileDestination;
        echo true;
    } else {
        echo false;
    }    
}
?>