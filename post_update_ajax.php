<?php

require_once './include/login.inc.php';
require_once './include/posts.inc.php';

// Retrieve comments from database
$db = new SQLite3("./db/labb1.db");

$sql = "SELECT * FROM posts ORDER BY postID DESC";
$result = $db->query($sql);

//$comments = '<div class="flex-container2">';
$comments = '';
while ($row = $result->fetchArray()) {
    $userProfileImg = fetchProfileImg($row['userEmail']);

    $comments .= 
    '<div class="container">
    <div class="postbox">
    <div class="profile-field">
        <img class="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">
        <h4>' . $row['userName'] . '</h4>
    </div>
    <a href="mailto:' . $row['userEmail'] . '">' . $row['userEmail'] . '</a>
    <p>' . $row['userPost'];

    // INSERT IMAGE IF UPLOADED
    if ($row['postImage'] != null){
        $comments .= '<img src="' . $row['postImage'] . '">';
    }

    $comments .= '</p>
    <form class="form-link-btn" id="form-delete-btn" name="form-delete-btn" action="post_delete.php" method="POST">
        <input type="hidden" value="' . $row['postID'] . '" id="postID" name="postID">
        <button class="link-btn" type="submit" name="post-delete" id="post-delete">Radera</button>
    </form>
    </div>
    </div>';
}
//$comments .= '</div>';

echo $comments;
?>