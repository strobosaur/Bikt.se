<?php
    include_once './include/login.inc.php';
    ?>
    <script>setBottomBarMessage("Du är nu utloggad");</script>
    <?php
    session_start();
    session_unset();
    session_destroy();
    header("location: index.php");
?>