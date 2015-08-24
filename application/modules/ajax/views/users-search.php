							{foreach $top_users val}
							<tr id="{$val.username}">
								<td>{$val.id}</td>
								<td>{$val.name} {$val.l_name}</td>
								<td>{$val.username}</td>
								<td>{$val.rank}</td>
								<td><a href="#">{$val.email}</a></td>
								<td>
									<a href="#" class="table-actions-button ic-table-edit" onclick="showEditUser('{$val.username}','users')"></a>
									<a href="#" class="table-actions-button ic-table-delete" onclick="removeUser('{$val.username}')"></a>
								</td>
							</tr>
							{/foreach}