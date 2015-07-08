<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>							<?php 
$_fh0_data = (isset($this->scope["users"]) ? $this->scope["users"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
							<tr id="<?php echo $this->scope["val"]["username"];?>">
								<td><?php echo $this->scope["val"]["id"];?></td>
								<td><?php echo $this->scope["val"]["name"];?> <?php echo $this->scope["val"]["l_name"];?></td>
								<td><?php echo $this->scope["val"]["username"];?></td>
								<td><?php echo $this->scope["val"]["rank"];?></td>
								<td><a href="#"><?php echo $this->scope["val"]["email"];?></a></td>
								<td>
									<a href="#" class="table-actions-button ic-table-edit" onclick="showEditUser('<?php echo $this->scope["val"]["username"];?>','users')"></a>
									<a href="#" class="table-actions-button ic-table-delete" onclick="removeUser('<?php echo $this->scope["val"]["username"];?>')"></a>
								</td>
							</tr>
							<?php 
/* -- foreach end output */
	}
}
 /* end template body */
return $this->buffer . ob_get_clean();
?>