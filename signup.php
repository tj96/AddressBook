<?php

	session_start();
	
	$name_error_class="";
	$email_error_class="";
	$pass_error_class="";
	$repass_error_class="";
	
	$name_error="";
	$email_error="";
	$pass_error="";
	$mysqli_error="";
	
	$name = "";
	$email = "";
	$pass = "";
	$repass = "";
	
	$error=0;
	
	$display_form = "display: block;";
	$display_alert= "display: none;";
	
	if(isset($_POST['signup_submit']) ){
		
		include("includes/connect.php");
		include("includes/functions.php");
	
		$name = validate_data($_POST['signup_name']);
		$email = validate_data($_POST['signup_email']);
		$pass = validate_data($_POST['signup_pass']);
		$repass = validate_data($_POST['signup_repass']);
		
		if($pass!== $_POST['signup_pass'] || $pass==='' ){
			$pass_error="<p style='color: red; font-weight: bold;'>Enter a proper Password. A proper password CANNOT have Spaces, (, ) and \</p>";
			$error=1;
		}
		else if($pass!==$repass){
			$pass_error="<p style='color: red; font-weight: bold;'>Passwords&nbsp;didn't&nbsp;match&nbsp;!</p>";
			$error=1;
		}
		
		if($name!== $_POST['signup_name'] || $name===""){
			$name_error="<p style='color: red; font-weight: bold;'>Enter a proper Name&nbsp;!</p>";
			$name='';
			$error=1;
		}
		
		if($email!== $_POST['signup_email'] || $email===""){
			$email_error="<p style='color: red; font-weight: bold;'>Enter a proper Email&nbsp;!</p>";
			$email="";
			$error=1;
		}
		
		if($error === 0){
			
			$pass = password_hash($pass,PASSWORD_DEFAULT);
			
			$query="INSERT INTO `users` (`id`, `email`, `name`, `password`, `signup_date`) VALUES (NULL, '$email', '$name', '$pass', CURRENT_TIMESTAMP);";
			$result = mysqli_query($connection, $query);
			if($result){
				$display_form = "display: none;";
				$display_alert= "display: block;";
				
				$query="SELECT id FROM users WHERE email='$email';";
				$result = mysqli_query($connection, $query);
				if($result){
					$row=mysqli_fetch_array($result);
					$table_id=$row['id'];
					
					$query="CREATE TABLE `clients_$table_id` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,  `name` VARCHAR(100) NOT NULL ,  `email` VARCHAR(100) NOT NULL ,  `address` TEXT NULL ,  `phone` VARCHAR(30) NULL ,  `company` VARCHAR(100) NULL ,  `notes` TEXT NULL ,  `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`id`) , UNIQUE KEY  (`email`));";
					$result = mysqli_query($connection, $query);
					
				}
				
			}
			else {
				$mysqli_error = "<div style='font-size: 1.5em; margin-top: 50px' class='alert alert-danger'><span class='glyphicon glyphicon-remove-sign'></span> User&nbsp;already&nbsp;exist&nbsp;!<a class='close' data-dismiss='alert'>&times;</a></div>";
				$name="";
				$email="";
			}
		}
		
	}

?>

<?php include("includes/header.php"); ?>
	<div style="<?php echo $display_form; ?>">
		
		<?php echo $mysqli_error; ?>
		<h1>Sign&nbsp;Up</h1>
		<p class="lead">Fill up the form given below.</p>
		
		<div class="row">
		<form class="col-md-5 col-sm-7 col-xs-10" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			
			<?php echo $name_error; ?>
			<div class="form-group<?php echo $name_error_class ?>">
				<label for="name">Full Name <span style="color: red;"> <strong>*</strong> </span></label>
				<input type='text' name='signup_name' id="name" class="form-control input-lg" value="<?php echo $name; ?>">
			</div><br>
			
			<?php echo $email_error; ?>
			<div class="form-group<?php echo $email_error_class ?>">
				<label for="email">Email <span style="color: red;"> <strong>*</strong> </span></label>
				<input type='text' name='signup_email' id="email" class="form-control input-lg" value="<?php echo $email; ?>">
			</div><br>
			
			<?php echo $pass_error; ?>
			<div class="form-group<?php echo $pass_error_class ?>">
				<label for="pass">Password <span style="color: red;"> <strong>*</strong> </span></label>
				<input type='password' name='signup_pass' id="pass" class="form-control input-lg">
			</div><br>
			
			<div class="form-group<?php echo $repass_error_class ?>">
				<label for="repass">Re-type&nbsp;Password <span style="color: red;"> <strong>*</strong> </span></label>
				<input type='password' name='signup_repass' id="repass" class="form-control input-lg">
				<p id="pass_stat"></p>
			</div><br>
			
			<div class="form-group">
				<button style="padding: 10px 30px;" name='signup_submit' id="repass" class="btn btn-success btn-lg">Create</button>
			</div>
		
		</form>
		</div>
	</div>
	
	<div style="<?php echo $display_alert; ?>">
		
		<div style='font-size: 1.5em; margin-top: 50px' class='alert alert-success'>
			<span class='glyphicon glyphicon-ok-sign'></span> Congratulations! Your Account has been successfully created.
		</div>
		<a href="index.php" class='btn btn-primary btn-lg'>Log&nbsp;In</a>
		
	</div>

<?php 
	$script='<script>
		$(function(){
			
			$("#pass_stat").css({"color":"#00c905", "margin-top": "5px"});
			$("#repass").keyup(function(){
				$js_pass = $("#pass").val();
				$js_repass = $("#repass").val();
				
				if($js_pass==$js_repass ){
					$("#pass_stat").html("<b>Password&nbsp;matched&nbsp;!</b>");
				}
				else{
					$("#pass_stat").html("");
				}
			});
			
		});
	</script>';
	include("includes/footer.php");
?>