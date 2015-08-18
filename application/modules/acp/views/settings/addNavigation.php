<form id="users-mod" method="POST" onsubmit="return addNavigation();">
    <p><a href="/acp/dashboard/navigation" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;">Back</a></p>
    <p class="first-name">
        <label for="full-width-input">Link Name</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="name" value="" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Link URL</label>
        <input id="full-width-input" class="round full-width-input" type="text" name="url" value="" />
        <em>This field is required.</em>
    </p>
    <p>
        <label for="full-width-input">Permissions</label>
        <select name="permission" class="form-control">
            <option value="0">Everyone can access it</option>
            <option value="1">Only guests can access it</option>
            <option value="2">Only logged in users can access it</option>
            <option value="3">Only admins can access it</option>
        </select>
        <em>This field is required. Enter a vavlid number</em>
    </p>


    <br/><div class="information-box round">Valid informations required.</div>
    <div id="error-placeholder"></div>

    <br /><input type="submit" value="submit" class="round blue ic-right-arrow" />
</form>