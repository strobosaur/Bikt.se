<?php
session_start();

// PROTECTION
if(!isset($_POST['get_reply']) || !isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {
    
    // CREATE REPLY FORM
    $replyForm =
    '<div class="container">
        <div class="formbox">
            <div class="header">
                <h2>Bikt.se</h2>    
            </div>

            <!-- WELCOME MESSAGE -->
            <div class="paragraf">
                <p1 id="p-welcome"><i>Behöver du lätta på ditt hjärta?<br>Bikta dig anonymt online</i></p1>";
            </div>

            <div class="header">
                <h4>Kommentera på '. $_POST['posterName'] .'"´s post</h4>    
            </div>

            <form class="form" id="form-reply" name="form-reply" onsubmit="checkReplyInput();" action="" method="POST">
                                                  
                <div class="form-control">
                <label>Kommentar</label>
                <textarea placeholder="Bikta din synd" name="msgtext" id="msgtext" maxlength="500"></textarea>
                <small>Error message</small>
                </div>
                
                <input type="hidden" value="' . $_SESSION["userID"] . '" name="replierID" id="replierID">
                <input type="hidden" value="' . $_POST["postID"] . '" name="postID" id="postID">
                
                <button type="submit" name="reply-submit" id="reply-submit">Skicka</button> 
                                    
            </form>
        </div>
    </div>';

    echo $replyForm;
}
?>