							{foreach $top_sites val}
							<tr id="{$val.id}">
								<td>{$val.id}</td>
								<td><a href="#" onclick="showEditUser('{getUsername($val.user_id)}','sites')">{getUsername($val.user_id)}</td>
								<td>{$val.title}</td>
								<td>{$val.category_id}</td>
								<td>{$val.in_votes}</td>
								<td>{$val.out_votes}</td>
								<td id="{$val.id}" class="premium">
									{if $val.premium == 1}
										True
									{else}
										False
									{/if}
								</td>
								<td>
									<a class="table-actions-button ic-table-edit" onclick="showEditSite({$val.id})"></a>
									<a class="table-actions-button ic-table-delete" onclick="removeSite({$val.id})"></a>
								</td>
							</tr>
							{/foreach}