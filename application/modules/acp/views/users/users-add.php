			<div class="content-module-main">
				<form id="users-mod" method="POST" onsubmit="return addUser();">
					<p><a href="/acp/dashboard/users" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;">Back</a></p>
					<p class="first-name">
						<label for="full-width-input">First Name</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="fname" value="" />
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">Last Name</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="lname" value="" />
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">Username</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="uname" value=""  />
						<em>This field is required. Must contain at least 5 characters.</em>
					</p>
					<p>
						<label for="full-width-input">E-Mail</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="email" value="" />
						<em>This field is required. Insert a valid e-mail.</em>
					</p>
					<p>
						<label for="full-width-input">Password</label>
						<input id="full-width-input" class="round full-width-input" type="password" name="password" value="" />
						<em>The password is not case sensitive! Must contain at least 7 characters.</em>
					</p>
					<p>
						<label for="full-width-input">Rank</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="rank" value="0" />
						<em>This field is not required. Default: 0;</em>
					</p>
					
					<br/><div class="information-box round">Valid informations required.</div>
					<div id="error-placeholder"></div>
					
					<br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
				</form>
			</div> <!-- end content-module-main -->