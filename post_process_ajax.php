<?php 

// PROTECTION
if (!isset($_POST["post-submit"])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';
    require_once './include/posts.inc.php';

    $db = new SQLite3("./db/labb1.db");

    $userID = $_POST['userID'];
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userPost = $_POST['msgtext'];
    $userProfileImg = fetchProfileImg($userID);

    if (strlen($userPost) < 10) {
        echo "too_short";
        exit();
    }

    $sql = "INSERT INTO posts (userID, userName, userEmail, userPost, postImage) 
            VALUES (:userID, :userName, :userEmail, :userPost, :postImage)";

    $stmt = $db->prepare($sql); 

    $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);
    $stmt->bindParam(':userName', $userName, SQLITE3_TEXT);
    $stmt->bindParam(':userEmail', $userEmail, SQLITE3_TEXT);
    $stmt->bindParam(':userPost', $userPost, SQLITE3_TEXT);

    // HANDLE IMAGE UPLOAD
    if ($_FILES['file']['error'] === 0){

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        
        $fileDestination = uploadImg($fileName,$fileTmpName,$fileError);
        $stmt->bindParam(':postImage', $fileDestination, SQLITE3_TEXT);
    } else {
        $fileDestination = null;
        $stmt->bindParam(':postImage', $fileDestination, SQLITE3_NULL);
    }

    // EXECUTE STATEMENT
    if ($stmt->execute()) {
        $db->close();
        $db = new SQLite3("./db/labb1.db");

        $lastID = $db->query("SELECT last_insert_rowid() AS last_insert_rowid")->fetchArray();
        $row = postExists($lastID['last_insert_rowid']);

        // CREATE POST CONTAINER
        $posted_comment = makePost($row);

        $db->close();
        echo $posted_comment;
        exit();
    } else {
        $db->close();
        echo "Error: ";
        exit();
    }
}

?>