<?php
    // ERROR CHECKING
    if (isset($_GET['error'])) {
        if($_GET['error'] == "") {
            ?>
            <script>setErrorFor(document.getElementById("login_email", "Något gick fel"));</script>
            <script>setErrorFor(document.getElementById('login_password', "Något gick fel"));</script>
            <?php
            //echo "<p>Något gick fel</p>";
        } else if ($_GET['error'] == "none") {
            echo "<p><br>Registreringen lyckades</p>";
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
            echo "<p><br>Inloggningen lyckades</p>";
        }
    }
?>