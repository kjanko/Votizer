<div class="panel panel-default">
	 
	<div class="panel-heading">Vote</div>
	
	<div class="panel-body text-center" style="padding: 0 20px 0">

		<h3>{$site.title}</h3>
		
		<p>{$site.description}</h3>
		{if $site.premium == 1}
		<br /><br />
		<img style="display: inline-block;" class="img-responsive" src="{$site.banner_url}" alt="banner" />
		<br />
		{/if}

		
		<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>in/validate/{$site.id}">
		
			<div class="form-group">
			
				<div class="g-recaptcha" style="display: inline-block;" data-sitekey="{$api_key}"></div>
				
			</div>
			
			<div>
			
				<input class="btn btn-primary center-block" id="submit" style="margin-bottom:10px; " type="submit" value="Vote" />
				
			</div>
			
		</form>
		
	</div>
	
</div>