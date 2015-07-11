<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<?php echo set_theme('default');?>

	<?php echo theme_css('style.css');?>

	<title><?php echo $this->scope["template"]["title"];?></title>
    <link rel="stylesheet" href="addons/themes/default/css/bootstrap.css" />

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>