<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>	<?php 
$_fh2_data = (isset($this->scope["featured"]) ? $this->scope["featured"] : null);
$this->globals["foreach"]['default'] = array
(
	"index"		=> 0,
);
$_fh2_glob =& $this->globals["foreach"]['default'];
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['key']=>$this->scope['val'])
	{
/* -- foreach start output */
?>
	<div class="container-fluid">
		
		<div class="row">
			
			<section class="box wrap wow animated tada">
			
				<h1>Featured Server</h1>
				
				<div class="row">
				
					<div class="col-md-2 text-center">
					
						<h1>Rank</h1>
						<h2><?php echo $this->globals["foreach"]["default"]["index"]+1;?></h2>
						
						<button class="btn btn-primary custom btn-block">Read More</button>
						<br />
						<button onclick="location.href='http://localhost/in/vote/<?php echo $this->scope["val"]["id"];?>';" class="btn btn-primary custom btn-block">Vote</button>
					
					</div>
					
					<div class="col-md-8">
					
						<img src="<?php echo $this->scope["val"]["banner_url"];?>" class="img-responsive" alt="" />
						
						<h3><?php echo $this->scope["val"]["title"];?></h3>
						
						<p>
							<?php echo $this->scope["val"]["description"];?>

						</p>
					
					</div>
					
					<div class="col-md-2">
					
						<h1>Votes</h1>
						
						<div class="row">
						
							<div class="col-md-6">
							
								<h1>IN</h1>
								
								<h3 class="text-green">
								
									<span class="text-green"><?php echo $this->scope["val"]["in_votes"];?></span>
									
								</h3>
							
							</div>
							
							<div class="col-md-6">
							
								<h1>OUT</h1>
								
								<h3>
								
									<span class="text-red"><?php echo $this->scope["val"]["out_votes"];?></span>
									
								</h3>
							
							</div>
							
						</div>
						
						<br /><br />
						<h1>Server address:</h1>
						<a href="http://localhost/out/vote/<?php echo $this->scope["val"]["id"];?>"><?php echo $this->scope["val"]["url"];?></a>
					
					</div>
				
				</div>
			
			</section>
			
		</div>
		  
	</div>
	<?php 
/* -- foreach end output */
		$_fh2_glob["index"]+=1;
	}
}
 /* end template body */
return $this->buffer . ob_get_clean();
?>