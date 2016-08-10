<?php

	session_start();
	if( ! $_SESSION ){
		header("Location: index.php");
	}
	else{
		
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
		$mysqli_error = "";
		
		$table_id = $_SESSION['logged_in_id'];
		
		include("includes/functions.php");
		include("includes/connect.php");	
		
		if( ! isset($_POST['update-btn']) && $_GET ){
			
			$_SESSION['client_id']=validate_data($_GET['id']);
			
			$query = "SELECT * FROM clients_$table_id WHERE id = ".$_SESSION['client_id'];
			$result = mysqli_query($connection,$query);
			
			if( mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				
				$name 		= $row['name'];
				$email 		= $row['email'];
				$company 	= $row['company'];
				$phone 		= $row['phone'];
				$address 	= $row['address'];
				$notes 		= $row['notes'];
				
			}else{
				echo "<div class='alert alert-danger ' style='font-size: 1.5em;'><span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp; <b>ERROR:</b> You have no such Client!</div>";
				$_SESSION['client_id']= -1;
			}
				
		}
		else if($_SESSION['client_id']=== -1){
				echo "<div class='alert alert-danger ' style='font-size: 1.5em;'><span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp; <b>ERROR:</b> You have no such Client!</div>";
		}
		else if( isset($_POST['update-btn']) && $_SESSION['client_id']!== -1){
			
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
			
			$query = "UPDATE `clients_$table_id` SET `name` = '$name', `email` = '$email', `address` = '$address', `phone` = '$phone', `company` = '$company', `notes` = '$notes' WHERE `id` = ".$_SESSION['client_id'];
			
			if($email && $name){
					
				$result = mysqli_query($connection,$query);
				
				if($result){
					$_SESSION['client_edit']="success";
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
				
			}
				
		}
		
		include("includes/header.php");
		mysqli_close($connection);
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
	
	<h1>Edit Client</h1>
	
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
					<textarea rows="5" name='client_address' id="address" class="form-control input-lg"><?php echo $address; ?></textarea>
				</div>
			</div>
			<div class="col-md-5 col-sm-7 col-xs-9">
				<div class="form-group">
					<label for="notes">Notes</label>
					<textarea rows="5" name='client_notes' id="notes" class="form-control input-lg"><?php echo $notes; ?></textarea>
				</div>
			</div>
			
		</div>
		
		<br><br>
		<div class="row">
		
			<div class="col-md-10 col-sm-7 col-xs-9">
			<center>
				<div class="form-group">
					<a type='button' href="clients.php" class="btn btn-default btn-lg">Cancel</a>
				
					<button class="btn btn-success btn-lg" name="update-btn">Update</button>
				</div>
				</center>
			</div>
						
		</div>
		
	</form>
	
<?php include('includes/footer.php'); ?>