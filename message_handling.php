<?php
if(isset($_GET['error'])){
    if($_GET['error'] == 'imgsuccess'){        
        echo '<script>setBottomBarMessage("Din profilbild har uppdaterats");</script>';
    } else if($_GET['error'] == 'imgfailed'){        
        echo '<script>setBottomBarMessage("Din profilbild kunde inte uppdateras");</script>';
    } else if($_GET['error'] == 'regsuccess'){        
        echo '<script>setBottomBarMessage("Ditt konto har registrerats");</script>';
    } else if($_GET['error'] == 'regfailed'){        
        echo '<script>setBottomBarMessage("Ditt konto kunde inte registreras");</script>';
    } else if($_GET['error'] == 'updsuccess'){        
        echo '<script>setBottomBarMessage("Din profildata har uppdaterats");</script>';
    } else if($_GET['error'] == 'updfailed'){        
        echo '<script>setBottomBarMessage("Din profildata kunde inte uppdateras");</script>';
    }
}
?>