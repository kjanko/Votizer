		<div id="right_sidebar"> 
			{foreach $servers val}
			<div class="server_wrapper">
				<div class="right_sidebar_title"><a href="{$val.link}">» {$val.title}</a></div>
				<div class="server_content">
					{theme_image('server-image.png')}
					<div class="votes">
						<span class="in_out">IN</span> <span class="in_out">OUT</span>
						<span class="in">{$val.in}</span>    <span class="out">{$val.out}</span>
					</div>
					<br /><p>{$val.content}</p>
				</div>
			</div>	
			{/foreach}
		</div>