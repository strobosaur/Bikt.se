<?php

require_once './include/posts.inc.php';
require_once './include/login.inc.php';

$db = new SQLite3("./db/labb1.db");
$result = $db->query("SELECT * FROM 'posts' ORDER BY postID DESC");

while ($row = $result->fetchArray())
{        
    $postID = $row['postID'];
    $userName = $row['userName'];
    $userEmail = $row['userEmail'];
    $userPost = $row['userPost'];
    $postDateTime = $row['postDateTime'];
    $postImg = $row['postImage'];
    $dateTime = getDateFromDateTime($postDateTime) . " - " . getTimeFromDateTime($postDateTime);
    $userProfileImg = fetchProfileImg($userEmail);
    if ($userProfileImg == null) {
        $userProfileImg = "./img/default_profile_img.png";
    }

// POST CONTAINER
echo '<div class="container">';
    echo '<div class="postbox">';
        echo '<div class="profile-field">';
            echo '<img class="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">';
            echo '<h4>' . $userName . '</h4>';
        echo '</div>';
        echo '<a href="mailto:' . $userEmail . '">' . $userEmail . '</a>';
        if ($postImg == null) {
            echo '<p>' . $userPost . '</p>';
        } else {
            echo '<p>' . $userPost . '<img src="' . $postImg . '"></p>';
        }
        echo '<small>' . $dateTime . '</small>';

        // DELETE BUTTON
        echo '<form class="form-link-btn" action="post_delete.php" method="POST">';
            echo '<input type="hidden" value="' . $postID . '" name="postID">';
            echo '<button class="link-btn" type="submit" name="post-delete" id="post-delete">Radera</button>';
        echo '</form>';
        /*echo '<a href="post_delete.php?id=' . $postID . '" name="' . $postID . '" id="' . $postID . '">Radera</a>';
        echo '<a href="post_delete.php?id=' . $postID . '" name="' . $postID . '" id="' . $postID . '">Radera</a>';*/
    echo '</div>';
echo '</div>';
/*usleep(250000);*/
}
$db->close();
?>