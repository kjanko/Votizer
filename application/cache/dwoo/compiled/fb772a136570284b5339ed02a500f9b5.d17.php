<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IgnitionCMS | ACP</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="/addons/acp/css/style.css">

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script src="/addons/acp/js/acp.js"></script> 
	
	<script type="application/javascript">
	
	$(document).ready(function() 
	{
		adminLogin();
	});

	</script>
	
</head>

<body>

	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width">
		
			<a href="http://localhost/" class="round button dark ic-left-arrow image-left ">Return to website</a>

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header">
		
		<div class="page-full-width cf">
			<div id="login-intro" class="fl">
			
				<h1>Administration Control Panel</h1>
				<h5>Enter your credentials below</h5>
			
			</div> <!-- login-intro -->
					
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
	
		<form action="#" method="POST" id="login-form">
		
			<fieldset>

				<p>
					<label for="login-username">username</label>
					<input type="text" id="login-username" class="round full-width-input" autofocus />
				</p>

				<p>
					<label for="login-password">password</label>
					<input type="password" id="login-password" class="round full-width-input" />
				</p>
				
				
				<input type="submit" id="login-submit" value="LOG IN" class="button round blue image-right ic-right-arrow" />

			</fieldset>

			<br/><div class="information-box round">Valid informations required.</div>

		</form>
		
	</div> <!-- end content -->
	
	
	<!-- FOOTER -->
	<div id="footer">

		<p>&copy; Copyright 2012 <a href="http://project-ignition.com/">IgnitionCMS</a>. All rights reserved.</p>
	
	</div> <!-- end footer -->

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>