<?php 

class DB {
    private $host = "localhost",
            $db   = "clicktopass",
            $user = "root",
            $pass = "";

    public static $con;

    // the construct of DB class used to connect automatically with the database
    public function __construct(){
        try {
            self::$con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db , $this->user , $this->pass);
        } catch(PDOException $e){
            die($e->getMessage());
        }        
    }

    // this function is used to insert user in the database
    public function insertUser($name , $email , $password) {
        $password_hased = password_hash($password , PASSWORD_DEFAULT);
        $stmt = self::$con->prepare("INSERT INTO users(name,email,hased_password) VALUES(:name,:email,:hased_password)");
        $stmt->execute(array(
            ":name" => $name,
            ":email" => $email,
            ":hased_password" => $password_hased
        ));
    }

    // this function is used to select user from the database
    public function selectUser($item){
        $stmt = self::$con->prepare("SELECT * FROM users WHERE (id = :item_id || email = :item_id)");
        $stmt->execute(array(
            ":item_id" => $item
        ));
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    // this function is used to select all users from the database
    public function selectAllUsersIds(){
        $stmt = self::$con->prepare("SELECT id,name,email FROM users");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // this function is used to check user from the database to sign in the website
    public function checkSignIn($email , $pass){
        $user_select = $this->selectUser($email);
        $hased_password = $user_select['hased_password'];

        /* * this function >>> password_verify($pass , $hased_password) will return boolean value
           * if the return (value = true or 1) that is mean that the passwords are matches
           * if the return (value = false or 0) that is mean that the passwords are not matches */
        $check_password = password_verify($pass , $hased_password); 

        if($user_select && $check_password){
            $session = new Session;         // create object from Session Class
            $session->setSessionItem('name',$user_select['name']);
            $session->setSessionItem('id', $user_select['id']);
            header("location:index.php");
        } else {
            echo "  <div class='container'>
                        <p class='alert alert-danger'>Sorry the user email or password is wrong</p>
                    </div>";
        }
    }

    // this function is used to create the post in the database
    public function createPost($header , $body , $user_id) {
        $stmt = self::$con->prepare("INSERT INTO posts(header,body,user_id) VALUES(:header,:body,:user_id)");
        $stmt->execute(array(
            ":header" => $header,
            ":body" => $body,
            ":user_id" => $user_id
        ));
    }

    // this function is used to get posts from the database
    public function getPost(){
        $stmt = self::$con->prepare("SELECT * FROM posts");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // this function is used to select posts from the database by user id
    public function selectPost($userId){
        $stmt = self::$con->prepare("SELECT * FROM posts WHERE user_id = :userId");
        $stmt->execute(array(
            ":userId" => $userId
        ));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // this function used to delete a selected post
    public function deletePost($postId){
        $stmt = self::$con->prepare("DELETE FROM posts WHERE id = :delId");
        $stmt->bindParam(":delId" , $postId);
        $stmt->execute();
    }
}