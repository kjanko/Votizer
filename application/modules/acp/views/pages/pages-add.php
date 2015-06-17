			<div class="content-module-main">
				<form id="pages-mod" method="POST" onsubmit="return addPage();">
					<p><a href="/acp/dashboard/{$backUrl}" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;">Back</a></p>
					<p>
						<label for="full-width-input">Title</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="title" value="" />
						<em>The title of your page. This field is required.</em>
					</p>
					<p>
						<label for="full-width-input">URL</label>
						<input id="full-width-input" class="round full-width-input" type="text" name="url" value="" />
						<em>The keyword link of your page. Example: /pages/<b>keyword</b></em>
					</p>
					
					<p>
						<label for="full-width-input">Content</label>
						<textarea id="tinymce" name="content" style="width:100%"></textarea>
						<a href="javascript:setup();">Load text editor</a>						
						<em>This field is required.</em>
					</p>
					
					<br/><div class="information-box round">Valid informations required.</div>
					<div id="error-placeholder"></div>
					
					<br /><input type="submit" value="submit" name="submit" class="round blue ic-right-arrow" />
				</form>
			</div> <!-- end content-module-main -->