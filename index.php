<?php 
include "support.php";
include "login.php";

session_start();


	$body="";
	
	if(isset($_POST['submit'])){
		header("Location: submitApp.php");
		
	}else if(isset($_POST['review'])){
		header("Location: reviewApp.php");
	}else if(isset($_POST['update'])){
		header("Location: updateApp.php");
	}else if(isset($_POST['admin'])){
		if( ( isset($_SERVER['PHP_AUTH_USER'] ) ) && ( isset($_SERVER['PHP_AUTH_PW'] ) )
      	 	&& (crypt($_SERVER['PHP_AUTH_USER'],$salt)===$encryptedID) && (crypt($_SERVER['PHP_AUTH_PW'], $salt) ===$encryptedPassword)
			){
            
        	header("Location: adminPage.php");
    	}else{
       	 	header("WWW-Authenticate: " ."Basic realm=\"Secret Area\"");
       	 	header("HTTP/1.0 401 Unauthorized");
		}		
		
	}


	$sid = session_id();
	$scriptName = $_SERVER["PHP_SELF"];

 ?>


 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

     <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>

    <title>Software Developer Intern Portfolio</title>

</head>

<body>
  <div class= "main" style = "opacity:0;">
 <nav class="navbar navbar-default navbar-custom navbar-fixed-top" style ="padding:20px;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>

                <a class="navbar-brand" href="index.html"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
           <li>


                        <a href="" >Home</a>
                    </li>
                    <li>
                        <a href="">Services</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>
              
       
    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

   


    <header class="intro-header" style="background-image: url('medical-563427_1920.jpg')">
        <div class="container">
        	 
        	            <div class="row">

        	<div class = "col">
        		 
<h2 style = "color:black";>Welcome to Not Real Hospital</h2></br>

        	


        	<div class = "col">

<!-- <div class="panel panel-default" style = "width:600px; height:250px; ">
 -->    <div class="panel-body">
    	
                    <h2 style="color:green; padding-bottom : 40px;">Patient Management System</h2>

        <form action="<?php print $scriptName?>" method="post">

				<ul class= "submitIndex" style="color:black; padding-bottom : 7px;"><input   class = "form-control" type="submit" id="ex1" name="submit" value="Register" /></ul>
				<ul class= "submitIndex" style="color:black; padding-bottom : 7px"><input  class = "form-control " type="submit" name="review" value="Checking Patient's Account" /></ul>
 				<ul class= "submitIndex" style="color:black; padding-bottom : 7px "><input  class = "form-control" type="submit" name="update" value="Updating Patient's Account" /></ul>
 				<ul class= "submitIndex" style="color:black; padding-bottom : 7px "><input  class = "form-control" type="submit" name="admin" value="Administrators Only ( Log in ID = id , Log in Password = 1234 )" /></ul>
				
 			</form>
 			  </div>
 			    </div>
        	
       </div>
</div>
</div>


</header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
<!--                     <a href="post.html">
 -->                        <h2 class="post-title">
About Our Service                        </h2>
<div>
    &emsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer mollis urna sapien. Etiam leo ligula, tincidunt id nisl sed, feugiat varius risus. Mauris sit amet hendrerit nisl. Sed vulputate at risus id aliquam. Nullam vitae nibh est. Vestibulum justo ex, cursus et libero nec, lobortis convallis turpis. Suspendisse potenti. Vestibulum aliquet varius neque eget tincidunt. Nam ac tempor risus. Fusce convallis ac felis ut fermentum.


  


    </div>
                        <!-- <h3 class="post-subtitle">
                            Problems look mighty small from 150 miles up
                        </h3> -->
                    </a>
<!--                     <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on September 24, 2014</p>
 -->                </div>
                
            </div>
        </div>
    </div>

    <hr>


 
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                                       <p class="copyright text-muted">Copyright &copy; Not Real Hospital 2017</p>

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
 $('.main').animate({ opacity: 1 }, { duration: 3000 });
    </script>




</body>

</html>
