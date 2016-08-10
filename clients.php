<!DOCTYPE html>

<?php

	session_start();
	if( ! $_SESSION){
		header("Location: index.php");
	}else{
		
		include("includes/connect.php");
		$table_id = $_SESSION['logged_in_id'];
		$del_alert = '';
		
		if($_GET){
			$client_id = $_GET['del_id'];
			
			$query="DELETE FROM clients_$table_id WHERE id=$client_id;";
			$result = mysqli_query($connection, $query);
			echo $result;
			if( $result ){
				$del_alert="<div class='alert alert-success'><span class='glyphicon glyphicon-ok-sign'></span> Congratulations! Client has been successfully deleted.<a class='close' data-dismiss='alert'>&times;</a></div>";
				
			}
			else{
				$del_alert="<div class='alert alert-danger'><span class='glyphicon glyphicon-remove-sign'></span> There was an error while deleting the Client.<a class='close' data-dismiss='alert'>&times;</a></div>";
			}
		}
		
		$query = "SELECT * FROM clients_$table_id";
		$result = mysqli_query($connection, $query);
		
		$serial = 1;
		
		include('includes/header.php');
	}

?>

	<h1>Client Address Book</h1><br>
	<?php
		if($_SESSION['client_edit']==="success"){
			echo "<div class='alert alert-success'><span class='glyphicon glyphicon-ok-sign'></span> Congratulations! Client info. has been edited.<a class='close' data-dismiss='alert'>&times;</a></div>";
			$_SESSION['client_edit']="";
		}
		if($_SESSION['client_add']==="success"){
			echo "<div class='alert alert-success'><span class='glyphicon glyphicon-ok-sign'></span> Congratulations! New client added.<a class='close' data-dismiss='alert'>&times;</a></div>";
			$_SESSION['client_add']="";
		}
		echo $del_alert;
	?>
	<table class="striped table table-bordered">
	
		<tr>
			<th>S.No.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Address</th>
			<th>Phone</th>
			<th>Company</th>
			<th>Notes</th>
			<th>Edit</th>
		</tr>
		
	<?php
		if( mysqli_num_rows($result)>0 ){
			
			while($row = mysqli_fetch_array($result)){
				echo("<tr id='row-".$row['id']."'>");
				echo(
					"<td>$serial</td>
					<td>".$row['name']."</td>
					<td>".$row['email']."</td>
					<td>".$row['address']."</td>
					<td>".$row['phone']."</td>
					<td>".$row['company']."</td>
					<td>".$row['notes']."</td>
					<td>
						<a type='button' href='edit.php?id=".$row['id']."' class='btn btn-default btn-sm'>
						<span class='glyphicon glyphicon-edit'></span></a>
						
						&nbsp;
						
						<button class='delete-btn btn-danger btn-sm' value='".$row['id']."'>
						<span class='glyphicon glyphicon-trash'></span></a>
							
					</td></tr>
					<tr class='row-delete' style='display:none;' id = 'del-row-".$row['id']."'>
						<td colspan='8' class='alert alert-warning'><center>
							Are you sure to delete this client&nbsp;?<br>
							
							<button class='delete-cancel btn btn-default'>Cancel</button>
							
							<a href='clients.php?del_id=".$row['id']."' type='button' class='btn btn-danger'>Delete</a></center>
						</td>
					</tr>"
				);
				$serial++;				
			}
			
		}
		else{
			echo "<div class='alert alert-warning'>You have no clients!</div>";
		}
		mysqli_close($connection);
	?>
		
		<tr>
			<td colspan='8' class="text-center">
				<a type="button" href="add.php" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-plus"></span> Add Client
				</a>
			</td>
		</tr>
	
	</table>
	
<?php
	$script = '
		<script>
			$(function(){
				$del_id = 0;
				$(".delete-btn").click(function(){
					$del_id = $(this).val();
					$(".row-delete").not("#del-row-"+$del_id).fadeOut(0);
					$("#del-row-"+$del_id).fadeIn(500);
				});
				
				$(".delete-cancel").click(function(){
					$("#del-row-"+$del_id).fadeOut(0);
				});
					
			});
		</script>
	
	';

	include('includes/footer.php'); 
?>