{foreach $auction val}
<div class="panel panel-default">
	 
	<div class="panel-heading"><i class="fa fa-gavel"></i> &nbsp Auction</div>
	
	<div class="panel-body">
	
	<p class="auction-description">
		Sponsored servers appear above the main list on the homepage and are the very first servers potentional players see when they visit the website. Sponsored servers also show at the top of relevant search results and category pages.
	</p>
	
	<p class="auction-description">
		Only a single sponsored slot is available at any time and it is auctioned off every two weeks. Only premium servers with a rank higher than 200 are eligible to become sponsored. The payment is completed using your credit balance.
	</p>
	
	<div class="container-fluid">
		
		<div class="row">
		
			<div class="col-md-5" style="padding: 0">
			
				<div class="panel panel-primary" style="margin-bottom: 10px">
				
					<div class="panel-heading"><i class="fa fa-star"></i> &nbsp Bids</div>
					
					<table class="table table-bordered table-striped table-responsive table-auction">
					
						<thead>
							<tr>
								<th>#</th>
								<th>Server</th>
								<th>Amount</th>
							</tr>
						</thead>
							
						<tbody>
							{foreach $bidders key, test, name='default'}
							<tr>
								<td>{$dwoo.foreach.default.index + 1}</td>
								<td>{getSiteTitle($test.site_id)}</td>
								<td>${$test.current_bid}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
				{if $user_activity}
				<form action="<?php echo base_url(); ?>auction/bid" method="POST">
					
					<div class="col-xs-9" style="padding: 0; padding-right: 5px;">
					
						<label for="bid" style="font-weight: normal;">Bid on this auction:</label>
						<input type="text" id="bid" name="bid" class="form-control" placeholder="Your current bid: ${$currentBid}" />
						
					</div>
					
					<button class="btn btn-primary pull-right" style="margin-top: 20px;">Submit</button>
					
				</form>
				{/if}
			</div>
			
			<div class="col-md-7">
			
				<div class="panel panel-primary">
				
					<div class="panel-heading"><i class="fa fa-info"></i> &nbsp Auction Information</div>
					
					<table class="table table-bordered table-striped table-responsive table-auction table-auction-info">
									
						<tbody>
							
							<tr>
								<td>Auction ID</td>
								<td>{$val.id}</td>
							</tr>
							<tr>
								<td>Status</td>
								<td style="color: #3c763d">Active</td>
							</tr>
							<tr>
								<td>Sponsored duration</td>
								<td>2 weeks</td>
							</tr>
							<tr>
								<td>Sponsored Start</td>
								<td>{$val.sponsored_start}</td>
							</tr>
							<tr>
								<td>Sponsored End</td>
								<td>{$val.sponsored_close}</td>
							</tr>
							<tr>
								<td>Total bids</td>
								<td>{$totalBids}</td>
							</tr>
							<tr>
								<td>Minimum bid</td>
								<td>${getConfigValue('auction_minimum_bid')}</td>
							</tr>
							<tr>
								<td>Auction Opens</td>
								<td>{$val.date_open}</td>
							</tr>
							<tr>
								<td>Auction Closes</td>
								<td>{$val.date_close}</td>
							</tr>
						</tbody>
					</table>
				</div>
			
			</div>
			
		</div>
		
	</div>
	
	</div>
	
</div>
{/foreach}