<!DOCTYPE html>

<?php

	session_start();
	if($_SESSION){
		header("Location: clients.php");
	}else{
	
	
	include('includes/functions.php');
	
	$email_error="";
	$pass_error="";
	
	if(isset($_POST['form-login'])){
		
		$email=validate_data($_POST['form-email']);
		$pass=validate_data($_POST['form-pass']);
		
		if($email!== $_POST['form-email'] || $email===""){
			$email_error="Enter a proper email!";
			
		}
		else if($pass!== $_POST['form-pass'] || $pass===""){
			$pass_error="Enter a proper password!";
		}
		else{
			
			include("includes/connect.php");
			
			$query="SELECT * FROM users WHERE email = '$email';";
			$result = mysqli_query($connection,$query);
			
			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_array($result);
				$email = $row['email'];
				$hash_pass = $row['password'];
				$name = $row['name'];
				$id = $row['id'];
				
				if(password_verify($pass, $hash_pass) ){
					$_SESSION['logged_in_email'] = $email;
					$_SESSION['logged_in_name'] = $name;
					$_SESSION['logged_in_id'] = $id;
					$_SESSION['client_add']="";
					$_SESSION['client_edit']="";
					$_SESSION['client_id']="";
					
					header("Location: clients.php");
				}
				else{
					$pass_error="Wrong Password!";
				}
				
			}
			else{
				$email_error="No such user exist!<a class='close' data-dismiss='alert'>&times;</a>";
			}
			
			mysqli_close($connection);
						
		}
		
	}
	include('includes/header.php');
	}

?>
	
	<h1>Client Address Book</h1>
	<p class="lead">Login to your Account.</p>
	
	<?php
		if($email_error || $pass_error)
		{
			echo("<div class='alert alert-danger'> $email_error $pass_error </div>");
		}
	?>
	
	<form class="row" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		
		<div class="col-md-4 col-sm-5 col-xs-9">
			<input class="form-control" type="text" placeholder="Email" name="form-email">
		</div>
		
		<div class="col-md-4 col-sm-5 col-xs-9">
			<input class="form-control" type="password" placeholder="Password" name="form-pass">
		</div>
		
		<div class="col-md-4 col-sm-2 col-xs-6">
			<button class="btn btn-info" name="form-login">Log In!</button>
		</div>
		
	</form>
		
	<?php include('includes/footer.php'); ?>