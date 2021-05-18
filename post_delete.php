<?php
if (isset($_POST['post-delete'])) {
    require_once './include/posts.inc.php';
    deletePost($_POST['postID']);

    header("location: index.php?error=postdeleted");
    exit();
} else {
    header("location: index.php?error=postnotdeleted");
    exit();
}
?>