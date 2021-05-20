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