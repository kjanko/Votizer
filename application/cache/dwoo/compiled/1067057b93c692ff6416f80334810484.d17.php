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
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script src="/addons/acp/js/script.js"></script>  
	<script src="/addons/acp/js/jquery.jqplot.min.js"></script>  
	<script src="/addons/acp/js/pagination.js"></script> 
	<script src="/addons/acp/js/acp.js"></script> 
	
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
				<li><a href="/acp/dashboard/users" class="active-tab dashboard-tab">Users</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">User Managment</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
				
					<p>User management is a critical part of maintaining a secure system. Ineffective user and privilege management often lead many systems into being compromised.</p>
					<a href="#" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;" onclick="showAddUser()">Add User</a>
					
					<table>
					
						<thead>
					
							<tr>
								<th style="position: relative;">Id</th>
								<th>Name</th>
								<th>Username</th>
								<th>Rank</th>
								<th>Email</th>
								<th>Actions</th>
							</tr>
						
						</thead>
						
						<tbody id="users">
							<?php 
$_fh0_data = (isset($this->scope["users"]) ? $this->scope["users"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
							<tr id="<?php echo $this->scope["val"]["username"];?>">
								<td><?php echo $this->scope["val"]["id"];?></td>
								<td><?php echo $this->scope["val"]["name"];?> <?php echo $this->scope["val"]["l_name"];?></td>
								<td><?php echo $this->scope["val"]["username"];?></td>
								<td><?php echo $this->scope["val"]["rank"];?></td>
								<td><a href="#"><?php echo $this->scope["val"]["email"];?></a></td>
								<td>
									<a href="#" class="table-actions-button ic-table-edit" onclick="showEditUser('<?php echo $this->scope["val"]["username"];?>','users')"></a>
									<a href="#" class="table-actions-button ic-table-delete" onclick="removeUser('<?php echo $this->scope["val"]["username"];?>')"></a>
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