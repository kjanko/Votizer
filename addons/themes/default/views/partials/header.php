<nav id="main">
	
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
					
						{foreach $navigation val}
							<li role="presentation"><a role="menuitem" tabindex="-1" href="{$val.href}">{$val.name}</a></li>
						{/foreach}
						
					</ul>
				</div>
				
				<ul class="nav nav-pills navigation">
				
						{foreach $navigation val}
							<li role="presentation">
								<a href="{$val.href}">{$val.name}</a>
							</li>
						{/foreach}
						
				</ul>
				
			</aside>
			
			<div class="clear"></div>
		
		</section>
	
	</nav>