<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><nav id="main">
	
		<section class="wrap">
		
			<aside id="nav-left" class="wow animated fadeInDown">
			
				<h1>
					evisium<span class="sub-logo">cms</span>
				</h1>
			
			</aside>
			
			<aside id="nav-right" class="wow animated fadeInDown">
				
				<div class="dropdown">
				
					<button class="btn btn-default dropdown-toggle toggle-nav" type="button" id="menu1" data-toggle="dropdown">
						<i class="fa fa-bars"></i>
					</button>
					
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php 
$_fh0_data = (isset($this->scope["navigation"]) ? $this->scope["navigation"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
							<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 0) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 1 && ! (isset($this->scope["user_activity"]) ? $this->scope["user_activity"] : null)) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 2 && (isset($this->scope["user_activity"]) ? $this->scope["user_activity"] : null)) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 3 && (isset($this->scope["user_rank"]) ? $this->scope["user_rank"] : null) == 2) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

						<?php 
/* -- foreach end output */
	}
}?>

						
						<?php if ((isset($this->scope["user_activity"]) ? $this->scope["user_activity"] : null)) {
?>
							<li style="bottom: 10px;" role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/logout"><button type="button" class="btn btn-danger">Logout</button></a></li>
						<?php 
}?>

						
					</ul>
				</div>
				
				<ul class="nav nav-pills navigation">
				
						<?php 
$_fh1_data = (isset($this->scope["navigation"]) ? $this->scope["navigation"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
							<li role="presentation">
								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 0) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 1 && ! (isset($this->scope["user_activity"]) ? $this->scope["user_activity"] : null)) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 2 && (isset($this->scope["user_activity"]) ? $this->scope["user_activity"] : null)) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

								<?php if ((isset($this->scope["val"]["permission"]) ? $this->scope["val"]["permission"]:null) == 3 && (isset($this->scope["user_rank"]) ? $this->scope["user_rank"] : null) == 2) {
?>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/<?php echo $this->scope["val"]["href"];?>"><?php echo $this->scope["val"]["name"];?></a></li>
								<?php 
}?>

							</li>
						<?php 
/* -- foreach end output */
	}
}?>

						
						<?php if ((isset($this->scope["user_activity"]) ? $this->scope["user_activity"] : null)) {
?>
							<li style="bottom: 10px;" role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost/logout"><button type="button" class="btn btn-danger">Logout</button></a></li>
						<?php 
}?>

				</ul>
				
			</aside>
			
			<div class="clear"></div>
		
		</section>
	
	</nav><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>