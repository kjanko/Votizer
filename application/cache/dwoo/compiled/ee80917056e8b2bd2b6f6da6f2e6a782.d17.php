<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IgnitionCMS | Dashboard</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="/addons/acp/css/style.css">
	<link rel="stylesheet" href="/addons/acp/css/jquery.jqplot.css">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="/addons/acp/js/script.js"></script>  
	<script src="/addons/acp/js/jquery.jqplot.min.js"></script>
	<script src="/addons/acp/js/acp.js"></script>
	
	<script type="application/javascript">
		$(function() 
		{
			displayChart();
		});
	</script>
</head>

<body>
	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
				<li class="v-sep"><a href="#" class="round button dark ic-left-arrow image-left">Go to website</a></li>
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong><?php echo $this->scope["username"];?></strong></a></li>
			
				<li><a href="/acp/dashboard/logout" class="round button dark menu-logoff image-left">Log out</a></li>
				
			</ul> <!-- end nav -->

					
			<form action="#" method="POST" id="search-form" class="fr">
				<fieldset>
					<input type="text" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search..." />
					<input type="hidden" value="SUBMIT" />
				</fieldset>
			</form>

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="/acp/dashboard" class="active-tab dashboard-tab">Dashboard</a></li>
				<li><a href="/acp/dashboard/users">Users</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="side-menu fl">
				
				<h3>Navigation</h3>
				<ul>
					<li><a href="/acp/dashboard">Home</a></li>
					<li><a href="/acp/dashboard/users">Users</a></li>
					<li><a href="#">Servers</a></li>
					<li><a href="#">Settings</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="half-size-column fl">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">Announcements</h3>
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main">
						<?php 
$_fh0_data = (isset($this->scope["feeds"]) ? $this->scope["feeds"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
								<h2> <?php echo $this->scope["val"]["title"];?> </h2>
								<p><?php echo $this->scope["val"]["content"];?></p>
								<span class="radius2"><?php echo $this->scope["val"]["date"];?></span>
							<div class="stripe-separator"><!-- --></div>
						<?php 
/* -- foreach end output */
	}
}?>

					
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>
				
				<div class="half-size-column fl">
					
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">Details</h3>
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand" style="display: none; ">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main">
													
							<h1>System Details</h1>
							<p>PHP Version: 5.2.17</p>
							<p>CMS Version: 0.1.3 [Alpha]</p>
							<p>Loading Time: 0.3138</p>
							<p>Memory Usage: 36751 KB</p>
							<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  apache_get_modules() has been disabled for security reasons</p>
<p>Filename: views/dashboard.php</p>
<p>Line Number: 142</p>

</div><div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Warning</p>
<p>Message:  in_array() [<a href='function.in-array'>function.in-array</a>]: Wrong datatype for second argument</p>
<p>Filename: views/dashboard.php</p>
<p>Line Number: 142</p>

</div><div class="error-box round"> mod_rewrite is not enabled! </div>							<div class="warning-box round"> Remote updater is under development! </div>
							<div class="stripe-separator"><!-- --></div>
							
							<h1>User Activity</h1>
							<h3>Work in progress!</h3>
							<div id="chartdiv" style="height:250px;width:430px; "></div>
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
					
				</div>
		
			</div> <!-- end side-content -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<div id="footer">

		<p>&copy; Copyright 2012 <a href="#">IgnitionCMS</a>. All rights reserved.</p>
	
	</div> <!-- end footer -->

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>