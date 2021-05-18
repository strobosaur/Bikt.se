<?php

// FUNCTION GET TIME FROM SQL
function getTimeFromDateTime($dateTime){
    $timeRaw = explode(" ",$dateTime);
    $timeArr = explode(":",$timeRaw[1]);
    return ($timeArr[0] . ":" . $timeArr[1]);
}

// FUNCTION GET DATE FROM SQL
function getDateFromDateTime($dateTime){
    $dateRaw = explode(" ",$dateTime);
    return str_replace("-","/",$dateRaw[0]);
}

// FUNCTION VALIDATE & ADD COMMENT FUNCTION
function addPost($userID,$userName,$userEmail,$userPost,$imgFilePath = null)
{
    require_once 'login.inc.php';

    // TRIM VARIABLES
    $userNameValue = trim($userName);
    $userEmailValue = trim($userEmail);
    $userPostValue = trim($userPost);

    // INPUT VALIDATION
    if (strlen($userNameValue) < 3) {
        header("location: index.php?error=nametooshort");
        exit();
    } else if (!isEmail($userEmailValue)) {
        header("location: index.php?error=invalidemail");
        exit();
    } else if (strlen($userPostValue) < 10) {
        header("location: index.php?error=posttooshort");
        exit();
    } else {

        // PREPARE QUERY
        $db = new SQLite3("./db/labb1.db");

        $sql = "INSERT INTO 'posts' (userID, userName, userEmail, userPost, postImage)
        VALUES (:userID, :userName, :userEmail, :userPost, :postImage)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);
        $stmt->bindParam(':userName', $userNameValue, SQLITE3_TEXT);
        $stmt->bindParam(':userEmail', $userEmailValue, SQLITE3_TEXT);
        $stmt->bindParam(':userPost', $userPostValue, SQLITE3_TEXT);

        // HANDLE POST IMAGE
        if ($imgFilePath === null) {
            $stmt->bindParam(':postImage', $imgFilePath, SQLITE3_NULL);
        } else {
            $stmt->bindParam(':postImage', $imgFilePath, SQLITE3_TEXT);
        }

        // EXECUTE QUERY
        if ($stmt->execute()){
            $db->close();
            return true;
        } else {
            $db->close();
            return false;
        }
    }
}

// FUNCTION CHECK IF POST EXISTS
function postExists($postID)
{
    $db = new SQLite3("./db/labb1.db");
    $sql = "SELECT * FROM posts WHERE postID = :postID";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':postID', $postID, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if($row = $result->fetchArray()){
        $db->close();
        return $row;
    } else {
        $db->close();
        return false;
    }
}

// FUNCTION DELETE POST
function deletePost($postID) 
{
    $result = postExists($postID);
    
    if ($result === false) {
        header("location: index.php?error=postnotfound");
        exit();
    } else {
        // DELETE IMAGE
        if ($result['postImage'] != null) {
            unlink($result['postImage']);
        }

        // PREPARE DB QUERY
        $db = new SQLite3("./db/labb1.db");
        $sql = "DELETE FROM 'posts' WHERE postID = :postID";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postID', $postID, SQLITE3_INTEGER);

        // EXECUTE QUERY
        if ($stmt->execute()) {
            $db->close();
            header("location: index.php?error=postremoved");
            exit();
        } else {
            $db->close();
            header("location: index.php?error=postnotremoved");
            exit();
        }
    }
}

// FUNCTION UPLOAD IMAGE
function uploadImg($fileName,$fileTmpName,$fileError) {

    $fileExt = end(explode('.', strtolower($fileName)));

    $allowedExtArr = array('jpg', 'jpeg', 'png');

    if (in_array($fileExt, $allowedExtArr)) {
        if ($fileError === 0) {
            $fileNameNew = date("Ymd_His_") . uniqid('',true) . "." . $fileExt;
            $fileDestination = "./uploads/img/" . $fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
            return $fileDestination;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>