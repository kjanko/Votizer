<div class="panel panel-default">
	 
	<div class="panel-heading">Forgot Password</div>
	
	<div class="panel-body" style="padding: 20px 20px 0">
		
		<div class="form-horizontal">
		
			<form action="<?php echo base_url(); ?>forgot/resetPW" method="POST">
			
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username:</label>
					<div class="col-sm-10">
						<input class="form-control" id="username" required type="text" placeholder="Name" name="username" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email:</label>
					<div class="col-sm-10">
						<input class="form-control" id="email" required type="text" placeholder="E-Mail" name="email" />
					</div>
				</div>
				
				<div>
				
					<button class="btn btn-primary pull-right" id="submit" style="margin-bottom:10px; " type="submit" onclick="userLogin()">Submit</button>
					
				</div>
				
			</form>
			
		</div>
		
	</div>
	
</div>