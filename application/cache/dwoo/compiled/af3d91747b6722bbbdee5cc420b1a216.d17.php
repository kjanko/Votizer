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
    <link rel="stylesheet" href="/addons/acp/js/alertify/dist/css/alertify-bootstrap-3.css" />
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script src="/addons/acp/js/script.js"></script>  
	<script src="/addons/acp/js/jquery.jqplot.min.js"></script>  
	<script src="/addons/acp/js/pagination.js"></script> 
	<script src="/addons/acp/js/acp.js"></script>
    <script src="/addons/acp/js/alertify/dist/js/alertify.js"></script>
	
	<style>
		ul.pagination { position: absolute; margin-top: 37px; list-style: none; }
		ul.pagination li { display:inline; }
		ul.pagination li a { margin-left: 5px; padding:3px 5px; color:#fff; background-color:rgb(93, 102, 119); text-decoration:none; }
		ul.pagination li a:hover { background-color:rgb(95, 108, 121)
	</style>
	<script type="application/javascript">
		$(function() 
		{
			$('#users').jPaginate({ items: 5, next: '>', previous: '<' });
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
				<li><a href="/acp/dashboard">Dashboard</a></li>
				<li><a href="/acp/dashboard/blacklist" class="active-tab dashboard-tab">Blacklist</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Blacklist Management</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				<div class="content-module-main">
					<button class="blacklist activeBlacklist">IPs</button> 
					<button class="blacklist" onclick="showBlacklistUsers()">Users</button>
                    <button class="blacklist" onclick="showBlacklistProfanity()">Profanity</button>
                    <button class="blacklist" onclick="showBlacklistUrls()">URLs</button>
					<form style="display:inline-block; float:right;" id="users-mod" method="POST" onsubmit="return banIp();">
						<input style="width:10em;" type="text" id="simple-input" name="ip" class="round default-width-input" placeholder="Ip...">
						<input type="submit" value="Add" class="round blue ic-add" />
					</form>
					<table>
					
						<thead>
					
							<tr>
								<th style="position: relative;">Id</th>
								<th>Ip</th>
								<th>Actions</th>
							</tr>
						
						</thead>
						
						<tbody id="users">
							<?php 
$_fh0_data = (isset($this->scope["blacklistIps"]) ? $this->scope["blacklistIps"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
							<tr id="<?php echo $this->scope["val"]["id"];?>">
								<td><?php echo $this->scope["val"]["id"];?></td>
								<td><?php echo $this->scope["val"]["ip"];?></td>
								<td>
									<a href="#" class="table-actions-button ic-table-delete" onclick="removeBlacklistIps(<?php echo $this->scope["val"]["id"];?>, '<?php echo $this->scope["val"]["ip"];?>')"></a>
								</td>
							</tr>
							<?php 
/* -- foreach end output */
	}
}?>

						</tbody>
						
					</table>
					
					<div class="stripe-separator"><!--  --></div>
										
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
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