<button class="blacklist" onclick="showBlacklistIps()">IPs</button>
<button class="blacklist" onclick="showBlacklistUsers()">Users</button>
<button class="blacklist" onclick="showBlacklistProfanity()">Profanity</button>
<button class="blacklist activeBlacklist">URLs</button>
<form style="display:inline-block; float:right;" id="users-mod" method="POST" onsubmit="return banUrl();">
    <input style="width:10em;" type="text" id="simple-input" name="url" class="round default-width-input" placeholder="Url...">
    <input type="submit" value="Add" class="round blue ic-add" />
</form>
<table>

    <thead>

        <tr>
            <th style="position: relative;">Id</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>

    </thead>

    <tbody id="users">
        {foreach $blacklistUrls val}
        <tr id="{$val.id}">
            <td>{$val.id}</td>
            <td>{$val.url}</td>
            <td>
                <a href="#" class="table-actions-button ic-table-delete" onclick="removeBlacklistUrls({$val.id})"></a>
            </td>
        </tr>
        {/foreach}
    </tbody>

</table>

<div class="stripe-separator"><!--  --></div>
