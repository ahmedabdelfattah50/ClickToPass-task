<?php

require_once "init.php";
require_once "vendor/autoload.php";
$db = new DB;
$session = new Session;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 

// this function is used to get all data of users from database
$totalUsers = $db->selectAllUsersIds();

for($i = 0 ; $i < count($totalUsers) ; $i++) {
   $userId = $totalUsers[$i]['id'];

   $total_posts = $db->selectPost($userId);
   
   if(count($total_posts) > 0){
      $number_posts = count($total_posts);
      $last_post = $total_posts[$number_posts-1];
      
      // the created date of the last post in the database
      $dateFromDatabase = $last_post['created_date'];
      
      // the user name & email from users table
      $userName = $totalUsers[$i]['name'];
      $userEmail = $totalUsers[$i]['email'];
            
      // convert the srting date from database to a date form  
      $userDate  = strtotime($dateFromDatabase);            
      $curDate = strtotime(date('Y-m-d'));      // the today current date
      
      $differDate = $curDate -  $userDate;     // the differnce from the two dates
      
      // the differnce from the two dates in (days)
      $differInDays = floor($differDate / (60 * 60 *24));
      echo $differInDays . "<br>";
      
      if($differInDays >= 7){         
         $SenderName    = "Ahmed Abdel-Fattah";   // my name who which the user show it in the mail
         $SenderEmail   = "ahmedabdelfatah661540@gmail.com";   // my email
         $myPasswordEmail ="XXXXXXXXXXXXXXXX";      // my password of my email I put it as (X) value because it is my private password
         
         // the subject of the message
         $subject = "Click To Pass Don't post";       
         
         // the body of the message to the user
         $message = "Hello " . $userName . " , Long Time u didn't post at our App";
         
         // the user email
         $userEmail = $userEmail;
         
         // create object from PHPMailer
         $mail = new PHPMailer();
         
         // enable a SMTP
         $mail->isSMTP();
         
         // set authentication to true
         $mail->SMTPAuth = true;
         
         // set authentication to true
         $mail->SMTPDepug = 2;
         
         // set a host
         $mail->Host = "smtp.gmail.com";
         
         // set login details for Gamil account
         $mail->Username = $SenderEmail;
         $mail->Password = $myPasswordEmail;
         
         // set a port 
         $mail->Port = 587;      // or 465 if ssl
         
         // set type of protection 
         $mail->SMTPSecure = 'tls';
         
         // the data of my email and my name
         $mail->From = $SenderEmail;
         $mail->FromName = $SenderName;
         
         // the address mail of the user
         $mail->addAddress($userEmail , "Dear");
         
         $mail->Subject = $subject;    // set Subject
         $mail->Body = $message;       // set body
         
         $mail->send();  // sending the email
      }
   }        
}
