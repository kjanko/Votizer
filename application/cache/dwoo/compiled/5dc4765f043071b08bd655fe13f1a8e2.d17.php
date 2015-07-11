<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><button class="blacklist" onclick="showBlacklistIps()">IPs</button>
<button class="blacklist activeBlacklist">Users</button>
<button class="blacklist" onclick="showBlacklistProfanity()">Profanity</button>
<button class="blacklist" onclick="showBlacklistUrls()">URLs</button>
<form style="display:inline-block; float:right;" id="users-mod" method="POST" onsubmit="return banUser();">
    <input style="width:10em;" type="text" id="simple-input" name="user" class="round default-width-input" placeholder="Username...">
    <input type="submit" value="Add" class="round blue ic-add" />
</form>
<table>

    <thead>

        <tr>
            <th style="position: relative;">Id</th>
            <th>Users</th>
            <th>Actions</th>
        </tr>

    </thead>

    <tbody id="users">
        <?php 
$_fh0_data = (isset($this->scope["blacklistUsers"]) ? $this->scope["blacklistUsers"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['val'])
	{
/* -- foreach start output */
?>
        <tr id="<?php echo $this->scope["val"]["id"];?>">
            <td><?php echo $this->scope["val"]["id"];?></td>
            <td><a href="#" onclick="showEditUser('<?php echo $this->scope["val"]["username"];?>','blacklist')"><?php echo $this->scope["val"]["username"];?></td>
            <td>
                <a href="#" class="table-actions-button ic-table-delete" onclick="removeBlacklistUsers(<?php echo $this->scope["val"]["id"];?>)"></a>
            </td>
        </tr>
        <?php 
/* -- foreach end output */
	}
}?>

    </tbody>

</table>

<div class="stripe-separator"><!--  --></div>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>