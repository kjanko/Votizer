<div class="panel panel-default">
	 
	<div class="panel-heading">User Control Panel</div>
	
	<div class="panel-body" style="padding: 0 20px 0">

		<h6 style="margin-left: 15px">Your premium subscription expires: <strong>{$expiration_date}</strong></h6>
	
		<div class="container-fluid">
			{foreach $servers val}
			<section class="box wow animated fadeIn">
				
				<h1>#{getSiteRank($val.id)}</h1>
				
				<div class="row">
					
					
					<div class="col-md-2 text-center">
					
						<h1>Rank</h1>
						<h2>{getSiteRank($val.id)}</h2>
						
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
			{/foreach}
			<br />
			
			{if $winnerBid}
			<a href="<?php echo base_url(); ?>auction/pay">
				<div class="alert alert-success" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Congratulations:</span>
					You won the sponsored auction! To finish the procedure, you need to pay <strong>{$winnerBid}</strong> credits. If you are ready, click this notification.
				</div>
			</a>
			{/if}
			
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#menu3">User Details</a></li>
				<li><a data-toggle="tab" href="#menu2">Site Details</a></li>
				<li><a data-toggle="tab" href="#home">Edit Password</a></li>
			</ul>

			<div class="tab-content">
			
				<div id="home" class="tab-pane fade">
				
					<div id="changePasswordContainer" name="changePasswordContainer" style="margin-top:1em;">
					
						<h3>Change password:</h3>
						
						<div class="form-horizontal">
						
							<div class="form-group">
								<label for="Password" class="col-sm-2 control-label">Password:</label>
								<div class="col-sm-10">
									<input id="password" class="form-control password" required type="password" placeholder="Password"/>
								</div>
							</div>
							
							<div class="form-group">
								<label for="newPassword" class="col-sm-2 control-label">New Password:</label>
								<div class="col-sm-10">
									<input id="newPassword" class="form-control password" required type="password" placeholder="New password"/>
								</div>
							</div>
							
							<div class="form-group">
								<label for="confirmPassword" class="col-sm-2 control-label">Confirm password:</label>
								<div class="col-sm-10">
									<input id="confirmPassword" class="form-control password" required type="password" placeholder="ConfirmPassword"/>
								</div>
							</div>

                            <button class="btn btn-primary pull-right submit" style="margin-bottom:10px;" onclick="changePassword()">Change</button>

						</div>
						
						<div id="error-placeholder"></div>
						
					</div>	
					
				</div>
				
				<div id="menu2" class="tab-pane fade">
				
					<h3>Site details:</h3>
					<div class="form-horizontal">
					
						<div class="form-group">
							<label for="url" class="col-sm-2 control-label">URL:</label>
							<div class="col-sm-10">
								<input id="url" class="form-control" required type="text" value="{$site.url}" placeholder="http://"/>
							</div>
						</div>
						
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Title:</label>
							<div class="col-sm-10">
								<input id="title" class="form-control" required type="text" value="{$site.title}" placeholder="Title"/>
							</div>
						</div>
						
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label">Description:</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="description" rows="6" required placeholder="Description">{$site.description}</textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label for="category" class="col-sm-2 control-label">Category:</label>
							<div class="col-sm-10">
								<select id="category" class="form-control">
									<option selected value="{$currentCategory.id}">{$currentCategory.name}</option>
									{foreach $categories key, val, name='default'}
										{if $val.id != $currentCategory.id}
											<option value="{$val.id}">{$val.category}</option>
										{/if}
									{/foreach}
								</select>
							</div>
						</div>

                        <button class="btn btn-primary pull-right submit" style="margin-bottom:10px;" onclick="editSiteDetails()">Change</button>
						
					</div>
					
				</div>
				
				<div id="menu3" class="tab-pane fade in active">
				
					<h3>User details:</h3>
			
					<div class="form-horizontal">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username:</label>
                            <div class="col-sm-10">
                                <input id="username" class="form-control" required type="text" placeholder="Username" readonly value="{$user.username}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name:</label>
                            <div class="col-sm-10">
                                <input id="name" class="form-control" required type="text" placeholder="Name" value="{$user.name}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="surname" class="col-sm-2 control-label">Surname:</label>
                            <div class="col-sm-10">
                                <input id="surname" class="form-control" required type="text" placeholder="Surname" value="{$user.surname}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-10">
                                <input id="email" class="form-control" required type="text" placeholder="Email" value="{$user.email}"/>
                            </div>
                        </div>

                        <button class="btn btn-primary pull-right submit" style="margin-bottom:10px;" onclick="editUserDetails()">Change</button>

                    </div>
						
				</div>
				
			</div>
			
		</div>


	</div>
	
</div>