							{foreach $top_categories val}
							<tr id="{$val.id}">
								<td>{$val.id}</td>
								<td id="{$val.id}" class="editable">{$val.category}</td>
								<td>
                                    <a class="table-actions-button ic-table-delete" onclick="removeCategory({$val.id})"></a>
								</td>
							</tr>
							{/foreach}