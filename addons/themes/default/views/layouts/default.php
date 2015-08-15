<!DOCTYPE html>
<html lang="en">

<head>

	{$template.partials.metadata}
	
</head>

<body>

	<!-- Preloader -->
	<div id="preloader">
	
		<div id="status">&nbsp;</div>
		
	</div>

	{$template.partials.header}
	
	<section id="advertisement">
	
		{$template.partials.featured}
	
	</section>
	
	<section id="middle" class="wrap">
	
		<section id="middle-top" class="wow animated zoomIn">
		
			<h1>{getConfigValue('middle_section_title')}</h1>
			<h2>{getConfigValue('middle_section_description')}</h2>
			
		</section>
		
		<div class="container-fluid">
		
			<div class="row">
			
				<div class="col-md-2 sidebar-ads wow animated tada text-center">
				
					{$template.partials.sidebar}
					
				</div>
				
				<div class="col-md-10 community-servers">
				
					{$template.body}
					
				</div>
			
			</div>
		
		</div>
		
	</section>
	
	<footer id="footer">
	
		{$template.partials.footer}
	
	</footer>
	
</body>

</html>
			