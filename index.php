<?php
require_once 'header.php';
//include 'post_update_ajax.php';
?>

<!-- CREATE POST / LOGIN CONTAINER -->
<div class="flex-container1">
    <div class="container">
        <div class="formbox">
        <div class="header">
            <h2>Bikt.se</h2>    
        </div>

        <!-- WELCOME MESSAGE -->
        <div class="paragraf">
            <?php
                if(isset($_SESSION['userNname']))
                {
                    echo '<p1 id="p-welcome"><i>Välkommen tillbaka ' 
                    . $_SESSION['userNname'] 
                    . '. <br>Behöver du lätta på ditt hjärta?<br>Bikta dig anonymt online</i></p1>';
                } else {
                    echo '<p1 id="p-welcome"><i>Behöver du lätta på ditt hjärta?<br>Bikta dig anonymt online</i></p1>';
                }
            ?>
        </div>

        <!-- FORM HANDLING -->
        <?php
            if(isset($_SESSION['userID'])) {
                require_once 'post_create.php';
            } else {
                require_once 'login.php';
            }
        ?>
            
        </div>
    </div>
</div>

<!-- POSTS CONTAINER -->
<div class="flex-container2" id="flex-container2">
    <div id="ajax">
    <?php
        //echo $comments;
    ?>
    </div>
</div>
<script src="./js/scripts.js"></script>

<?php
require_once 'footer.php';
?>