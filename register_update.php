<?php
session_start();

// VALIDATE INPUT AND STORE IN DATABASE
if (!isset($_POST['update']) || !isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';    

    /*var_dump($_SESSION['userEmail']);
    var_dump($_POST['password0']);
    exit();*/
    // CHECK PASSWORD INPUT
    if (passwordMatchesDB($_SESSION['userEmail'], $_POST['password0']) === false) {
        header("location: profile.php?error=wrongpwd");
        exit();
    }
    
    if (updateUserProfile($_SESSION['userID'], $_POST['fname'], $_POST['lname'], $_POST['nname'], $_POST['email'], $_POST['password1'], $_POST['password2'])){
        header("Location: profile.php?error=none");
        ?>
        <script>setBottomBarMessage("Din profil har uppdaterats");</script>
        <?php
        exit();
    } else {
        header("Location: profile.php?error=invalidinput");
        ?>
        <script>setBottomBarMessage("Något gick fel");</script>
        <?php
        exit();
    }
}

?>