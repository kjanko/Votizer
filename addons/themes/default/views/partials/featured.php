	{foreach $featured key, val, name='default'}
	<div class="container-fluid">
		
		<div class="row">
			
			<section class="box wrap wow animated tada">
			
				<h1>Featured Server</h1>
				
				<div class="row">
				
					<div class="col-md-2 text-center">
					
						<h1>Rank</h1>
						<h2>{$dwoo.foreach.default.index + 1}</h2>
						
						<button class="btn btn-primary custom btn-block">Read More</button>
						<br />
						<button onclick="location.href='<?php echo base_url(); ?>in/vote/{$val.id}';" class="btn btn-primary custom btn-block">Vote</button>
					
					</div>
					
					<div class="col-md-8">
					
						<img src="{$val.banner_url}" class="img-responsive" alt="" />
						
						<h3>{$val.title}</h3>
						
						<p>
							{$val.description}
						</p>
					
					</div>
					
					<div class="col-md-2">
					
						<h1>Votes</h1>
						
						<div class="row">
						
							<div class="col-md-6">
							
								<h1>IN</h1>
								
								<h3 class="text-green">
								
									<span class="text-green">{$val.in_votes}</span>
									
								</h3>
							
							</div>
							
							<div class="col-md-6">
							
								<h1>OUT</h1>
								
								<h3>
								
									<span class="text-red">{$val.out_votes}</span>
									
								</h3>
							
							</div>
							
						</div>
						
						<br /><br />
						<h1>Server address:</h1>
						<a href="<?php echo base_url(); ?>out/vote/{$val.id}">{$val.url}</a>
					
					</div>
				
				</div>
			
			</section>
			
		</div>
		  
	</div>
	{/foreach}