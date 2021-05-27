<?php
    require_once './include/views/_header.php';
?>

<?php
    // ENSURE USER IS LOGGED IN
    if(!isset($_SESSION['userID'])){
        header("location: index.php");
        exit();
    }
?>

<style>
.flex-container2 {
    width:512px;
    margin: 0px auto;
}

.container {
    width: 100%;
}
</style>

<div class="flex-container2">
    <div class="container">

        <div class="formbox"> 

            <div class="header">
                <h2>Profilsida</h2>
            </div>

            <?php
            if ($_SESSION['userProfileImg'] == null) {
                echo '<img class="profile-img2" src="./img/default_profile_img.png" width="96px" height="96px">';
            } else {
                echo '<img class="profile-img2" src="' . $_SESSION['userProfileImg'] . '" width="96px" height="96px">';
            }
            ?>

            <div class="paragraf">
            <?php
            echo '<p2>Användarnamn: </p2><p1>' . $_SESSION['userNname'] . '</p1><br>
                <p2>Förnamn: </p2><p1>' . $_SESSION['userFname'] . '</p1><br>
                <p2>Efternamn: </p2><p1>' . $_SESSION['userLname'] . '</p1><br>
                <p2>Epost: </p2><p1>' . $_SESSION['userEmail'] . '</p1>';
            ?>
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

                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "") {
                        echo "<p>Något gick fel</p>";
                    } else if ($_GET['error'] == "usernametaken") {
                        ?>
                        <script>setErrorFor(document.getElementById('nname', "Användarnamnet är redan registrerat"));</script>
                        <?php
                    } else if ($_GET['error'] == "emailtaken") {
                        ?>
                        <script>setErrorFor(document.getElementById('email', "E-postadressen är redan registrerad"));</script>
                        <?php
                    }
                }
                ?>
                
            </form>
        </div>
    </div>
</div>

<?php
    require_once './include/views/_footer.php';
?>