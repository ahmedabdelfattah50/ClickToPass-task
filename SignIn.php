<?php 
    require_once "init.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email_signIn    = $_POST['email'];
        $password_signIn = $_POST['password'];
        
        $userSelector = new DB;     // create an object from DB class
        // this will return all the data of the signed user
        $results = $userSelector->selectUser($email_signIn);
        $userSelector->checkSignIn($email_signIn  , $password_signIn);
    }
?>

<div class="container">
    <h1 class="text-center">Sign In</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>