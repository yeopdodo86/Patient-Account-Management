<?php

include "login.php";

function displayPage($body, $title="Example") {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link type="text/css" rel="stylesheet" href="application.css"   media="screen" />
        <title>$title</title>	
    </head>
            
    <body>
            $body
    </body>
</html>
EOPAGE;

    return $page;
}

function emailSearch($location){
	if(isset($_POST['return'])){
		header("Location: index.php");
	}else if(isset($_POST['submit'])&& isset($_POST['revEmail'])&& isset($_POST['revPassword'])){
		$userEmail = $_POST['revEmail'];
		if($_POST['revPassword'] != null &&  $_SESSION['password'] != null){
		if($_POST['revPassword'] === $_SESSION['password']){
			$_SESSION['loadEmail'] = $_POST['revEmail'] ;
			header("Location: $location" );	
		}else{
						echo  "<h2>No entry exists in the database for the specified email and Social Security Number</h2>";
						echo  "<h2>Please log in again</h2>";

		}
		}else{
			echo  "<h1>No entry exists in the database for the specified email and Social Security Number</h1>";
		}
	}

	$scriptName = $_SERVER["PHP_SELF"];
	if(isset($_SESSION['email'])){
	$body = <<<EOBODY
<!doctype html>
<html>
    <head>
    <meta charset="utf-8"> 
     <link type="text/css" rel="stylesheet" href="research.css"   media="screen" />
    <title>Patient Form</title>
    <script src="research.js"></script>
</head>
            
    <body>
        
		<h1>Log in</h1>

            <fieldset class="box">
        <legend>
            <em>Log in</em>
        </legend>   
		<form action="$scriptName" method="post">
		</br>
			<strong>Email associated with patient information:</strong>
			<input  type="text" name="revEmail" value="$_SESSION[email]" /><br>
			
			<strong>Social Security Number asociated with patient information:</strong>
			<input  type="password" name="revPassword" value = "$_SESSION[password]" /><br>
			</br>
			<input  type="submit" name="submit" value="Submit" /><br>
			<input  type="submit" name="return" value="Return to main menu" /><br>
		
		</form>
		
		</body>
		</br>
		</fieldset>
		</br>
		</br>

		    <footer>    
            Not Real Hospital
    </footer>
    </body>
</html>
EOBODY;
}else{
		$body = <<<EOBODY
		<form action="$scriptName" method="post">
			<strong>Email associated with application:</strong>
			<input  type="text" name="revEmail" value="" /><br>
			<strong>Password asociated with application:</strong>
			<input  type="password" name="revPassword" value = "goodbyeWorld" /><br>

			<input  type="submit" name="submit" value="Submit" /><br>
			<input  type="submit" name="return" value="Return to main menu" /><br>
		</form>
		
EOBODY;
}
echo displayPage($body);
}

function loadEmail(){

	if(isset($_POST['submit'])&&isset($_SESSION['loadEmail'])){
	$db_connection = new mysqli("localhost", "dbuser", "goodbyeWorld", "applicationdb");
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
		// echo "Connection to database established<br><br>";
	}

	$query = "select * from applicants";
			
$data="";

	$result = $db_connection->query($query);
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		
		$num_rows = $result->num_rows;
		if ($num_rows === 0) {
			echo "Empty Table<br>";
		} else {
			$found = 0;
			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if($row['email'] === $_SESSION['loadEmail']){
					 
					 $found += 1;
					 $_SESSION['updateName'] = $row['name'] ;
					 $_SESSION['updateEmail'] = $row['email'] ;
					 $_SESSION['updateGpa'] = $row['gpa'] ;
					 $_SESSION['updateYear'] = $row['year'] ;
					 $_SESSION['updateGender'] = $row['gender'];
					 $_SESSION['updatePassword'] = "goodbyeWorld";
				}
			}
			if($found===0){
				echo  "No entry exists in the database for the specified email and password";
			}
		}
	}
}
}

function printReport($method,$name,$email,$gpa
	,$year,$gender){



	if(isset($_POST['return'])){

		header("Location: index.php");
	}

	$body = "";
	$body .=  "<h1> The following entry has been $method to the database</h1> <br>";
	$body .= "<p>Name: ".$name."<br>";
	$body .= "Email:".$email."<br>";
	$body .= "Gpa:".$gpa." <br>";
	$body .= " Year:".$year." <br>";
	$body .= "Gender:".$gender." <br></p>";
	$body .= "<form action="."submitPrint.php"." method="."post".">";
	$body .= "<input type="."submit"." name="."return"." value="."Return to main menu"." /><br> 
			</form>";

	echo displayPage($body);

}

?>