<?php
    require_once 'header.php';
?>

<!-- CREATE POST / LOGIN CONTAINER -->
<div class="flex-container1" id="flex-container1">

    <!-- FORM HANDLING -->
    <?php
        if(isset($_SESSION['userID'])) {
            ?>
            <script>getPostformAjax();</script>
            <?php
            //require_once 'post_create.php';
        } else {
            ?>
            <script>getLoginAjax();</script>
            <?php
            //require_once 'login.php';
        }
    ?>
</div>

<!-- POSTS CONTAINER -->
<div class="flex-container2" id="flex-container2">
    <div id="post-column">
    </div>
</div>

<script>
updatePostsAjax();
var postUpdate = setInterval(updatePostsAjax, 1000);
</script>

<?php
require_once 'footer.php';
?>