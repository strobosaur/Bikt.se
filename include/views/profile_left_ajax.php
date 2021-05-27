<?php

// PROTECTION
if(!isset($_POST['get_profile'])) {
    header("location: index.php");
    exit();
} else {

    $profileImg = fetchProfileImg($_SESSION['userID']);
    
    // CREATE LOGIN FORM
    $profileLeft =
    '<div class="container">
        <div class="formbox">
            <div class="header">
                <h2>Bikt.se</h2>    
            </div>

            <div class="header">
                <h4>Profil</h4>    
            </div>

            <img class="profile-img2" src="' . $profileImg . '" width="96px" height="96px">            

            <div class="paragraf">
                <p2>Användarnamn: </p2><p1>' . $_SESSION['userNname'] . '</p1><br>
                <p2>Förnamn: </p2><p1>' . $_SESSION['userFname'] . '</p1><br>
                <p2>Efternamn: </p2><p1>' . $_SESSION['userLname'] . '</p1><br>
                <p2>Epost: </p2><p1>' . $_SESSION['userEmail'] . '</p1>
            </div>
        </div>
    </div>';

    echo $profileLeft;
}
?>