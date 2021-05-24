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
    $posts .= makePost($row);
}

echo $posts;
?>