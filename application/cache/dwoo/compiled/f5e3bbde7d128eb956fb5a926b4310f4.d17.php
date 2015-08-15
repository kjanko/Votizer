<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><footer id="footer">
	
		<section id="footer-container" class="wrap">
		
			<aside id="left">
				<p>COPYRIGHT 2015 <strong>EVISIUMCMS</strong>. ALL RIGHTS reserved.</p>
			</aside>
			
			<aside id="right">
				<p>author: <strong>kjanko</strong>. protected by <strong>dmca</strong>!</p>
			</aside>
			
			<div class="clear"></div>
		
		</section>
	
	</footer><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>