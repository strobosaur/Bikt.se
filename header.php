<!DOCTYPE html>

<?php
    session_start();
?>

<html>

<head>
    <title>Bikt.se</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/gridstyles.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/functions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

    <body>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php
                if (isset($_SESSION['userID'])){
                    echo '<li><a href="profile.php">Profile</a></li>';
                    echo '<li><a href="search.php">Sök</a></li>';
                    echo '<li><a href="logout_process.php">Log out</a></li>';
                } else {
                    echo '<li><a href="index.php">Login</a></li>';
                    echo '<li><a href="register.php">Register</a></li>';
                }
                ?>
            </ul>
        </nav>