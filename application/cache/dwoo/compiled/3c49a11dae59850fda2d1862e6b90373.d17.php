<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>		<div id="left_sidebar" align="left">
			<div class="categories">
				<div class="left_sidebar_title">» CATEGORIES</div>
				<ul class="categories_">
					<?php 
$_fh0_data = (isset($this->scope["categories"]) ? $this->scope["categories"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
					<li><a href="#">» <?php echo $this->scope["val"]["title"];?></a></li>
					<?php 
/* -- foreach end output */
	}
}?>

				</ul>
			</div>
		</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>