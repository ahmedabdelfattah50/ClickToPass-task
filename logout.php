<?php 
    // this is page is used to end the session of the user in the website
    session_start();
    session_unset(); 
    session_destroy();
    header("location:index.php");
    exit(); 
