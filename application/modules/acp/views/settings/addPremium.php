<div class="content-module-main">
    <form id="pages-mod" method="POST" onsubmit="return addPremium();">
        <p><a href="/acp/dashboard/{$backUrl}" style="position: relative; border-bottom: 1px dotted; font-size: 11px; bottom: 3px;">Back</a></p>
        <p>
            <label for="full-width-input">ID</label>
            <input class="round full-width-input" type="text" readonly="readonly" name="id" value="{$id}" />
            <em>Sites's ID as it appears in the database.</em>
        </p>
        <p>
            <label for="full-width-input">Username</label>
            <input class="round full-width-input" type="text" readonly="readonly" name="username" value="{$username}" />
            <em>The username of the site author.</em>
        </p>
        <p>
            <label for="full-width-input">Title</label>
            <input  class="round full-width-input" type="text" readonly="readonly" name="title" value="{$title}" />
            <em>The title of the site.</em>
        </p>
        <p>
            <label for="full-width-input">End date of premium membership</label>
            <input class="round full-width-input" type="text" id="datepicker" name="title" />
            <em>This field is required.</em>
        </p>

        <br/><div class="information-box round">Valid informations required.</div>
        <div id="error-placeholder"></div>

        <br /><input type="submit" value="submit" name="submit" class="round blue ic-right-arrow" />
    </form>
</div> <!-- end content-module-main -->
<script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat : "yy-mm-dd",
            minDate: 0
        })
        $( "#datepicker" ).datepicker( "setDate", "{$date}" );
    });
</script>
