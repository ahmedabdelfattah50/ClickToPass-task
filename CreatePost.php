<?php 

require_once "init.php";

    if($_SESSION['name']){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $postHeader = $_POST['postHeader'];
            $postBody = $_POST['postBody'];
    
            $user_db = new DB;
            $user_session = new Session;
    
            // call the function to create the post and insert it in the database
            $user_db->createPost($postHeader , $postBody , $user_session->getSessionItem('id'));  
            echo "  <div class='container'>
                        <p class='alert alert-success' style='margin:20px 0;'>Success of Creating a new post you will return to your posts page in 1s</p>
                    </div>";
            header("Refresh:1; url=userPosts.php");
        }
?>

<div class="container">
    <h1 class="text-center">Create Post</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Post Header</label>
            <input name="postHeader" type="text" class="form-control" placeholder="Enter the Header of your post" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Post Body</label>
            <textarea name="postBody" type="text" class="form-control" placeholder="Enter the Body of your post" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php 
    } else {
        header("Location:index.php");
    }

?>