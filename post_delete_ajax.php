<?php

// DELETE POST
if (!isset($_POST['post-delete'])) {
    echo false;
} else {

    require_once './include/posts.inc.php';
    deletePost($_POST['postID']);

    echo true;
}

?>