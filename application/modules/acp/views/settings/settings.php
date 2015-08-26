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
    <script src="<?php echo base_url(); ?>addons/acp/js/alertify/dist/js/alertify.js"></script>
	
	<style>
        .other {
            width:100%;
            text-align: center;
            text-transform: uppercase;
        }
        .otherContainer {
            box-sizing: border-box;
            display: inline-block;
            padding: 0 2em 0 0;
            width: 25%;
            margin: 0;
        }

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
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in as <strong>{$username}</strong></a></li>
			
				<li><a href="<?php echo base_url(); ?>acp/dashboard/logout" class="round button dark menu-logoff image-left">Log out</a></li>
				
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
				<li><a href="<?php echo base_url(); ?>acp/dashboard">Dashboard</a></li>
				<li><a href="<?php echo base_url(); ?>acp/dashboard/blacklist" class="active-tab dashboard-tab">Settings</a></li>
			</ul> <!-- end tabs -->
						
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Settings</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				<div class="content-module-main">
                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Site</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none">
                        <form id="users-mod1" method="POST" onsubmit="return editSiteSetting();">
                            <p>
                                <label for="full-width-input">Title</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$site_title}" name="site_title" />
                                <em>Site title.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Keywords</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$site_keywords}" name="site_keywords" />
                                <em>Site keywords.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Description</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$site_description}" name="site_description" />
                                <em>Site description.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Mail</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$admin_mail}" name="admin_mail" />
                                <em>Admin's mail.</em>
                            </p>

                            <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
                        </form>
                    </div> <!-- end content-module-section -->


                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Shop</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none">
                        <form id="users-mod1" method="POST" onsubmit="return editShopSetting();">
                            <p>
                                <label for="full-width-input">Starter price</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$shop_starter}" name="shop_starter" />
                                <em>The starter package price.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Value package price</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$shop_value}" name="shop_value" />
                                <em>The value package price.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Pro package price</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$shop_pro}" name="shop_pro" />
                                <em>The pro package price.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Premium package price</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$shop_premium}" name="shop_premium" />
                                <em>The premium package price.</em>
                            </p>

                            <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
                        </form>
                    </div> <!-- end content-module-section -->

                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Google Captcha and Analytics</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none">
                        <form id="users-mod1" method="POST" onsubmit="return editCaptchaSetting();">
                            <p>
                                <label for="full-width-input">Secret key</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$recaptcha_secret_key}" name="recaptcha_secret_key" />
                                <em>Google captcha secret key.</em>
                            </p>
                            <p>
                                <label for="full-width-input">API key</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$recaptcha_api_key}" name="recaptcha_api_key" />
                                <em>Google captcha API key.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Property ID</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$analytics_property_id}" name="analytics_property_id" />
                                <em>Google analytics property ID given on registration. Not required.</em>
                            </p>

                            <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
                        </form>
                    </div> <!-- end content-module-section -->

                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Paymentwall API</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none">
                        <form method="POST" onsubmit="return editPaymentwallSettings();">
                            <p>
                                <label for="full-width-input">Secret key</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$paymentwall_secret_key}" name="paymentwall_secret_key" />
                                <em>Paymentwall captcha secret key.</em>
                            </p>
                            <p>
                                <label for="full-width-input">API key</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$paymentwall_app_key}" name="paymentwall_app_key" />
                                <em>Paymentwall captcha API key.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Widget code</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$paymentwall_widget_code}" name="paymentwall_widget_code" />
                                <em>Paymentwall widget code.</em>
                            </p>

                            <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
                        </form>
                    </div> <!-- end content-module-section -->

                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Auction</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none">
                        <form method="POST" onsubmit="return editAuctionSettings();">
                            <p>
                                <label for="full-width-input">Minimal bid</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$auction_minimum_bid}" name="auction_minimum_bid" />
                                <em>The minimal bid allowed at an auction.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Minimal rank</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$auction_minimum_rank}" name="auction_minimum_rank" />
                                <em>The minimal rank of a user that can bid at an auction.</em>
                            </p>

                            <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
                        </form>
                    </div> <!-- end content-module-section -->

                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Theme</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none">
                        <form method="POST" onsubmit="return editThemeSettings();">
                            <p>
                                <label for="full-width-input">Blue logo</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$logo_blue}" name="logo_blue" />
                                <em>The blue part of the logo.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Gray logo</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$logo_gray}" name="logo_gray" />
                                <em>The gray part of the logo.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Middle section title</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$middle_section_title}" name="middle_section_title" />
                                <em>The middle section title displayed on the home page.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Middle section description</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$middle_section_description}" name="middle_section_description" />
                                <em>The middle section description displayed on the home page.</em>
                            </p>
                            <p>
                                <label for="full-width-input">Disqus shortname</label>
                                <input id="full-width-input" class="round full-width-input" type="text" value="{$disqus_shortname}" name="disqus_shortname" />
                                <em>The disqus shortname picked upon disqus registration.</em>
                            </p>

                            <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
                        </form>
                    </div> <!-- end content-module-section -->

                    <!-- content-module-section start -->
                    <div class="content-module-heading content-module-section-heading cf">
                        <h3 class="fl">Other</h3>
                        <span class="fr expand-collapse-text initial-expand">Click to collapse</span>
                        <span class="fr expand-collapse-text">Click to expand</span>
                    </div>
                    <div class="content-module-main" style="display:none"><!--
                        --><div class="otherContainer"><a href="<?php echo base_url(); ?>acp/dashboard/navigation" target="_blank" class="round other button blue">Navigation links</a></div><!--
                        --><div class="otherContainer">
                            <a href="<?php echo base_url(); ?>acp/dashboard/advertisements" target="_blank" class="round other button blue">Advertisements</a></div><!--
                        --><div class="otherContainer">
                            <a href="<?php echo base_url(); ?>acp/dashboard/categories" target="_blank" class="round other button blue">Categories</a></div><!--
                        --><div class="otherContainer">
                            <a href="<?php echo base_url(); ?>acp/dashboard/themes" target="_blank" class="round other button blue">Theme Changer</a></div><!--
                        --></div>
                    <!-- end content-module-section -->

                </div> <!-- end content-module -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->




    <!-- FOOTER -->
    <div id="footer">

        <p>&copy; Copyright 2015 <a href="http://votizer.com/">Votizer</a>. All rights reserved.</p>

    </div> <!-- end footer -->

</body>
</html>