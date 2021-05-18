<?php
session_start();

/*var_dump($_POST);
var_dump($_FILES);
exit();*/

// VALIDATE INPUT AND STORE IN DATABASE
if ((!isset($_POST['submit'])) || (!isset($_SESSION['userID']))) {
    header("Location: index.php");
    exit();
} else if ($_FILES['file']['error'] === 0){

    require_once './include/posts.inc.php';

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    // UPLOAD IMAGE
    $fileDestination = uploadImg($fileName,$fileTmpName,$fileError);

    // ADD POST & IMAGE PATH
    if ($fileDestination !== false) {
        if (addPost($_SESSION['userID'], $_SESSION['userNname'], $_SESSION['userEmail'], $_POST['msgtext'], $fileDestination)) {
            header("Location: index.php?error=postsent");
            exit();        
        } else {
            header("Location: index.php?error=postfail");
            exit(); 
        }
    } else {
        header("Location: index.php?error=imagefail");
        exit(); 
    }
} else {

    require_once './include/posts.inc.php';

    // ADD POST
    if (addPost($_SESSION['userID'], $_SESSION['userNname'], $_SESSION['userEmail'], $_POST['msgtext'])) {
        header("Location: index.php?error=postsent");
        exit();        
    } else {
        header("Location: index.php?error=postfail");
        exit(); 
    }
}

?>