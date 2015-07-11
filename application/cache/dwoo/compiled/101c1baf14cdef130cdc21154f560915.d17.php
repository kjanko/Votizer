<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html ng-app="saApp">
<head lang="en" >
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" href="css/jquery-ui.theme.min.css" />
    <script src="lib/jquery-1.11.3.min.js"></script>
    <script src="lib/jquery-ui.min.js"></script>
</head>
<body ng-cloak>
    <nav>
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="#/events">Home</a></li>
            <li role="presentation"><a href="#/about">About</a></li>
        </ul>
    </nav>
    <?php echo $this->scope["template"]["partials"]["content"];?>

    <script src="lib/angular.js"></script>
    <script src="lib/angular-route.min.js"></script>
    <script src="lib/angular-resource.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/services/appData.js"></script>
    <script src="js/services/eventResource.js"></script>
    <script src="js/controllers/eventsController.js"></script>
    <script src="js/controllers/eventDetailsController.js"></script>
    <script src="js/controllers/aboutController.js"></script>
    <script src="js/directives/voteWidg.js"></script>
    <script src="js/directives/collapsible.js"></script>
    <script src="js/directives/errorSrc.js"></script>
</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>