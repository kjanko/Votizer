					{foreach $servers val}
					<section class="box wow animated fadeIn">
						
						<h1>#{$val.rank}</h1>
						
						<div class="row">
							
							
							<div class="col-md-2 text-center">
							
								<h1>Rank</h1>
								<h2>{$val.rank}</h2>
								
								<button class="btn btn-primary custom btn-block">Read More</button>
								<br />
								<button class="btn btn-primary custom btn-block">Vote</button>
							
							</div>
							
							<div class="col-md-7">
							
								<img src="./img/banners/1.jpg" class="img-responsive" alt="" />
								
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
								<a href="{$val.url}">{$val.url}</a>
								
							</div>
						
						</div>
						
					</section>
					{/foreach}