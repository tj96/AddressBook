<?php

	session_start();
	if( ! $_SESSION){
		header("Location: index.php");
	}else{
		
		include("includes/functions.php");
		
		$name 		= "";
		$email 		= "";
		$company 	= "";
		$phone 		= "";
		$address 	= "";
		$notes 		= "";
		
		$email_error_class = "";
		$name_error_class = "";
		
		$email_error = "";
		$name_error = "";
		$mysqli_error="";
		
		if( isset($_POST['save-btn']) ){
			
			$name = validate_data($_POST['client_name']);
			$email = validate_data($_POST['client_email']);
			$company = validate_data($_POST['client_company']);
			$phone = validate_data($_POST['client_phone']);
			$address = validate_data($_POST['client_address']);
			$notes = validate_data($_POST['client_notes']);
			
			if($name===""){
				$name_error_class = " has-error";
				$name_error = "<div class='col-md-10 col-sm-7 col-xs-9 alert alert-danger'>Enter proper values in the Name field.<a class='close' data-dismiss='alert'>&times;</a></div>";
			}
			if($email===""){
				$email_error_class = " has-error";
				$email_error = "<div class='col-md-10 col-sm-7 col-xs-9 alert alert-danger'>Enter proper values in the Email field.<a class='close' data-dismiss='alert'>&times;</a></div>";
			}
			if($email && $name){
				
				include("includes/connect.php");
				
				$table_id = $_SESSION['logged_in_id'];
				$query = "INSERT INTO `clients_$table_id` (`id`, `name`, `email`, `address`, `phone`, `company`, `notes`, `date_added`) VALUES (NULL, '$name', '$email', '$address', '$phone', '$company', '$notes', CURRENT_TIMESTAMP)";
				$result = mysqli_query($connection,$query);
				
				if($result){
					$_SESSION['client_add']="success";
					header("Location: clients.php");
				}else{
					$mysqli_error = "<div style='font-size: 1.5em; margin-top: 50px' class='alert alert-danger'><span class='glyphicon glyphicon-remove-sign'></span> Client&nbsp;already&nbsp;exist&nbsp;!<a class='close' data-dismiss='alert'>&times;</a></div>";
					$name 		= "";
					$email 		= "";
					$company 	= "";
					$phone 		= "";
					$address 	= "";
					$notes 		= "";
				}
				
				mysqli_close($connection);
				
				//
				
			}
			
		}
		
		include("includes/header.php");
	}
?>
	
	<style>
		.form-group{
			
			box-sizing: border-box;
		}
		.btn-lg{
			padding: 10px 30px;
		}
		
	</style>
	
	<h1>Add Client</h1>
	
	<?php echo $mysqli_error; ?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		
		<div class="row">
		
		<?php echo $name_error; echo $email_error; ?><br>
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group<?php echo $name_error_class ?>">
					<label for="name">Name <span style="color: red;"> <strong>*</strong> </span></label>
					<input type='text' name='client_name' id="name" class="form-control input-lg"value="<?php echo $name; ?>">
				</div>
			</div>
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group<?php echo $email_error_class ?>">
					<label for="email">Email <span style="color: red;"> <strong>*</strong> </span></label>
					<input type='text' name='client_email' id="email" class="form-control input-lg" value="<?php echo $email; ?>">
				</div>
			</div>
			
		</div>
		
		<div class="row">
		
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group">
					<label for="phone">Phone No.</label>
					<input type='text' name='client_phone' id="phone" class="form-control input-lg" value="<?php echo $phone; ?>">
				</div>
			</div>
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group">
					<label for="company">Company Name</label>
					<input type='text' name='client_company' id="company" class="form-control input-lg"value="<?php echo $company; ?>">
				</div>
			</div>
			
		</div>
		
		<div class="row">
		
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group">
					<label for="address">Address</label>
					<textarea rows="5" name='client_address' id="address" class="form-control input-lg" value="<?php echo $address; ?>"></textarea>
				</div>
			</div>
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group">
					<label for="notes">Notes</label>
					<textarea rows="5" name='client_notes' id="notes" class="form-control input-lg" value="<?php echo $notes; ?>"></textarea>
				</div>
			</div>
			
		</div>
		
		<br><br>
		<div class="row">
		
			<div class="col-md-10 col-sm-7 col-xs-9">
			<center>
				<div class="form-group">
					<a type='button' href="clients.php" class="btn btn-default btn-lg">Cancel</a>
				
					<button class="btn btn-success btn-lg" name="save-btn">Save</button>
				</div>
				</center>
			</div>
						
		</div>
		
	</form>
	
<?php include('includes/footer.php'); ?>