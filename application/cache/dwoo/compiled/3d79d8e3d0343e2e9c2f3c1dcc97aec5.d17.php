<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="panel panel-default">
	 
	<div class="panel-heading">Vote</div>
	
	<div class="panel-body text-center" style="padding: 0 20px 0">

		<h3><?php echo $this->scope["site"]["title"];?></h3>
		
		<p><?php echo $this->scope["site"]["description"];?></h3>
		<?php if ((isset($this->scope["site"]["premium"]) ? $this->scope["site"]["premium"]:null) == 1) {
?>
		<br /><br />
		<img style="display: inline-block;" class="img-responsive" src="<?php echo $this->scope["site"]["banner_url"];?>" alt="banner" />
		<br />
		<?php 
}?>


		
		<form class="form-horizontal" method="post" action="http://localhost/in/validate/<?php echo $this->scope["site"]["id"];?>">
		
			<div class="form-group">
			
				<div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $this->scope["api_key"];?>"></div>
				
			</div>
			
			<div>
			
				<input class="btn btn-primary center-block" id="submit" style="margin-bottom:10px; " type="submit" value="Vote" />
				
			</div>
			
		</form>
		
	</div>
	
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>