<?php

//execute this command in your project directory through command prompt.
//composer require google/apiclient:^2.0"

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('');
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('');
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('');
//Scopes for Google APIs, Basically which information you want of your user from google
$google_client->addScope('email');   //for email id data
$google_client->addScope('profile'); // for profile related data

//start session on web page
session_start();

?>
