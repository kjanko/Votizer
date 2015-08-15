<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="panel panel-default">
	 
	<div class="panel-heading">Register</div>
	
	<div class="panel-body" style="padding: 0 20px 20px">

		<h3>User details:</h3>
		
		<div class="form-horizontal">
		
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name:</label>
				<div class="col-sm-10">
					<input id="name" class="form-control" required type="text" placeholder="Name"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="surname" class="col-sm-2 control-label">Surname:</label>
				<div class="col-sm-10">
					<input id="surname" class="form-control" required type="text" placeholder="Surname"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Username:</label>
				<div class="col-sm-10">
					<input id="username" class="form-control" required type="text" placeholder="Username"/>
				</div>
			</div>

			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Password:</label>
				<div class="col-sm-10">
					<input id="password" class="form-control" required type="password" placeholder="Password"/>
				</div>
			</div>

			<div class="form-group">
				<label for="confirmPassword" class="col-sm-2 control-label">Confirm password:</label>
				<div class="col-sm-10">
					<input id="confirmPassword" class="form-control" required type="password" placeholder="Confirm password"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email:</label>
				<div class="col-sm-10">
					<input id="email" class="form-control" required type="text" placeholder="Email"/>
				</div>
			</div>
			
			<h3>Site details:</h3>
			
			<div class="form-group">
				<label for="url" class="col-sm-2 control-label">URL:</label>
				<div class="col-sm-10">
					<input id="url" class="form-control" required type="text" placeholder="http://"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Title:</label>
				<div class="col-sm-10">
					<input id="title" class="form-control" required type="text" placeholder="Title"/>
				</div>
			</div>
			
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">Description:</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="description" rows="6" required placeholder="Description"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="category" class="col-sm-2 control-label">Category:</label>
				<div class="col-sm-10">
					<select id="category" class="form-control">
						<option selected value="1">WOW</option>
						<option value="2">Minecraft</option>
					</select>
				</div>
			</div>
			
			<div>
			    <button class="btn btn-primary pull-right" id="submit" onclick="registerSite()">Add Site</button>
			</div>

            <div id="error-placeholder"></div>
			
		</div>
		
	</div>
	
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>