<?php
    require_once './include/views/_header.php';
?>

<div class="mid-column" id="mid-column">
    <!-- CREATE POST / LOGIN CONTAINER -->
    <div class="flex-container1" id="flex-container1">

        <!-- FORM HANDLING -->
        <?php
            if(isset($_SESSION['userID'])) {
                ?>
                <script>
                    getPostformAjax();
                    $.getScript("./js/scripts.js");
                </script>
                <?php
            } else {
                ?>
                <script>
                    getLoginAjax();
                    $.getScript("./js/scripts.js");
                    $.getScript("./js/reply.js");
                    $.getScript("./js/reply_view.js");
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
</div>

<?php
    include 'message_handling.php';
?>

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