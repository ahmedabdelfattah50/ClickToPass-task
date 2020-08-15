<?php
session_start();

spl_autoload_register(function($class){
  require_once "classes/" . $class . ".php";
});

include_once "includes/header.php";
include_once "includes/footer.php";

