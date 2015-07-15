<h3>Site details:</h3>
<div class="form-group">
    <label for="url" class="col-sm-2 control-label">URL:</label>
    <div class="col-sm-10">
        <input id="url" class="form-control" required type="text" value="{$site.url}" placeholder="http://"/>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Title:</label>
    <div class="col-sm-10">
        <input id="title" class="form-control" required type="text" value="{$site.title}" placeholder="Title"/>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description:</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="description" rows="6" required placeholder="Description">{$site.description}</textarea>
    </div>
</div>
<div class="form-group">
    <label for="category" class="col-sm-2 control-label">Category:</label>
    <div class="col-sm-10">
        <select id="category" class="form-control">
            <option
                {if $site.category== 1}
                    selected
                {/if}   value="1">WOW</option>
            <option
                {if $site.category== 2}
                    selected
                {/if} value="2">Minecraft</option>
        </select>
    </div>
</div>
<div>
    <input class="btn btn-primary" id="submit" style="width:100%; margin-top:10px;" type="submit" value="Edit Site" />
</div>
</form>