<div class="panel panel-default">
	 
	<div class="panel-heading">
		Premium Membership
		<div class="pull-right">
			Current balance: <strong>{$points}</strong>
		</div>
	</div>
	
	<div class="panel-body" style="padding: 0 20px 0">
		
		<div class="container-fluid">
	
			<div class="pricing-tables attached wow animated zoomIn">

				<div class="row">
				
					<div class="col-sm-3 col-md-3">
				   
					<div class="plan first">

						<div class="head">
						
							<h2>Starter</h2>
					  
						</div>  

					  <ul class="item-list">
					  
						   <li><strong>30 days</strong> duration</li>
						   <li><strong>Premium</strong> banner</li>
						   <li><strong>Increased</strong> traffic</li>
						   <li><strong>{getConfigValue('shop_starter')}$</strong> monthly</li>

					  </ul>

					  <div class="price">
						<h3><span class="symbol">$</span>{getConfigValue('shop_starter')}</h3>
						<h4>per month</h4>
					  </div>
						
					<a href="<?php echo base_url(); ?>premium/purchase/1">
					
						<button type="button" class="btn btn-success">Buy now</button>
						
					</a>

				   </div>
					 
					
				  </div>


				<div class="col-sm-3 col-md-3 ">
					
					<div class="plan ">

					  <div class="head">
						<h2>Value</h2>
					  
					  </div>  

					  <ul class="item-list">
					  
						   <li><strong>90 days</strong> duration</li>
						   <li><strong>Premium</strong> banner</li>
						   <li><strong>Increased</strong> traffic</li>
						   <li><strong>13$</strong> monthly</li>
					  </ul>

					<div class="price">
						<h3><span class="symbol">$</span>{getConfigValue('shop_value')}</h3>
						<h4>per 3 months</h4>
					</div>

					<a href="<?php echo base_url(); ?>premium/purchase/2">
					
						<button type="button" class="btn btn-success">Buy now</button>
						
					</a>

					</div>

				</div>


				<div class="col-sm-3 col-md-3 ">
					  
					  <div class="plan recommended">

						<div class="head">
						  <h2>Pro</h2>
						</div>  

						<ul class="item-list">
						
							<li><strong>365 days</strong> duration</li>
							<li><strong>Featured</strong> spot</li>
							<li><strong>Premium</strong> banner</li>
							<li><strong>Increased</strong> traffic</li>
							<li><strong>8$</strong> monthly</li>

						</ul>

						<div class="price">
						  <h3><span class="symbol">$</span>{getConfigValue('shop_pro')}</h3>
						  <h4>per year</h4>
						</div>

						<a href="<?php echo base_url(); ?>premium/purchase/3">
					
							<button type="button" class="btn btn-success">Buy now</button>
						
						</a>
				   </div>

				  </div>

				  <div class="col-sm-3 col-md-3 ">
					  
					  <div class="plan last">

						<div class="head">
						  <h2>Premium</h2>
						</div>  

						<ul class="item-list">
						
							<li><strong>180 days</strong> duration</li>
							<li><strong>Premium</strong> banner</li>
							<li><strong>Increased</strong> traffic</li>
							<li><strong>11$</strong> monthly</li>

						</ul>

						<div class="price">
						  <h3><span class="symbol">$</span>{getConfigValue('shop_premium')}</h3>
						  <h4>per month</h4>
						</div>

						<a href="<?php echo base_url(); ?>premium/purchase/4">
					
							<button type="button" class="btn btn-success">Buy now</button>
						
						</a>
						
				   </div>

				  </div>

				</div>
			
			</div>
		
		</div>

	</div>
	
</div>