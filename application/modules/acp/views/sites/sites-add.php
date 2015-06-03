			<div class="content-module-main">
				<form id="users-mod" method="POST" onsubmit="return addSite();">
					<p><a href="/acp/dashboard/sites" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;">Back</a></p>
					<p>
						<label for="full-width-input">USER ID</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="uid" />
						<em>User's ID as it appears in the database.</em>
					</p>
					<p>
						<label for="full-width-input">Heading</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="heading" />
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">Description</label>
						<textarea id="full-width-input" class="round full-width-input" type="text" name="description"></textarea>
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">In Votes</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="in_votes" />
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">Out Votes</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="out_votes" />
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">Banner</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="banner" />
						<em>This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">URL</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="url" />
						<em>This field is required.</em>
					</p>
					
					<br/><div class="information-box round">Provide valid informations.</div>
					<div id="error-placeholder"></div>
					
					<br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
				</form>
			</div> <!-- end content-module-main -->