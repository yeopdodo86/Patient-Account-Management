	
<?php 
include "support.php";
include "login.php";

session_start();

	if(isset($_POST['return'])){
	
		header("Location: index.php");
	}

	$data = "";
	$data .= "<table border ="."1"."> ";
	
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {

		die($db_connection->connect_error);
	} else {

		// echo "Connection to database established<br><br>";
	}

	$result = $db_connection->query($_SESSION['loadMessage']);

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
				$data .= "<tr>"	;
				if($row_index===0){
					$data .="<tr>";
				
					if(isset($row['name']))	{
						$data .="<th>Name</th>";
					}
					if(isset($row['email'])) {
						$data .="<th>Email</th>";
					}
					if(isset($row['gpa']))	{
						$data .="<th>Phone Number</th>";
					}
					if(isset($row['year']))	{
						$data .="<th>Emergency Contact Phone Number</th>";
					}
					if(isset($row['gender']))	{
						$data .="<th>Comment</th>";
					}
					$data .="</tr>";
				}

				if(isset($row['name']))	{
				
					$data .= " <td>{$row['name']} </td> ";
				}		
				if(isset($row['email'] )){
					
					$data .= "<td>{$row['email']} </td>";
				}
				if (isset($row['gpa'])){
				
					$data .= "<td>{$row['gpa']} </td>";
				}
				if (isset($row['year'])){
					
					$data .= "<td>{$row['year']} </td>";
				}
				if (isset($row['gender'])){
					
					$data .= "<td>{$row['gender']} </td>";
				}
				$data .= "</tr>"; 

			}
		}
	}

	$data .= "</table><br>";
	$data .=  "<form action="."adminPrint.php"." method="."post".">";
	$data .= "<input type="."submit"." name="."return"." value = "."Return to main menu"." /></form> <br><br>";
	echo displayPage($data);


 ?>
