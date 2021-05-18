<div class="header">
    <h4>Login</h4>    
</div>

<form class="form" id="form" onsubmit="checkLoginInput();" action="login_process.php" method="POST">
                        
    <div class="form-control">
    <label>Mailadress</label>
    <input type="text" placeholder="anon@mail.com" name="login_email" id="login_email">
    <small>Error message</small>
    </div>
                    
    <div class="form-control">
    <label>Lösenord</label>
    <input type="password" placeholder="Password" name="login_password" id="login_password">
    <small>Error message</small>
    </div>
    
    <button type="submit" name="login" id="login">Login</button>
    <button onclick="document.location='register.php'" name="register" id="register">Registrera</button>

    <?php

    // ERROR CHECKING
    if (isset($_GET['error'])) {
        if($_GET['error'] == "") {
            ?>
            <script>setErrorFor(document.getElementById('login_email', "Något gick fel"));</script>
            <script>setErrorFor(document.getElementById('login_password', "Något gick fel"));</script>
            <?php
            //echo "<p>Något gick fel</p>";
        } else if ($_GET['error'] == "none") {
            echo "<p>Registreringen lyckades</p>";
        } else if ($_GET['error'] == "nouser") {
            ?>
            <script>setErrorFor(document.getElementById('login_email', "Kontot finns inte"));</script>
            <?php
            //echo "<p>Kontot finns inte</p>";
        } else if ($_GET['error'] == "wrongpwd") {
            ?>
            <script>setSuccessFor(document.getElementById('login_email'));</script>
            <script>setErrorFor(document.getElementById('login_password', "Fel lösenord"));</script>
            <?php
            //echo "<p>Fel lösenord</p>";
        } else if ($_GET['error'] == "loggedin") {
            echo "<p>Inloggningen lyckades</p>";
        }
    }
    ?>                        
</form>