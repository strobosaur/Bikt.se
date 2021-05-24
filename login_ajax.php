<?php
$login_form =
'<div class="container">
    <div class="formbox">
        <div class="header">
            <h2>Bikt.se</h2>    
        </div>

        <!-- WELCOME MESSAGE -->
        <div class="paragraf">
            <p1 id="p-welcome"><i>Behöver du lätta på ditt hjärta?<br>Bikta dig anonymt online</i></p1>";
        </div>

        <div class="header">
            <h4>Login</h4>    
        </div>

        <form class="form" id="form-login" name="form-login" onsubmit="checkLoginInput();" action="" method="POST">
                                
            <div class="form-control">
            <label>Användarnamn</label>
            <input type="text" placeholder="namn / epost" name="login_email" id="login_email">
            <small>Error message</small>
            </div>
                            
            <div class="form-control">
            <label>Lösenord</label>
            <input type="password" placeholder="password" name="login_password" id="login_password">
            <small>Error message</small>
            </div>
            
            <button type="submit" name="login" id="login">Login</button>
            
            <?php
                include_once "login_errors.php";
            ?>
                                   
        </form>
    </div>
</div>';

echo $login_form;
?>