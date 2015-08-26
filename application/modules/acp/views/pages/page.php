<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Votizer | Dashboard</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="<?php echo base_url(); ?>addons/acp/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>addons/acp/css/jquery.jqplot.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>addons/acp/js/alertify/dist/css/alertify-bootstrap-3.css" />

	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>addons/acp/js/script.js"></script>  
	<script src="<?php echo base_url(); ?>addons/acp/js/jquery.jqplot.min.js"></script>  
	<script src="<?php echo base_url(); ?>addons/acp/js/pagination.js"></script> 
	<script src="<?php echo base_url(); ?>addons/acp/js/acp.js"></script> 
	<script src="<?php echo base_url(); ?>addons/acp/js/tinymce/tinymce.min.js"></script> 
	<script src="<?php echo base_url(); ?>addons/acp/js/alertify/dist/js/alertify.js"></script>
	
	<script type="application/javascript">
		$(function()
		{
			$('#items').jPaginate();
		});
		
		function setup()
		{
			tinymce.init(
			{
				selector : "textarea",
				mode : "textareas",
				theme : "modern"
			});
		}
	</script>
</head>

<body>
	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
				<li class="v-sep"><a href="<?php echo base_url(); ?>" class="round button dark ic-left-arrow image-left">Go to website</a></li>
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong>{$username}</strong></a></li>
			
				<li><a href="/acp/dashboard/logout" class="round button dark menu-logoff image-left">Log out</a></li>
				
			</ul> <!-- end nav -->

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="/acp/dashboard">Dashboard</a></li>
				<li><a href="/acp/dashboard/users" class="active-tab dashboard-tab">Pages</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Page Managment</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
				
					<a href="#" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;" onclick="showAddPage('pages')">Add Page</a>
					
					<table>
					
						<thead>
					
							<tr>
								<th style="position: relative;">ID</th>
								<th>Title</th>
								<th>URL</th>
								<th>Actions</th>
							</tr>
						
						</thead>
						
						<tbody id="items">
							{foreach $pages val}
							<tr id="{$val.id}">
								<td>{$val.id}</td>
								<td>{$val.title}</td>
								<td><a href="/pages/{$val.controller}">{$val.controller}</a></td>
								<td>
									<a class="table-actions-button ic-table-edit" onclick="showEditPage('{$val.id}', 'pages')"></a>
									<a class="table-actions-button ic-table-delete" onclick="removePage('{$val.id}')"></a>
								</td>
							</tr>
							{/foreach}
						</tbody>
						
					</table>
					
					<div class="stripe-separator"><!--  --></div>
										
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->




    <!-- FOOTER -->
    <div id="footer">

        <p>&copy; Copyright 2015 <a href="http://votizer.com/">Votizer</a>. All rights reserved.</p>

    </div> <!-- end footer -->

</body>
</html>