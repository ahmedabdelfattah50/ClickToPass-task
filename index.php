<?php
    require_once "init.php";
    $db = new DB;
    $session = new Session;
?>

<div class="container">
    <h1 class="text-center">Welcome To our App <span>'ClickToPass'</span></h1>
    <div class="post_btns">
        <?php
        // in this if condition when there are user session this will return create a post and logout buttons
        if(isset($_SESSION['name'])){ 
            echo "<div class='user_logined d-flex justify-content-between'>";
                echo "<div>";
                    echo "<a class='btn btn-success' href='CreatePost.php'>Create Post</a>";
                    echo "<a class='btn btn-info' href='userPosts.php'>My Posts</a>";
                echo "</div>";
                echo "<p class='user_welcome'> Welcome eng / <span>" . $session->getSessionItem('name') . "</span></p>";  
                echo "<a class='btn btn-dark' href='logout.php'>Logout</a>";
            echo "</div>";      
               
        // the else of the previous if will return Sign Up and Sign In buttons
        } else {                
            echo "<div class='user_unlogined text-center'>";
                echo "<a class='btn btn-primary' href='SignUp.php'>Sign Up</a>";
                echo "<a class='btn btn-success' href='SignIn.php'>Sign In</a>";
            echo "</div>";            
        } 
        ?>        
    </div>
    <h2 class="headerTotalPosts text-center">Users Posts</h2>
    <div class="users_posts">
        <?php
        $results = $db->getPost();      // get all posts from the database
        if(count($results) == 0){
            echo "<div class='post'>";
                echo "<h2>Sorry No posts Here</h2>";
            echo "</div>";
        } else {
            foreach($results as $result){
                echo "<div class='post'>";
                // get all data of the owner of the post
                $postOwner = $db->selectUser($result['user_id']);     
                ?>
            <h2 class="post_header"><?php echo $result['header']?></h2>
            <p class="post_body"><?php echo $result['body']?></p>
            <div class="post_footer d-flex justify-content-between">
                <?php
                    // this if condition used to show if I who created this post or not
                    if(isset($_SESSION['id'])) {
                        if($postOwner['id'] == $_SESSION['id']) {
                            echo "<p>By: <span>" . $postOwner['name']  . " (Me)</span></p>";
                        } else {
                            echo "<p>By: <span>" . $postOwner['name']  . "</span></p>";
                        }
                    } else {
                        echo "<p>By: <span>" . $postOwner['name']  . "</span></p>";
                    }
                ?>
                <p>Date: <?php echo "<span>" . $result['created_date'] . "</span>"?></p>
            </div>
            <?php
            echo "</div>";
            }
        }?>
    </div>
</div>
