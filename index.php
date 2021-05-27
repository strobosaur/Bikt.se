<?php
    require_once './include/views/_header.php';
?>

<!-- CREATE POST / LOGIN CONTAINER -->
<div class="flex-container1" id="flex-container1">

    <!-- FORM HANDLING -->
    <?php
        if(isset($_SESSION['userID'])) {
            ?>
            <script>
                getPostformAjax();
                $.getScript("./js/scripts.js");
                $.getScript("./js/reply.js");
            </script>
            <?php
        } else {
            ?>
            <script>
                getLoginAjax();
                $.getScript("./js/scripts.js");
                $.getScript("./js/reply.js");
            </script>
            <?php
        }
    ?>
</div>

<!-- POSTS CONTAINER -->
<div class="flex-container2" id="flex-container2">
    <div id="post-column">
    </div>
</div>

<div id="update-posts">
    <script>
        $(document).ready(function(){
            updatePostsAjax();
        });
        var intervalUpdatePosts = setInterval(updatePostsAjax, 2500);
    </script>
</div>

<?php
    require_once './include/views/_footer.php';
?>