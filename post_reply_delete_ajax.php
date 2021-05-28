<?php
if (isset($_POST['reply-delete'])) {
    require_once './include/posts.inc.php';

    if($postID = deleteReply($_POST['replyID'])){
        echo $postID;
    } else {
        echo "false";
    }
} else {
    echo "false";
}
?>