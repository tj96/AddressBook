<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
    <title>Client Address Book</title>

    <!-- Bootstrap -->
    <link href="//localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body style="padding-top: 80px">
	
	<nav class="navbar navbar-fixed-top navbar-inverse">
	
		<div class="container-fluid">
		
		
			<div class="navbar-header">
			
				<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">CLIENT<strong>MANAGER</strong></a>
						
			</div>
			
			<div class="navbar-collapse collapse" id="navbar-collapse">
			<?php if ($_SESSION){ $login_name = $_SESSION['logged_in_name'];?>
				<ul class="nav navbar-nav">
					<li><a href="clients.php">Clients</a></li>
					<li><a href="add.php">Add Client</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text hidden-sm hidden-xs" style="padding: 0 10px;">Hello <?php echo("$login_name !"); ?> </p>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			<?php } else { ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signup.php">Sign&nbsp;Up</a></li>
					<li><a href="index.php">Log&nbsp;In</a></li>
				</ul>
			<?php } ?>
			</div>
				
		</div>
	
	</nav>
	<?php $script=""; ?>
	<div class="container">
	