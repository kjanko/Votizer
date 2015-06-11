<div class="content-module-main">
	<a href="#" class="blacklist activeBlacklist">IPs</a> 			
	<a href="#" class="blacklist" onclick="showBlacklistUsers()">Users</a> 
	<form style="display:inline-block; float:right;" id="users-mod" method="POST" onsubmit="return banIp();">
		<input style="width:10em;" type="text" id="simple-input" name="ip" class="round default-width-input" placeholder="Ip...">
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
			{foreach $blacklistIps val}
			<tr id="{$val.id}">
				<td>{$val.id}</td>
				<td>{$val.ip}</td>
				<td>
					<a href="#" class="table-actions-button ic-table-delete" onclick="removeBlacklistIps({$val.id}, {$val.ip})"></a>
				</td>
			</tr>
			{/foreach}
		</tbody>
		
	</table>

	<div class="stripe-separator"><!--  --></div>
					
</div> <!-- end content-module-main -->