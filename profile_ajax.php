<?php
session_start();

// PROTECTION
if(!isset($_POST['get_profile']) || !isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';
    require_once './include/posts.inc.php';

    $profileImg = fetchProfileImg($_SESSION['userID']);
    $userData = userExists($_SESSION['userID']);

    $uname = $userData['nname'];
    $fname = $userData['fname'];
    $lname = $userData['lname'];
    $email = $userData['email'];
    
    // CREATE LOGIN FORM
    $profileLeft =
    '<div class="container">
        <div class="formbox">
            <div class="header">
                <h2>Bikt.se</h2>    
            </div>

            <div class="profile-view-top" id="profile-view-top">
                <img src="' . $profileImg . '" width="96px" height="96px">
                <h3 id="profile-h3">' . $uname . '</h3>    
            </div>                        

            <div class="profile-view-main">
                <div class="left-field">
                    <p2>Förnamn: </p2>
                    <p2>Efternamn: </p2>
                    <p2>Epost: </p2>
                </div>
                <div class="right-field">
                    <p1>' . $fname . '</p1><br>
                    <p1>' . $lname . '</p1><br>
                    <p1>' . $email . '</p1>
                </div>
            </div>
            
            <div class="header">
                <h4>Ändra profilbild</h4>    
            </div>
            
            <form class="form" id="form" action="register_img_process.php" method="POST" enctype="multipart/form-data">

                <div class="form-control">
                <input class="custom-file-upload" type="file" name="file">
                <small>Error message</small>
                </div>

                <button type="submit" name="submit-img" id="submit-img">Ladda upp</button>

            </form>
        </div>
    </div>';
    
    // CREATE LOGIN FORM
    $profileRight =
    '<div class="container">
        <div class="formbox">

            <div class="header">
                <h4>Ändra profiluppgifter</h4>    
            </div>

            <form class="form" id="form" onsubmit="checkRegInput();" action="register_update.php" method="POST">
                
                <div class="form-control">
                <label>Förnamn</label>
                <input type="text" placeholder="förnamn..." name="fname" id="fname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Efternamn</label>
                <input type="text" placeholder="efternamn..." name="lname" id="lname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Användarnamn</label>
                <input type="text" placeholder="användarnamn..." name="nname" id="nname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>E-post</label>
                <input type="email" placeholder="user@mail.com..." name="email" id="email">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Nuvarande lösenord</label>
                <input type="password" placeholder="lösenord..." name="password0" id="password0">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Nytt lösenord</label>
                <input type="password" placeholder="lösenord..." name="password1" id="password1">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Bekräfta nytt lösenord</label>
                <input type="password" placeholder="lösenord..." name="password2" id="password2">
                <small>Error message</small>
                </div>
                
                <button type="submit" name="update" id="update">Uppdatera!</button>
                                
            </form>
        </div>
    </div>';

    // CREATE RETURN ARRAY
    $returnArr = array("left"=>$profileLeft,"right"=>$profileRight);
    echo json_encode($returnArr);
}
?>