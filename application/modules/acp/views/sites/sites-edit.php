<form id="users-mod" method="POST" onsubmit="return editSite();">
    <p><a href="/acp/dashboard/sites" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;">Back</a></p>
    {foreach $id val}
    <p>
        <label for="full-width-input">ID</label>
        <input id="full-width-input" class="round full-width-input" type="text" readonly="readonly" name="id" value="{$val.id}" />
        <em>User's ID as it appears in the database.</em>
    </p>
    <p>
        <label for="full-width-input">Username</label>
        <input id="full-width-input" class="round full-width-input" type="text" readonly="readonly" name="uname" value="{$val.username}" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Category</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="categoryId" value="{$val.category_id}" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Title</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="title" value="{$val.title}"  />
        <em>This field is required. Must contain at least 7 characters.</em>
    </p>
    <p>
        <label for="full-width-input">In votes</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="inVotes" value="{$val.in_votes}" />
        <em>This field is required. Insert a valid e-mail.</em>
    </p>
    <p>
        <label for="full-width-input">Out votes</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="outVotes" value="{$val.out_votes}" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Description</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="description" value="{$val.description}" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Banner</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="bannerUrl" value="{$val.banner_url}" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Url</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="url" value="{$val.url}" />
        <em>This field is required.</em>
    </p>
    {/foreach}

    <br/><div class="information-box round">Valid informations required.</div>
    <div id="error-placeholder"></div>

    <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
</form>