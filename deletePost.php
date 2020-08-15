<?php 
    require_once "init.php";
    $db = new DB;
    $session = new Session;

    // get the value of the (id) of the post by using GET method
    $delId = $_GET['id'];

    if((!isset($_SESSION['name'])) && (!is_int($delId)) && (!isset($_GET['id']))){
        header("location:index.php");
    } else {
        $db->deletePost($delId);       // call the function for deleting the post
?>

    <div class='container'>
        <h2 class='alert alert-info' style="margin: 20px 0;">The post has been deleted you will return to main page in 1s</h2>
    </div>

<?php
    header("Refresh:1; url=userPosts.php");
    }




