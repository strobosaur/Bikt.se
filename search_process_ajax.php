<?php
session_start();

    if (!isset($_POST["search"]) || !isset($_SESSION['userID'])) {
        header("Location: index.php");
        exit();
    } else {

        require_once './include/posts.inc.php';
        require_once './include/login.inc.php';

        $keyword = $_POST['search_text'];
        $result = searchPosts($keyword);
        
        /*var_dump($result);
        exit();*/

        if ($result !== false){
            $posts ='';
            while($row = $result->fetchArray()){
                $posts .= makePost($row);
            }
            echo $posts;
        } else {
            echo false;
        }
    }
?>