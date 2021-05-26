<?php
session_start();

// VALIDATE INPUT AND STORE IN DATABASE
if ((!isset($_POST['submit-img'])) || (!isset($_SESSION['userID'])))  {
    header("location: profile.php");
    exit();
} else if ($_FILES['file']['error'] !== 0) {
    header("location: profile.php?error=nofile");
    exit();
} else {

    require_once './include/login.inc.php'; 

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $userID = $_SESSION['userEmail'];

    // UPLOAD IMAGE
    $fileDestination = uploadProfileImg($userID,$fileName,$fileTmpName,$fileError);

    // ADD POST & IMAGE PATH
    if ($fileDestination !== false) {
        if (changeProfileImg($userID,$fileDestination)) {
            $_SESSION['userProfileImg'] = $fileDestination;
            header("location: profile.php?error=imgsuccess");
            ?>
            <script>setBottomBarMessage("Din profilbild har uppdaterats");</script>
            <?php
            exit();
        } else {
            unlink($fileDestination);
            header("location: profile.php?error=imgfail");
            ?>
            <script>setBottomBarMessage("Något gick fel");</script>
            <?php
            exit();
        }
    }
}
?>