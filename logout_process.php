<?php
    include_once './include/login.inc.php';
    session_start();
    session_unset();
    session_destroy();
?>