<?php 

require_once './include/login.inc.php';
require_once './include/posts.inc.php';

if (isset($_POST["userID"])) {

    //print_r($_POST['form_data']);
    //exit();
    /*print_r($_FILES);
    exit();*/

    $db = new SQLite3("./db/labb1.db");

    $userID = $_POST['userID'];
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userPost = $_POST['msgtext'];
    $userProfileImg = fetchProfileImg($userID);

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

    $result = $db->query("SELECT last_insert_rowid() AS last_insert_rowid")->fetchArray();
    $postID = $result['last_insert_rowid'];

    // POST CONTAINER
    $posted_comment = 
        '<div class="container">
        <div class="postbox">
        <div class="profile-field">
            <img class="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">
            <h4>' . $userName . '</h4>
        </div>
        <a href="mailto:' . $userEmail . '">' . $userEmail . '</a>
        <p>' . $userPost;

        // INSERT IMAGE IF UPLOADED
        if ($fileDestination != null){
            $posted_comment .= '<img src="' . $fileDestination . '">';
        }

        $posted_comment .= '</p>
        <form class="form-link-btn" action="post_delete.php" method="POST">
            <input type="hidden" value="' . $postID . '" name="postID">
            <button class="link-btn" type="submit" name="post-delete" id="post-delete">Radera</button>
        </form>
        </div>
        </div>';

        $db->close();
        echo $posted_comment;
    } else {
        echo "Error: ";
    }
    exit();
}

// DELETE POST
if (isset($_POST['post_delete'])) {

    $postID = $_POST['postID'];
    $result = postExists($postID);

    // DELETE IMAGE
    if($result['postImage'] != null){
        unlink($result['postImage']);
    }

    // PREPARE DB QUERY
    $db = new SQLite3("./db/labb1.db");
    $sql = "DELETE FROM posts WHERE postID = :postID";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':postID', $postID, SQLITE3_INTEGER);

    $stmt->execute();
    $db->close();

    exit();
}
/*
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $sql = "UPDATE comments SET name='{$name}', comment='{$comment}' WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
        $id = mysqli_insert_id($conn);
        $saved_comment = '<div class="comment_box">
        <span class="delete" data-id="' . $id . '" >delete</span>
        <span class="edit" data-id="' . $id . '">edit</span>
        <div class="display_name">'. $name .'</div>
        <div class="comment_text">'. $comment .'</div>
    </div>';
    echo $saved_comment;
    }else {
    echo "Error: ". mysqli_error($conn);
    }
    exit();
}*/


?>