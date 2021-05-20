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