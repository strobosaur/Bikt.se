<?php

// DELETE POST
if (!isset($_POST['post-delete'])) {
    header("location: index.php");
    exit();
} else {
    
    require_once './include/posts.inc.php';
    deletePost($_POST['postID']);

    exit();
}

?>