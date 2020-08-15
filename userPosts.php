<?php 
    require_once "init.php";
    $db = new DB;
    $session = new Session;

    if(isset($_SESSION['name'])){
?>
<div class="container">
    <h2 class="headerTotalMyPosts text-center">My Posts</h2>
    <div class='user_posts_btns d-flex justify-content-between'>
        <a class='btn btn-success' href='CreatePost.php'>Create Post</a>
        <a class='btn btn-info' href='index.php'>Main page</a>
        <a class='btn btn-dark' href='logout.php'>Logout</a>
    </div>
    <div class="users_posts">
    <?php
        $userId = $_SESSION['id'];          // the id of the current user
        $postDatas = $db->selectPost($userId);
        $i = 1;
        if(count($postDatas) == 0){
            echo "<div class='post'>";
                echo "<h2>Sorry you don't have any post, you can create post now <a class='btn btn-success' href='CreatePost.php'>Create Post</a></h2>";
            echo "</div>";
        } else {
            foreach($postDatas as $postData){
                echo "<div class='post'>"; // get all data of the owner of the post ?>         
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete <?php echo $postData['header']?> post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure to want to delete this post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="deletePost.php?id=<?php echo $postData['id']?>"><button type="button" class="btn btn-danger">Yes</button></a>
                    </div>
                    </div>
                </div>
                </div>
                <h2 class="post_header"><?php echo $i . " - " . $postData['header']?></h2>
                <p class="post_body"><?php echo $postData['body']?></p>
               
                <div class="post_footer d-flex justify-content-between">
                        <a class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
                    <p>Date: <?php echo $postData['created_date']?></p>
                </div>
                <?php
                $i++;   
                echo "</div>";
            }   
        }
    ?>     
    </div>
</div>
<?php
    } else {
        header("location:index.php");
    }
?>