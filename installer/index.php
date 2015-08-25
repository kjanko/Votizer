<?php require_once('includes/general.php'); ?>


<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>Install | Votizer</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	
	<body>
	<br />
	<div class="panel panel-default">
	
		<div class="panel-body">

			<h3>Install</h3>
			
			<?php if(is_writable('../application/config/database.php'))
			{?>				
				
				  <?php if(isset($message)) {echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>' . $message . '</div>';}?>
				
				  <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="form-group">
						<h5>Database settings</h5>
						<label for="hostname">Hostname</label><input type="text" id="hostname" value="localhost" class="form-control" name="hostname" />
						<label for="username">Username</label><input type="text" id="username" class="form-control" name="username" />
						<label for="password">Password</label><input type="password" id="password" class="form-control" name="password" />
						<label for="database">Database Name</label><input type="text" id="database" class="form-control" name="database" />
						<br />
						<input type="submit" class="btn btn-primary" value="Install" id="submit" />

					</div>
				  </form>

			  <?php } else { ?>
			  <p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
			  <?php } ?>
	  
	    </div>
		
	</div>

	</body>
</html>