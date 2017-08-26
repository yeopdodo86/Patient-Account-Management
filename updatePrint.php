

<?php 
include "support.php";
include "login.php";

session_start();

	
	printReport("updated",$_SESSION['name'],$_SESSION['email'],$_SESSION['gpa'],
		$_SESSION['year'], $_SESSION['gender']);

 ?>
				