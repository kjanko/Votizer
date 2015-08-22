<button class="blacklist" onclick="showBlacklistIps()">IPs</button>
<button class="blacklist" onclick="showBlacklistUsers()">Users</button>
<button class="blacklist activeBlacklist">Profanity</button>
<button class="blacklist" onclick="showBlacklistUrls()">URLs</button>
<form style="display:inline-block; float:right;" id="users-mod" method="POST" onsubmit="return banProfanity();">
    <input style="width:10em;" type="text" id="simple-input" name="word" class="round default-width-input" placeholder="Word...">
    <input type="submit" value="Add" class="round blue ic-add" />
</form>
<table>

    <thead>

        <tr>
            <th style="position: relative;">Id</th>
            <th>Word</th>
            <th>Actions</th>
        </tr>

    </thead>

    <tbody id="items">
        {foreach $blacklistProfanity val}
        <tr id="{$val.id}">
            <td>{$val.id}</td>
            <td>{$val.word}</td>
            <td>
                <a class="table-actions-button ic-table-delete" onclick="removeBlacklistProfanity({$val.id})"></a>
            </td>
        </tr>
        {/foreach}
    </tbody>

</table>

<div class="stripe-separator"><!--  --></div>
<script>
    $(function(){
        $("#items").jPaginate();
    });
</script>
