<?php 
include "support.php";
include "login.php";
	session_start();



$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
		// echo "Connection to database established<br><br>";
	}
	

	$body="";

	if(isset($_POST['submit'])){

		// $passwordValue = trim($_POST["password"]);
		// $passwordValue2 = trim($_POST["password2"]);
		if (  isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gpa'])
		  	&& isset($_POST['year']) && isset($_POST['gender'])){

			$appName = trim($_POST['name']);
			$appEmail = trim($_POST['email']);
			$appGPA	= trim((string)$_POST['gpa']);
			$appYear =trim((string)$_POST['year']);
			$appGender =trim($_POST['gender']);
			$appPassword =trim($_POST['password']);

			$_SESSION['name'] = $appName;
			$_SESSION['email'] = $appEmail;
			$_SESSION['gpa']	= $appGPA;
			$_SESSION['year']	=$appYear;
			$_SESSION['gender'] =$appGender;
			$_SESSION['password'] =$appPassword;
			$encodedPassword = crypt($appPassword, $salt);

			$query = "insert into applicants values('$appName','$appEmail','$appGPA','$appYear','$appGender','$appPassword')";
			
			$result = $db_connection->query($query);
			if (!$result) {
				die("Insertion failed: " . $db_connection->error);
			} else {
				echo "Insertion completed.<br>";
			}

			header("Location: researchProcessing.php");

		}else{
			$body .= "<strong>Invalid login information Provided</strong><br />";
		}
	}else if (isset($_POST['return'])){
		header("Location: index.php");
	}

	$sid = session_id();
	$scriptName = $_SERVER["PHP_SELF"];
	$topPart = <<<EOBODY
	<head>
	<meta charset="utf-8"> 
	 <link type="text/css" rel="stylesheet" href="research.css"   media="screen" />
	<title>Patient Form</title>
	<script src="research.js"></script>
</head>
<body >
	<h1>Patient Information Form</h1>
		<form action="$scriptName" method="post">
		
		<fieldset class="box">
		<legend>
			<em>Patient Data</em>
		</legend>	
		<fieldset class="box">
		<legend>
			<em>Patient Information</em>
		</legend>
Name: 
		<input type="text" name="name" id= "name" required >
	Phone: <input class="phone" type="text" name="gpa" id="phone" required style="width:300px;" > </br>
		Email: <input type= "email" name="email" id="email"  required> <Br>
		Social Security Number: <input class="phone" type="text" name="password" id="password" required style="width:390px;" > </br>
	</fieldset><br>	


		



		<fieldset class="box">
		<legend>
			<em>Emergency Contact</em>
		</legend>
		
		
		Phone: <input class="phone" type="text" name="year" id="phone" required style="width:300px;" ></br> 
	</fieldset><br>



		<fieldset class="box">
			<legend>
				<em>Additional Information (Comments)</em>
			</legend>
			<textarea id="gender" name="gender" style = "width:950px; height : 100px;"></textarea>
		</fieldset><br>
	</fieldset><br>
	<fieldset class="box">
			<input type= "reset" name ="reset" value= "Clear Form" class="submit" > &nbsp;
			<input type = "submit" name ="submit" value = "Submit Information" id="submit" class="submit">
		</fieldset><br>
	<footer>Not Real Hospital</footer>
	</form>
</body>
</html>
EOBODY;
	$body = $topPart.$body;
	
	$page = displayPage($body);
	echo $page;

	$db_connection->close();
?>
