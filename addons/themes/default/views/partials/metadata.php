
<title>{$template.title}</title>
	<meta charset="utf-8" />
	{set_theme('default')}
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<meta name="keywords" content="{get_site_keywords}" />
	<meta name="description" content="{get_site_description}" />
	<meta name="viewport" content="width=device-width" />
	
	{theme_css('style.css')}
	{theme_css('animate.css')}
	{theme_css('font-awesome.min.css')}
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://www.google.com/jsapi"></script>

	{theme_js('wow.js')}
	{theme_js('register.js')}
	{theme_js('login.js')}
	{theme_js('ucp.js')}
	{theme_js('details.js')}
	{theme_css('alertify-bootstrap-3.css')}
	{theme_js('alertify/dist/js/alertify.js')}

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
		
	</script>