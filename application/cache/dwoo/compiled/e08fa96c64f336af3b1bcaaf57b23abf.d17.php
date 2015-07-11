<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html ng-app="saApp">
<head lang="en" >
	<?php echo $this->scope["template"]["partials"]["metadata"];?>

</head>
<body ng-cloak>
    <nav>
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="#/events">Home</a></li>
            <li role="presentation"><a href="#/about">About</a></li>
        </ul>
    </nav>
    <?php echo $this->scope["template"]["partials"]["content"];?>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>