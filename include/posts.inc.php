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

// FUNCTION CHECK IF POST EXISTS
function replyExists($postID)
{
    $db = new SQLite3("./db/labb1.db");
    $sql = "SELECT * FROM replies WHERE postID = :postID";

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
        return false;
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
            return false;
        } else {
            $db->close();
            return false;
        }
    }
}

// FUNCTION UPLOAD IMAGE
function uploadImg($fileName,$fileTmpName,$fileError) {

    // GET FILE EXTENSION
    $fileExt = end(explode('.', strtolower($fileName)));

    // ALLOWED FILE EXTENSIONS
    $allowedExtArr = array('jpg', 'jpeg', 'png');

    // UPLOADED FILE EXTENSION IS ALLOWED
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

// FUNCTION SEARCH POSTS
function searchPosts($search){

    // PREPARE QUERY
    $db = new SQLite3("./db/labb1.db");
    $sql = "SELECT * FROM posts 
            WHERE userName LIKE :search
            OR userPost LIKE :search
            ORDER BY postID DESC";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':search', "%".$search."%", SQLITE3_TEXT);
  
    //CREATE POSTS STRING
    if($result = $stmt->execute()){
        $posts = '';
        while($row = $result->fetchArray()){
            $posts .= makePost($row);
        }
    } else {
        $db->close();
        return false;
    }

    $db->close();
    return $posts;
}

// FUNCTION MAKE POST FROM ROW
function makePost($row){
    $userProfileImg = fetchProfileImg($row['userEmail']);
    $postDateTime = $row['postDateTime'];
    $dateTime = getDateFromDateTime($postDateTime) . " - " . getTimeFromDateTime($postDateTime);

    $post = 
    '<div class="container">
        <div class="postbox">
            <div class="profile-field">
                <img class="profile-img" id="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">
                <h4>' . $row['userName'] . '</h4>
            </div>

            <div class="post-header" id="post-header" name="post-header">
            <small>' . $dateTime . '</small>';

            // SHOW MAIL ADRESS IF LOGGED IN
            if (isset($_SESSION['userID'])) {
                $post .= '<a href="mailto:' . $row['userEmail'] . '">' . $row['userEmail'] . '</a>';
            }
            
            $post .= 
            '</div>
            <p>' . $row['userPost'];

            // INSERT IMAGE IF UPLOADED
            if ($row['postImage'] != null){
                $post .= '<img src="' . $row['postImage'] . '">';
            }

            // FOOTER CONTAINER
            $post .= '</p>
            <div class="post-footer" id="post-footer">';

                // DISPLAY REPLY BUTTON IF USER LOGGED IN
                if (isset($_SESSION['userID'])) {
                    $post .= 
                    '<form class="form-link-btn" id="form-reply-btn" name="form-reply-btn" action="post_reply.php" method="POST">
                        <input type="hidden" value="' . $row['postID'] . '" id="postID" name="postID">
                        <input type="hidden" value="' . $row['userName'] . '" id="posterName" name="posterName">
                        <button class="link-btn" type="submit" name="post-reply" id="post-reply">Svara</button>
                    </form>';
                }

                // DISPLAY DELETE BUTTON IF POSTER IS LOGGED IN
                if((isset($_SESSION['userID'])) && ($_SESSION['userID'] == $row['userID'])){
                    $post .=
                    '<form class="form-link-btn" id="form-delete-btn" name="form-delete-btn" action="post_delete.php" method="POST">
                        <input type="hidden" value="' . $row['postID'] . '" id="postID" name="postID">
                        <button class="link-btn" type="submit" name="post-delete" id="post-delete">Radera</button>
                    </form>';
                }

            $post .= 
            '</div>
        </div>
    </div>';

    return $post;
}

function makeReply($postID,$userID){
    $replierData = userExists($userID);
    $replyData = replyExists($postID);

    if(($replierData === false) || ($replyData === false)){
        return false;
    } else {

        // GET REPLY DATE & TIME
        $dateTime = getDateFromDateTime($replyData['replyDateTime']) . " - " . getTimeFromDateTime($replyData['replyDateTime']);
        $userProfileImg = $replierData['profileImg'];

        $reply = 
        '<div class="container">
            <div class="replybox">
                <div class="profile-field">
                    <img class="profile-img" id="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">
                    <h4>' . $replierData['userName'] . '</h4>
                </div>
    
                <div class="post-header" id="post-header" name="post-header">
                <small>' . $dateTime . '</small>';
    
                // SHOW MAIL ADRESS IF LOGGED IN
                if (isset($_SESSION['userID'])) {
                    $reply .= '<a href="mailto:' . $replierData['userEmail'] . '">' . $replierData['userEmail'] . '</a>';
                }
                
                $reply .= 
                '</div>
                <p>' . $replyData['replyText'];
    
                // FOOTER CONTAINER
                $reply .= '</p>
                <div class="post-footer" id="post-footer">';
    
                    // DISPLAY DELETE BUTTON IF POSTER IS LOGGED IN
                    if((isset($_SESSION['userID'])) && ($_SESSION['userID'] == $replierData['userID'])){
                        $reply .=
                        '<form class="form-link-btn" id="form-delete-reply-btn" name="form-delete-reply-btn" action="reply_delete.php" method="POST">
                            <input type="hidden" value="' . $replyData['repID'] . '" id="replyID" name="replyID">
                            <button class="link-btn" type="submit" name="reply-delete" id="reply-delete">Radera</button>
                        </form>';
                    }
    
                $reply .= 
                '</div>
            </div>
        </div>';
    
        return $reply;
    }
}

?>