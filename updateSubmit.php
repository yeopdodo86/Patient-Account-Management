<?php 
include "support.php";
include "login.php";


echo loadEmail();
	session_start();
$db = new mysqli($host, $user, $password, $database);
	if ($db->connect_error) {
		die($db_connection->connect_error);
	} else {
		//echo "Connection to database established<br><br>";
	}

	$body="";
	if(isset($_POST['submit'])){

		$passwordValue = trim($_POST["password"]);
		$passwordValue2 = trim($_POST["password2"]);
		if ($passwordValue === $_SESSION['password'] && $passwordValue2 === $_SESSION['password'] && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gpa'])
		  	 && isset($_POST['gender'])){

			$appName = trim($_POST['name']);
			$appEmail = trim($_POST['email']);
			$appGPA	= trim($_POST['gpa']);
			$appYear =trim($_POST['year']);
			$appGender =trim($_POST['gender']);
			$appPassword =trim($_POST['password']);

			$_SESSION['name'] = $appName;
			$_SESSION['email'] = $appEmail;
			$_SESSION['gpa']	= $appGPA;
			$_SESSION['year']	=$appYear;
			$_SESSION['gender'] =$appGender;
			$_SESSION['password'] =$appPassword;
			$encodedPassword = crypt($appPassword, $salt);
			
		
			$sqlQuery = sprintf("update applicants set name='%s',  gpa='%s', year='%s', gender='%s', password='%s' where email='%s'", $appName,$appGPA,$appYear,$appGender,$encodedPassword,$_SESSION['loadEmail']);
			
			$result = mysqli_query($db, $sqlQuery);
			header("Location: researchProcessing.php");

		}else{
			echo "<strong>Invalid login information Provided</strong><br />";
		}
	}else if (isset($_POST['return'])){
		header("Location: index.php");
	}

		$sid = session_id();
		$scriptName = $_SERVER["PHP_SELF"];
	// 	$body ="";
	// 	$body .= "<form action="."updateSubmit.php". "method="."post".">";
	// 	$body .= "<strong>Name: </strong><input type="."text"." name="."name"." value = '$_SESSION[updateName]'/><br><br>";
	// 	$body .= "<strong>Email: </strong><input type="."text"." name="."email"." value = "."$_SESSION[updateEmail]"." /><br><br>";
	// 	$body .= "<strong>Phone: </strong><input type="."text"." name="."gpa"." value = ". "$_SESSION[updateGpa]"." /><br><br>";
	// $body .= "<strong>Emergency Contact Phone: </strong><input type="."text"." name="."gpa"." value = ". "$_SESSION[updateGpa]"." /><br><br>";
	// $body .= "<strong>Comment </strong><input type="."text"." name="."gender"." value = ". "$_SESSION[updateGender]"." /><br><br>";

	
	
	// 	$body .= "<strong>Password: </strong><input type="."password"." name="."password"." value = "."$_SESSION[password]"." /><br>";
	// 	$body .= "<strong>Verify Password: </strong><input type="."password"." name="."password2"."  value = "."$_SESSION[password]"." /><br><br>";
	// 	$body .= "<input type="."submit"." name="."submit"." value="."Submit Data"." /><br><br>";
	// 	$body .= "<input type="."submit"." name="."return"." value = "."Return to main menu"."/><br><br>";
	// 	$body .= "</form>";

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
        

   
    <h3>Patient Information Provided:</h3>
            <fieldset class="box">
        <legend>
            <em>Patient Data</em>
        </legend>   
        <fieldset class="box">
        <legend>
            <em>Patient Information</em>
        </legend>

<form action="updateSubmit.php" method="post">
	<strong>Name: </strong><input type="text" name="name" value = '$_SESSION[updateName]'/><br><br>
	<strong>Email: </strong><input type="text" name="email" value = "$_SESSION[updateEmail]" /><br><br>
	<strong>Phone: </strong><input type="text" name="gpa" value = "$_SESSION[updateGpa]"." /><br><br>
	<strong>Emergency Contact Phone: </strong><input type="text" name="year" value = "$_SESSION[updateYear]" /><br><br>
	<strong>Comment </strong><input type="text" name="gender" value = "$_SESSION[updateGender]" /><br><br>

	
	
	<strong>Password: </strong><input type="password" name="password" value = "$_SESSION[password]" /><br>
	<strong>Verify Password: </strong><input type="password" name="password2"  value = "$_SESSION[password]" /><br><br>
	<input type="submit" name="submit" value="Submit Data" /><br><br>
	<input type="submit" name="return" value = "Return to main menu"/><br><br>
	</form>

       

    </fieldset><br> 
        </fieldset><br><br>

        Data has been entered in the database. <br><br>
    <footer>    
            Not Real Hospital
    </footer>
    </body>
</html>


EOBODY;
	
	$page = displayPage($body);
	echo $page;

	
?>



















