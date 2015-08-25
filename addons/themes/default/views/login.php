<div class="panel panel-default">
	 
	<div class="panel-heading">Login</div>
	
	<div class="panel-body" style="padding: 20px 20px 0">
		
		<div class="form-horizontal">
		
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label login">Username:</label>
				<div class="col-sm-10">
					<input class="form-control login" id="username" required type="text" placeholder="Name"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="surname" class="col-sm-2 control-label">Password:</label>
				<div class="col-sm-10">
					<input class="form-control login" id="password" required type="password" placeholder="Password"/>
				</div>
			</div>

			<div>
                <a class="col-sm-10" style="font-size:13px;line-height: 30px; vertical-align: middle" href="forgot">Forgot password?</a>
				<button class="btn btn-primary pull-right submit" style="margin-bottom:10px; " type="submit" onclick="userLogin()">Log in</button>
			</div>
			
		</div>
		
	</div>
	
</div>