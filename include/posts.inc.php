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

// FUNCTION COUNT POST REPLIES
function countReplies($postID){
    $db = new SQLite3("./db/labb1.db");
    $sql = "SELECT COUNT(repID)
            AS rep_count 
            FROM replies
            WHERE postID = :postID";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(":postID", $postID, SQLITE3_INTEGER);
    $count = $stmt->execute();

    if($row = $count->fetchArray()){
        $db->close();
        return $row['rep_count'];
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
    $replies = countReplies($row['postID']);

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
                    '<button class="link-reply-btn" type="submit" data-cid="'. $row['postID'] .'">Svara</button>';
                }

                // DISPLAY DELETE BUTTON IF POSTER IS LOGGED IN
                if((isset($_SESSION['userID'])) && ($_SESSION['userID'] == $row['userID'])){
                    $post .=
                    '<button class="link-delete-btn" type="submit" data-cid="'. $row['postID'] .'">Radera</button>';
                }
                
                // DISPLAY COMMENTS
                if (isset($_SESSION['userID']) && $replies != false) {                    
                    $post .= 
                    '<button class="link-view-reply-btn" type="submit" data-cid="'. $row['postID'] .'">Kommentarer(' . $replies . ')</button>';
                }

            $post .= 
            '</div>';

                // DISPLAY REPLY BUTTON IF USER LOGGED IN
                /*if (isset($_SESSION['userID']) && $replies != false) {                    
                    $post .= 
                    '<div class="post-footer2" id="post-footer2">
                        <button class="link-view-reply-btn" type="submit" data-cid="'. $row['postID'] .'">Kommentarer(' . $replies . ')</button>
                    </div>';
                }*/

            $post .= 
        '</div>
    </div>';

    return $post;
}

// FUNCTION MAKE REPLY
function makeReply($row){

    // GET REPLIER DATA
    $replierData = userExists($row['replierID']);

    if($replierData === false){
        return false;
    } else if (strlen($row['replyText']) < 5) {
        ?>
        <script>setBottomBarMessage("Kommentaren är för kort");
        <?php
        return false;
    } else {

        // GET REPLY DATA
        $replierID = $replierData['userID'];
        $replierName = $replierData['nname'];
        $replierEmail = $replierData['email'];
        $replyID = $row['repID'];
        $replyText = $row['replyText'];
        $replyDateTime = $row['replyDateTime'];

        // GET REPLY DATE & TIME
        $dateTime = getDateFromDateTime($replyDateTime) . " - " . getTimeFromDateTime($replyDateTime);
        $userProfileImg = fetchProfileImg($replierID);

        $reply = 
        '<div class="container">
            <div class="postbox">
                <div class="profile-field">
                    <img class="profile-img" id="profile-img" src="' . $userProfileImg . '" width="48px" height="48px">
                    <h4>' . $replierName . '</h4>
                </div>
    
                <div class="post-header" id="post-header" name="post-header">
                <small>' . $dateTime . '</small>';
    
                // SHOW MAIL ADRESS IF LOGGED IN
                if (isset($_SESSION['userID'])) {
                    $reply .= '<a href="mailto:' . $replierEmail . '">' . $replierEmail . '</a>';
                }
                
                $reply .= 
                '</div>
                <p>' . $replyText;
    
                // FOOTER CONTAINER
                $reply .= '</p>
                <div class="post-footer" id="post-footer">';

                // DISPLAY DELETE BUTTON IF POSTER IS LOGGED IN
                if((isset($_SESSION['userID'])) && ($_SESSION['userID'] == $replierID)){
                    $reply .=
                    '<button class="link-delete-reply-btn" type="submit" data-cid="'. $replyID .'">Radera</button>';
                }
    
                $reply .= 
                '</div>
            </div>
        </div>';
    
        return $reply;
    }
}

?>