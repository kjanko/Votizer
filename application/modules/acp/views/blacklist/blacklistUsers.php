<div class="content-module-main">
	<button class="blacklist" onclick="showBlacklistIps()">IPs</button> 		
	<button class="blacklist activeBlacklist">Users</button> 
	<form style="display:inline-block; float:right;" id="users-mod" method="POST" onsubmit="return banUser();">
		<input style="width:10em;" type="text" id="simple-input" name="user" class="round default-width-input" placeholder="Username...">
		<input type="submit" value="Add" class="round blue ic-add" />
	</form>
	<table>

		<thead>

			<tr>
				<th style="position: relative;">Id</th>
				<th>Ip</th>
				<th>Actions</th>
			</tr>
		
		</thead>
		
		<tbody id="users">
			{foreach $blacklistUsers val}
			<tr id="{$val.id}">
				<td>{$val.id}</td>
				<td>{$val.username}</td>
				<td>
					<a href="#" class="table-actions-button ic-table-delete" onclick="removeBlacklistUsers({$val.id})"></a>
				</td>
			</tr>
			{/foreach}
		</tbody>
		
	</table>

	<div class="stripe-separator"><!--  --></div>
					
</div> <!-- end content-module-main -->