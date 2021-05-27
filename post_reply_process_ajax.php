<?php 
session_start();

// PROTECTION
if (!isset($_POST["post-reply"]) || !isset($_SESSION["userID"])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';
    require_once './include/posts.inc.php';

    $db = new SQLite3("./db/labb1.db");

    $replierID = $_POST['replierID'];
    $postID = $_POST['postID'];
    $replyText = $_POST['msgtext'];

    $sql = "INSERT INTO replies (postID, replierID, replyText) 
            VALUES (:postID, :replierID, :replyText)";

    $stmt = $db->prepare($sql); 

    $stmt->bindParam(':postID', $postID, SQLITE3_INTEGER);
    $stmt->bindParam(':replierID', $replierID, SQLITE3_INTEGER);
    $stmt->bindParam(':replyText', $replyText, SQLITE3_TEXT);

    // EXECUTE STATEMENT
    if ($stmt->execute()) {
        $db->close();
        echo true;
        exit();
    } else {
        $db->close();
        echo false;
        exit();
    }
}

?>