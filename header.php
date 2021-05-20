<!DOCTYPE html>

<?php
    session_start();
?>

<html>

<head>
    <title>Bikt.se</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/functions.js"></script>
    <script src="./js/scripts.js"></script>
</head>

    <body>
        <nav id="nav-menu" name="nav-menu">
            <ul>
                <?php
                if (isset($_SESSION['userID'])){
                    echo '<li><a id="menu_home" href="index.php">Home</a></li>';
                    echo '<li><a id="menu_profile" href="profile.php">Profile</a></li>';
                    echo '<li><a id="menu_search" href="search.php">Sök</a></li>';
                    echo '<li><a id="menu_logout" href="logout_process.php">Log out</a></li>';
                } else {
                    echo '<li><a id="menu_login" href="index.php">Login</a></li>';
                    echo '<li><a id="menu_register" href="register.php">Register</a></li>';
                }
                ?>
            </ul>
        </nav>