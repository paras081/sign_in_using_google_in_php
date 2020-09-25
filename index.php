<?php

//Include Configuration File
include('config.php');
   $login_button = '';
// step-1:get code 
// step-2:create Client Request to access Google API
// step-3:Create Object of Google Service OAuth 2 class
// step-4:Get user profile data from google and store in session variable

 if(isset($_GET['code']))//API connection--> token generate-->true
 {
  //storing unique token
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

      if(!isset($token['error']))//return without error
      {
    //set the access token 
              $google_client->setAccessToken($token['access_token']);
              //storing access token in session variable
              $_SESSION['access_token']= $token['access_token'];
              //creating service auth 2 object of google
              $google_service = new Google_Service_Oauth2($google_client);

              //fetch data using get method and store inside data array.
              $data = $google_service->userinfo->get();

               if(!empty($data['given_name'])){
                  $_SESSION['user_first_name']=$data['given_name'];
               }
                if(!empty($data['family_name'])){
                $_SESSION['user_last_name']=$data['family_name'];
              }
              if(!empty($data['email'])){
                $_SESSION['user_email_address']=$data['email'];
              }
               if(!empty($data['gender'])){
                $_SESSION['user_gender']=$data['gender'];
              }
               if(!empty($data['picture'])){
                $_SESSION['user_image']=$data['picture'];
              }
      }
  }
  
  if(!isset($_SESSION['access_token']))//means login is remain and we have to show login button
  {
    $login_button= '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png"></img></a>';
  }
?>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Login using Google Account</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
   <body>
      <div class="container">
       <br />
        <h2 align="center">PHP Login using Google Account</h2>
       <br />
         <div class="panel panel-default">
           <?php
           if($login_button == '')
           {
            echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
            echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" width="100px" height="100px"/>';   
            
            echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
            echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
            echo '<h3><a href="logout.php">Logout</h3></div>';
           }
           else
           {
              echo '<div align="center">'.$login_button . '</div>';            
           }
           ?>
         </div>
      </div>
   </body>
</html>
