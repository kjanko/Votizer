<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>		<div id="right_sidebar"> 
			<?php 
$_fh0_data = (isset($this->scope["servers"]) ? $this->scope["servers"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
			<div class="server_wrapper">
				<div class="right_sidebar_title"><a href="<?php echo $this->scope["val"]["link"];?>">» <?php echo $this->scope["val"]["title"];?></a></div>
				<div class="server_content">
					<?php echo theme_image('server-image.png');?>

					<div class="votes">
						<span class="in_out">IN</span> <span class="in_out">OUT</span>
						<span class="in"><?php echo $this->scope["val"]["in"];?></span>    <span class="out"><?php echo $this->scope["val"]["out"];?></span>
					</div>
					<br /><p><?php echo $this->scope["val"]["content"];?></p>
				</div>
			</div>	
			<?php 
/* -- foreach end output */
	}
}?>

		</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>