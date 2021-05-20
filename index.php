<?php
    require_once 'header.php';
?>

<!-- CREATE POST / LOGIN CONTAINER -->
<div class="flex-container1" id="flex-container1">

    <!-- FORM HANDLING -->
    <?php
        if(isset($_SESSION['userID'])) {
            require_once 'post_create.php';
        } else {
            require_once 'login.php';
        }
    ?>
</div>

<!-- POSTS CONTAINER -->
<div class="flex-container2" id="flex-container2">
    <div id="post-column">
    </div>
</div>

<script>updatePostsAjax()</script>

<?php
require_once 'footer.php';
?>