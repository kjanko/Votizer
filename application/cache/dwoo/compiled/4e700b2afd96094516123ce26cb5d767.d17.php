<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html lang="en">

<head>

	<?php echo $this->scope["template"]["partials"]["metadata"];?>

	
</head>

<body>

	<!-- Preloader -->
	<div id="preloader">
	
		<div id="status">&nbsp;</div>
		
	</div>

	<?php echo $this->scope["template"]["partials"]["header"];?>

	
	<section id="advertisement">
	
		<?php echo $this->scope["template"]["partials"]["featured"];?>

	
	</section>
	
	<section id="middle" class="wrap">
	
		<section id="middle-top" class="wow animated zoomIn">
		
			<h1>Community Servers</h1>
			<h2>LOREM IPSUM DOLOR SIT AMET. CONSTEQUENCES ELICETIRA IMET</h2>
			
		</section>
		
		<div class="container-fluid">
		
			<div class="row">
			
				<div class="col-md-2 sidebar-ads wow animated tada text-center">
				
					<?php echo $this->scope["template"]["partials"]["sidebar"];?>

					
				</div>
				
				<div class="col-md-10 community-servers">
				
					<?php echo $this->scope["template"]["body"];?>

					
				</div>
			
			</div>
		
		</div>
		
	</section>
	
	<footer id="footer">
	
		<?php echo $this->scope["template"]["partials"]["footer"];?>

	
	</footer>
	
</body>

</html>
			<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>