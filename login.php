<?php
	/* Update based on your database and account info */
	$host = "localhost";
	$user = "dbuser";
	$password = "goodbyeWorld";
	$database = "applicationdb";


	$code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789./';

	$salt = "";

	for($i = 0; $i <= 62; $i ++) {
    	
    	$random = rand(0,62);
    	$code = str_shuffle ( $code );
    	$salt .= $code [$random];
	}
	
	$codedPassword = crypt($password, $salt);
	$adminID = "id";
	$adminPassword = "1234";
	
	$encryptedID = crypt($adminID,$salt);
	$encryptedPassword = crypt($adminPassword, $salt);

	$_SESSION['user'] ="dbuser";
	


?>