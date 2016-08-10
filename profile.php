<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
    <title>Profile Page</title>

    <!-- Bootstrap -->
    <link href="//localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
	
	<div class="container">
		
		<h1>Profile</h1>
		<p class="lead">You can see your profile here.</p>
		<?php
			
			if($_SESSION){
				echo "<div class='alert alert-success'>
			Hello".$_SESSION['logged_in_fname']."! You have been successfully logged in.
		</div>
		
		<table class='table table-bordered'>
			<tr>
				<th>Username</th>
				<td>".$_SESSION['logged_in_user']."</td>
			</tr>
			
			<tr>
				<th>Full Name</th>
				<td>".$_SESSION['logged_in_fname']." ".$_SESSION['logged_in_lname']."</td>
			</tr>
			
			<tr>
				<th>Email Address</th>
				<td>".$_SESSION['logged_in_email']."</td>
			</tr>
			
		</table>
		
		<a href='logout.php' class='btn btn-danger btn-sm'>Log Out!</a>" ;
			}
			
			else{
				echo "<p>Please Log In again!</p>
		<a href='login.php' class='btn btn-info btn-sm'>Log In!</a>";
			}
			
		?>
		
		
		
	</div>
	
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   

	<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
	
	<script>window.jQuery || document.write('<script src="//localhost/jquery/jquery-2.2.4.min.js"><\/script>');</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//localhost/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>