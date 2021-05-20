<?php
session_start();
$post_form =
'<div class="container">
    <div class="formbox">
        <div class="header">
            <h2>Bikt.se</h2>    
        </div>

        <!-- WELCOME MESSAGE -->
        <div class="paragraf">
            <p1 id="p-welcome"><i>Välkommen tillbaka ' . $_SESSION["userNname"] . '.<br>
                                Behöver du lätta på ditt hjärta?<br>
                                Bikta dig anonymt online</i></p1>";
        </div>

        <form class="form" id="form-post" name="form-post" onsubmit="checkPostInput();" method="POST" action="post_process.php" enctype="multipart/form-data">
            
            <div class="form-control">
            <label>Bekännelse</label>
            <textarea placeholder="Bikta din synd" name="msgtext" id="msgtext" maxlength="500"></textarea>
            <small>Error message</small>
            </div>
            
            <div class="form-control">
            <label>Bild</label>
            <input class="custom-file-upload" type="file" name="file">
            <small>Error message</small>
            </div>
            
            <input type="hidden" value="' . $_SESSION["userNname"] . '" name="name" id="name">
            <input type="hidden" value="' . $_SESSION["userEmail"] . '" name="email" id="email">
            <input type="hidden" value="' . $_SESSION["userID"] . '" name="userID" id="userID">
            
            <button type="submit" name="submit" id="submit">Skicka</button> 

            <?php
                include_once "post_errors.php";
            ?>
        </form>
    </div>
</div>';

echo $post_form;
?>