<?php
session_start();
$nav_menu =
'<ul>';
    if (isset($_SESSION['userID'])){
        $nav_menu .=
        '<li><a id="menu_home" href="index.php">Home</a></li>
        <li><a id="menu_profile" href="profile.php">Profile</a></li>
        <li><a id="menu_search" href="search.php">Sök</a></li>
        <li><a id="menu_logout" href="logout_process.php">Log out</a></li>';
    } else {
        $nav_menu .=
        '<li><a id="menu_login" href="index.php">Login</a></li>
        <li><a id="menu_register" href="register.php">Register</a></li>';
    }


$nav_menu .=
'</ul>';

echo $nav_menu;
?>