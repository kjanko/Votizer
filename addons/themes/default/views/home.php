					
					{foreach $servers key, val, name='default'}
					{if $val.premium == 1}
					<section class="box wow animated fadeIn">
						
						<h1>#{$dwoo.foreach.default.index + 1}</h1>
						
						<div class="row">
							
							
							<div class="col-md-2 text-center">
							
								<h1>Rank</h1>
								<h2>{$dwoo.foreach.default.index + 1}</h2>
								
								<button onclick="location.href='<?php echo base_url(); ?>details/show/{$val.id}';" class="btn btn-primary custom btn-block">Read More</button>
								<br />
								<button onclick="location.href='<?php echo base_url(); ?>in/vote/{$val.id}';" class="btn btn-primary custom btn-block">Vote</button>
							
							</div>
							
							<div class="col-md-7">
							
								<img src="{$val.banner_url}" class="img-responsive" alt="" />
								
								<h3>{$val.title}</h3>
								
								<p>
									{$val.description}
								</p>
							
							</div>
							
							<div class="col-md-3">
							
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
					{else}
					<section class="box wow animated fadeIn animated animated">
						
						<h1>#{$dwoo.foreach.default.index + 1}</h1>
						
						<div class="row">
							
							
							<div class="col-md-2 text-center">
							
								<h1>Rank</h1>
								<h2>{$dwoo.foreach.default.index + 1}</h2>
							
							</div>
							
							<div class="col-md-7">
															
								<a href="<?php echo base_url(); ?>out/vote/{$val.id}"><h3>{$val.title}</h3></a>
								
								<p>
									{$val.description}
								</p>
							
							</div>
							
							<div class="col-md-3">
							
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
																
							</div>
						
						</div>
						
					</section>
					{/if}
					{/foreach}
					