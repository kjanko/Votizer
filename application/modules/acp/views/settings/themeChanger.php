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
    <script src="/addons/acp/js/jquery.jeditable.mini.js"></script>

	<style>
		ul.pagination { position: absolute; margin-top: 37px; list-style: none; }
		ul.pagination li { display:inline; }
		ul.pagination li a { margin-left: 5px; padding:3px 5px; color:#fff; background-color:rgb(93, 102, 119); text-decoration:none; }
		ul.pagination li a:hover { background-color:rgb(95, 108, 121)}
        .other {
            width:50%;
            text-align: center;
            text-transform: uppercase;
        }
        .otherContainer {
            text-align: center;
            box-sizing: border-box;
            display: inline-block;
            padding: 0 1em;
            width: 100%;
            margin: 0 auto;
        }
        * {
            box-sizing: border-box;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .row:before,
        .row:after
        {
            display: table;
            content: " ";
            clear: both;
        }
        .col-xs-4 {
            position: relative;
            min-height: 1px;
            padding-right: 5px;
            padding-left: 5px;
            float: left;
        }
        .col-xs-4 {
            width: 33.33333333%;
        }
        .thumbnail {
            display: block;
            padding: 4px;
            margin-bottom: 20px;
            line-height: 1.42857143;
        }
        img {
             vertical-align: middle
            border: 0;
         }
        .img-responsive,
        .thumbnail > img,
        .thumbnail a > img {
            display: block;
            max-width: 100%;
            height: auto;
            margin-right: auto;
            margin-left: auto;
        }
        div.theme:hover,
        div.theme:focus,
        div.theme.active {
            border-color: #337ab7;
        }
        .theme {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin: 7.5px 0;
            -webkit-transition: border .2s ease-in-out;
            -o-transition: border .2s ease-in-out;
            transition: border .2s ease-in-out;
        }
        .active {
            background-color:#27ae60;
            color: white
        }
	</style>
	
	<script>
        $(document).ready(function() {
            $(function(){
                $('.activate').click(function(){
                    var form_data =
                    {
                        theme_name : $(this).attr('id')
                    };
                    $.ajax(
                        {
                            url: '/ajax/setTheme',
                            type: 'POST',
                            data: form_data,
                            success:
                                function(message)
                                {
                                    var json = jQuery.parseJSON(message);
                                    alertify.success(json.msg);
                                    setTimeout( function() { location="/acp/dashboard/themes" }, 500);
                                }
                        });
                })
            })
        });
	</script>
</head>

<body>
	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
				<li class="v-sep"><a href="#" class="round button dark ic-left-arrow image-left">Go to website</a></li>
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
                <li><a href="/acp/dashboard/settings">Settings</a></li>
				<li><a href="/acp/dashboard/advertisements" class="active-tab dashboard-tab">Themes</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Themes</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
                    <p>Here you manage your theme. Click on the active button to activate the theme shown on the image.</p>
                    <div class="row">
                        {foreach $themes val}
                        <div class="col-xs-4">
                            <div class="theme">
                                <a class="thumbnail">
                                    <img src="<?php echo base_url(); ?>addons/themes/{$val}/img.jpg" class="img-responsive">
                                </a>
                                <div class="otherContainer">
                                    {if $val != $active}
                                        <a id="{$val}" class="round activate other button blue">Activate</a>
                                    {else}
                                        <a class="round active other button" >Active</a>
                                    {/if}
                                </div>
                            </div>
                        </div>
                        {/foreach}
                    </div>

					<div class="stripe-separator"></div>
					
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