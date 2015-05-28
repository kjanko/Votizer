		<div id="left_sidebar" align="left">
			<div class="categories">
				<div class="left_sidebar_title">» CATEGORIES</div>
				<ul class="categories_">
					{foreach $categories val}
					<li><a href="#">» {$val.title}</a></li>
					{/foreach}
				</ul>
			</div>
		</div>