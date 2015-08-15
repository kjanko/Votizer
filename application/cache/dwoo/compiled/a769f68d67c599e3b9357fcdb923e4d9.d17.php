<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>
<title><?php echo $this->scope["template"]["title"];?></title>
	<meta charset="utf-8" />
	<?php echo set_theme('default');?>

	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<meta name="keywords" content="<?php echo get_site_keywords();?>" />
	<meta name="description" content="<?php echo get_site_description();?>" />
	<meta name="viewport" content="width=device-width" />
	
	<?php echo theme_css('style.css');?>

	<?php echo theme_css('animate.css');?>

	<?php echo theme_css('font-awesome.min.css');?>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php echo theme_js('wow.js');?>

	<?php echo theme_js('register.js');?>

	<?php echo theme_js('login.js');?>

	<?php echo theme_js('ucp.js');?>

	<?php echo theme_css('alertify-bootstrap-3.css');?>

	<?php echo theme_js('alertify/dist/js/alertify.js');?>


	<script>
		new WOW().init();
		$(window).load(function() 
		{
				$('#status').fadeOut;
				$('#preloader').delay(350).fadeOut('slow');
				$('body').delay(350).css(
				{
					'overflow':'visible'
				});
		})
		
	</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>