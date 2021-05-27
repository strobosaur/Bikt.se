<?php
session_start();

// PROTECTION
if(!isset($_POST['view-reply']) || !isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';
    require_once './include/posts.inc.php';
    $postData = postExists($_POST['postID']);
    $posterData = userExists($postData['userID']);

    // ORIGINAL POST
    $originalPost = makePost($postData);

    // MAKE REPLIES LIST
    $db = new SQLite3("./db/labb1.db");

    $sql = "SELECT * FROM replies
            WHERE postID = :postID";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':postID', $_POST['postID'], SQLITE3_INTEGER);
    $result = $stmt->execute();

    // LOOP THROUGH ARRAY
    $replies = '';
    while($row = $result->fetchArray()) {
        $replies .= makeReply($row);
    }

    // MAKE RETURN ARRAY
    $returnArr = array("one"=>$originalPost, "two"=>$replies);
    echo json_encode($returnArr);
}