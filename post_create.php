<form class="form" id="form" onsubmit="checkPostInput();" action="post_process.php" method="POST" enctype="multipart/form-data">
    
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
    
    <button type="submit" name="submit" id="submit">Skicka</button>
    <!--<button onclick="document.location='logout_process.php'" name="logout" id="logout">Logga ut</button>-->

    <?php
    if (isset($_GET['error'])) {
        if($_GET['error'] == "") {
            echo "<p>Något gick fel</p>";
        } else if ($_GET['error'] == "postfailed") {
            echo "<p>Biktningen misslyckades</p>";
        } else if ($_GET['error'] == "postsent") {
            echo "<p>Biktningen har postats</p>";
        }
    }
    ?>    
</form>