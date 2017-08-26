
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
			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				
				
				if(trim($row['email']) === trim($_SESSION['loadEmail'])){
			
					$data .= 

					"Name: {$row['name']} <br>
						 	Email: {$row['email']} <br>
						 	Phone: {$row['gpa']} <br>
						 	Emergency Contact Phone: {$row['year']} <br>
							 Comment: {$row['gender']} <br>";
				}
			}
		}
	}
	

	if(isset($_POST['return'])){

		header("Location: index.php");
	}

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
        

   
<h1> The Patient information found in the database : </h1> <br>
            <fieldset class="box">
        <legend>
            <em>Patient Data</em>
        </legend>   
        <fieldset class="box">
        <legend>
            <em>Patient Information</em>
        </legend>


EOBODY;

$body .= $data;

$body1 = <<<EOBODY




    </fieldset><br> 

    <form action=submitPrint.php method=post>
	 <input type=submit name=return value=Return to main menu /><br> 
			</form><br>
        </fieldset><br><br>

        Data has been entered in the database. <br><br>
    <footer>    
            Not Real Hospital
    </footer>
    </body>
</html>
EOBODY;

$body .= $body1;

	// $body = "";
	// $body .=  "<h1> The Patient information found in the database : </h1> <br>";
	// $body .= "<p>";
	// $body .= $data;
	// $body .= "</p>";
	// $body .= "<form action="."submitPrint.php"." method="."post".">";
	// $body .= "<input type="."submit"." name="."return"." value="."Return to main menu"." /><br> 
	// 		</form>";

	echo displayPage($body);


	$result->close();
	

	$db_connection->close();

 ?>
				