<?php
session_start();

require_once './include/login.inc.php';
require_once './include/posts.inc.php';

// GET POSTS FROM DB
$db = new SQLite3("./db/labb1.db");

$sql = "SELECT * FROM posts ORDER BY postID DESC";
$result = $db->query($sql);

//$posts = '<div class="flex-container2">';
$posts = '';

// APPEND EACH POST TO OUTPUT
while ($row = $result->fetchArray()) {
    $userProfileImg = fetchProfileImg($row['userEmail']);
    $postDateTime = $row['postDateTime'];
    $dateTime = getDateFromDateTime($postDateTime) . " - " . getTimeFromDateTime($postDateTime);

    $posts .= 
    '<div class="container">
        <div class="postbox">
            <div class="profile-field">
                <img class="profile-img" id="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">
                <h4>' . $row['userName'] . '</h4>
            </div>';
            if (isset($_SESSION['userID'])) {
                $posts .= '<a href="mailto:' . $row['userEmail'] . '">' . $row['userEmail'] . '</a>';
            }
            
            $posts .= '<p>' . $row['userPost'];

            // INSERT IMAGE IF UPLOADED
            if ($row['postImage'] != null){
                $posts .= '<img src="' . $row['postImage'] . '">';
            }

            $posts .= '</p>
            <small>' . $dateTime . '</small>';

            // DISPLAY DELETE BUTTON IF POSTER LOGGED IN
            if ((isset($_SESSION['userID'])) && ($_SESSION['userID'] == $row['userID'])){
                $posts .= 
                '<form class="form-link-btn" id="form-delete-btn" name="form-delete-btn" action="post_delete.php" method="POST">
                    <input type="hidden" value="' . $row['postID'] . '" id="postID" name="postID">
                    <button class="link-btn" type="submit" name="post-delete" id="post-delete">Radera</button>
                </form>';
            }

            $posts .= 
        '</div>
    </div>';
}

echo $posts;
?>