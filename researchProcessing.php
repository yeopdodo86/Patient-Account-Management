<?php
include "support.php";
include "login.php";
include_once('support2.php');
session_start();

$title = "Patient Registration Confirmation";
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
        

    <h1>$title</h1>
    <h3>Patient Information Provided:</h3>
            <fieldset class="box">
        <legend>
            <em>Patient Data</em>
        </legend>   
        <fieldset class="box">
        <legend>
            <em>Patient Information</em>
        </legend>

        <em>Name:</em> {$_SESSION['name']}<br />
 <em>Phone Number:</em> {$_SESSION['gpa']}<br />
            <em>Email:</em> {$_SESSION['email']}<br />
            
                <em>Emergency Contact Phone Number:</em> {$_SESSION['year']}<br />
                <em>Comments:</em> {$_SESSION['gender']}<br />

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


# Generating final page
echo generatePage($body, $title);   
?>
