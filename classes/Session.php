<?php

class Session {
   
    public function session_start(){
        // the start of the session for users of the website
        session_start();
        echo "Yes";
    }

    // this is function is used to set the value of any any of session when after session is started in the website
    public function setSessionItem($item , $value){
        $_SESSION[$item] = $value;
    }

    // this is function is used to set the value of any any of session when after session is started in the website
    public function getSessionItem($item){
        return $_SESSION[$item];
    }
}