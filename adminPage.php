
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


if(isset($_POST['display'])){


	$fields= "";
$i=0;
	if(isset($_POST['fields'][0]) && isset($_POST['fields'][1]) && isset($_POST['fields'][2]) &&
		 isset($_POST['fields'][3]) && isset($_POST['fields'][4])){
		$fields = "* ";
	}else{
	
		while(isset($_POST['fields'][$i])){
if($i>0){			
if($_POST['fields'][$i] === 'phone'){
$fields .= ", "."gpa"." ";
}else if($_POST['fields'][$i] === 'emergency'){
$fields .= ", "."year"." ";
}else if($_POST['fields'][$i] === 'comment'){
$fields .= ", "."gender"." ";
}else{
				$fields .= ", ".$_POST['fields'][$i]." ";
			
		}
	}else{
		if($_POST['fields'][$i] === 'phone'){
$fields .= "gpa"." ";
}else if($_POST['fields'][$i] === 'emergency'){
$fields .= "year"." ";
}else if($_POST['fields'][$i] === 'comment'){
$fields .= "gender"." ";
}else{
				$fields .= $_POST['fields'][$i]." ";
			
		}
	}

			$i=$i+1;
		}
		}
	

	$_SESSION['loadMessageNew'] = $fields;

	// $sort = trim($_POST['sort']);
	$sort = "";

	if($_POST['sort'] === "phone"){
				$sort .= "gpa";

	}else if($_POST['sort'] === "emergency"){
$sort .= "year";
	}else if($_POST['sort'] === "comment"){
$sort .= "gender";
	}else{
		$sort .= $_POST['sort'];
	}

	$condition ="";
if($_POST['filter'] !== ""){

		$condition .= "where"." ".$_POST['filter'];
	}



	$query = "select ". $fields ."from applicants"." ".$condition." "."order by ".$sort." ";
		$_SESSION['loadMessage'] = trim($query);


		header("Location: adminPrint.php");
	}else if(isset($_POST['return'])){

		header("Location: index.php");
	}

	$body = "";
	$body .=  "<h1> Patient Database </h1> ";
	$body .= "<form action="."adminPage.php"." method="."post".">";
	$body .= "<p><h2>Select Fields to Display (Multiple Selection Supported)</h2> ";
	$body .= "<select name="."fields[]"." multiple size="."5"." >";
	$body .= "<option name="."selName".">name</option>";
	$body .= "<option name="."selEmail"." selected>email</option>";
	$body .= "<option name="."selGpa"." >phone</option>";
	$body .= "<option name="."selYear"." >emergency</option>";
	$body .= "<option name="."selGender"." >comment</option>";
	$body .= " </select><br> </p>";
	$body .= "<h2>Select Field to Sort Patients</h2> "; 
	$body .= "<select name="."sort"." >";
	$body .= "<option name="."selName".">name</option>";
	$body .= "<option name="."selEmail"." selected>email</option>";
	$body .= "<option name="."selGpa"." >phone</option>";
	$body .= "<option name="."selYear"." >emergency</option>";
	$body .= "<option name="."selGender"." >comment</option>";
	$body .= " </select><br> </p>";
	$body .= " </select>";
	$body .= "<h2>Filter Condition</h2> <input type="."text"." name="."filter"." /></br>";
	$body .= "<p><input type="."submit"." name="."display"." value="."DisplayApplications"." /><br></br>";
	$body .= "<input type="."submit"." name="."return"." value="."ReturnToMainMenu"." /></p> <br> 
			</form>";


	echo displayPage($body);


	
	

	$db_connection->close();

 ?>
				