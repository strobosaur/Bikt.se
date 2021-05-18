<?php
require_once 'header.php';
?>

<div class="flex-container2">
    <div class="container">
        <div class="formbox">
    
            <div class="header">
                <h2>Registrering</h2>    
            </div>

            <form class="form" id="form" onsubmit="checkRegInput();" action="register_process.php" method="POST">
                
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
                <label>Nickname</label>
                <input type="text" placeholder="nickname..." name="nname" id="nname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>E-post</label>
                <input type="email" placeholder="user@mail.com..." name="email" id="email">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Lösenord</label>
                <input type="password" placeholder="lösenord..." name="password1" id="password1">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Bekräfta lösenord</label>
                <input type="password" placeholder="lösenord..." name="password2" id="password2">
                <small>Error message</small>
                </div>
                
                <button type="submit" name="submit" id="submit">Registrera</button>

                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "") {
                        echo "<p>Något gick fel</p>";
                    } else if ($_GET['error'] == "usernametaken") {
                        ?>
                        <script>setErrorFor(document.getElementById('nname', "Användarnamnet är redan registrerat"));</script>
                        <?php
                    } else if ($_GET['error'] == "useremailtaken") {
                        ?>
                        <script>setErrorFor(document.getElementById('email', "Epostadressen är redan registrerad"));</script>
                        <?php
                    }
                }
                ?>
                
            </form>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>