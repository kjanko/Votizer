<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IgnitionCMS | Dashboard</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="/addons/acp/css/style.css">
	<link rel="stylesheet" href="/addons/acp/css/jquery.jqplot.css">
	<link rel="stylesheet" href="/addons/acp/js/alertify/dist/css/alertify-bootstrap-3.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	
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

	
	<script type="application/javascript">
		$(function() 
		{
            $(".premium").dblclick(function(){
                showAddPremium($(this).attr('id'),'sites');
            });
            $("#items").jPaginate();
        });
		
		search('sites', 'title', 'sites-search', 'Such site does not exist!');

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
				<li><a href="/acp/dashboard/sites" class="active-tab dashboard-tab">Sites</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Sites Managment</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
				
					<p>This section provides state oversight for the investigation and cleanup of site's properties. Make a site premium by double clicking the premium field.</p>
					
					<form onsubmit="return false;" action="#" method="POST" id="search-form" class="fr"
					style="position: absolute; right: 50px; top: 220px;">
						<fieldset>
							<input type="text" name="search" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search...">
							<input type="hidden" value="SUBMIT">
						</fieldset>
					</form>
					
					<table>
					
						<thead>
					
							<tr>
								<th style="position: relative;">Id</th>
								<th>Username</th>
								<th>Title</th>
								<th>Category</th>
								<th>In Votes</th>
								<th>Out Votes</th>
								<th>Premium</th>
								<th>Actions</th>
							</tr>
						
						</thead>
						
						<tbody id="items">
							{foreach $sites val}
							<tr id="{$val.id}">
								<td>{$val.id}</td>
								<td><a href="#" onclick="showEditUser('{$val.username}','sites')">{$val.username}</td>
								<td>{$val.title}</td>
								<td>{$val.category_id}</td>
								<td>{$val.in_votes}</td>
								<td>{$val.out_votes}</td>
								<td id="{$val.id}" class="premium">
									{if $val.premium == 1}
										True
									{else}
										False
									{/if}
								</td>
								<td>
									<a class="table-actions-button ic-table-edit" onclick="showEditSite({$val.id})"></a>
									<a class="table-actions-button ic-table-delete" onclick="removeSite({$val.id})"></a>
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

		<p>&copy; Copyright 2012 <a href="#">IgnitionCMS</a>. All rights reserved.</p>
	
	</div> <!-- end footer -->

</body>
</html>