<?php

// PROTECTION
if(!isset($_POST['get_profile'])) {
    header("location: index.php");
    exit();
} else {
    
    // CREATE LOGIN FORM
    $profileRight =
    '<div class="container">
        <div class="formbox">
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

    echo $profileRight;
}
?>