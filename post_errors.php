<?php
if (isset($_GET['error'])) {
    if($_GET['error'] == "") {
        echo "<p><br>Något gick fel</p>";
    } else if ($_GET['error'] == "postfailed") {
        echo "<p><br>Biktningen misslyckades</p>";
    } else if ($_GET['error'] == "postsent") {
        echo "<p><br>Biktningen har postats</p>";
    }
}
?> 