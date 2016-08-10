<?php
	session_start();
	if( isset($_COOKIE[session_name()]) ){
		
		setcookie( session_name(),"",time()-84600, '/' );
		
	}
	
	session_unset();
	session_destroy();
	
	include("includes/header.php");
		
?>
		
		<h1>Logout</h1>
		<div class="alert alert-warning">
			You have been successfully logged out!
		</div>
		
		<a href='index.php' class='btn btn-info btn-sm'>Log In!</a>
		
	<?php include("includes/footer.php"); ?>