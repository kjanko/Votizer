<nav id="main">
	
		<section class="wrap">
		
			<aside id="nav-left" class="wow animated fadeInDown">
			
				<h1>
					{getConfigValue('logo_blue')}<span class="sub-logo">{getConfigValue('logo_gray')}</span>
				</h1>
			
			</aside>
			
			<aside id="nav-right" class="wow animated fadeInDown">
				
				<div class="dropdown">
				
					<button class="btn btn-default dropdown-toggle toggle-nav" type="button" id="menu1" data-toggle="dropdown">
						<i class="fa fa-bars"></i>
					</button>
					
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						{foreach $navigation val}
							{if $val.permission == 0}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
								{if $val.permission == 1 && !$user_activity}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
								{if $val.permission == 2 && $user_activity}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
								{if $val.permission == 3 && $user_rank == 2}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
						{/foreach}
						
						{if $user_activity}
							<li style="bottom: 10px;" role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>logout"><button type="button" class="btn btn-danger">Logout</button></a></li>
						{/if}
						
					</ul>
				</div>
				
				<ul class="nav nav-pills navigation">
				
						{foreach $navigation val}
							<li role="presentation">
								{if $val.permission == 0}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
								{if $val.permission == 1 && !$user_activity}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
								{if $val.permission == 2 && $user_activity}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
								{if $val.permission == 3 && $user_rank == 2}
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>{$val.href}">{$val.name}</a></li>
								{/if}
							</li>
						{/foreach}
						
						<li style="bottom: 10px;" role="presentation">
						
							<div class="dropdown">
						
								<button class="btn btn-warning dropdown-toggle" type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Categories
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdown2">
									{foreach $top_categories val}
										<li><a href="<?php echo base_url(); ?>category/{$val.category}">{$val.category}</a></li>
									{/foreach}
								</ul>
								
							</div>
							
						</li>
						
						{if $user_activity}
							<li style="bottom: 10px;" role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>logout"><button type="button" class="btn btn-danger">Logout</button></a></li>
						{/if}
				</ul>
				
			</aside>
			
			<div class="clear"></div>
		
		</section>
	
	</nav>