<?php 
    require_once "init.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // echo "the old password" . $_POST['password'] . "<br>";
        $user_db = new DB;
        $user_session = new Session;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        if($passwordConfirm === $password){
            // call the function insertUser to insert the new user in the database
            $user_db->insertUser($name , $email , $password);   
            echo "  <div class='container'>
                        <h2 class='alert alert-success'>Success of Insertion the new user you will return to main page in 1s</h2>
                    </div>";
            header("Refresh:1; url=index.php");
            
            $values = $user_db->selectUser($email);
            $userID = $values['id'];
            $user_session::setSessionItem('name', $name);
            $user_session::setSessionItem('id', $userID);
        } else {
            echo "  <div class='container'>
                        <h2 class='alert alert-danger'>Sorry The passwords are not match</h2>
                    </div>";
        }        
    }
?>

<div class="container">
    <h1 class="text-center">Sign Up</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="UserName">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input name="passwordConfirm" type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
