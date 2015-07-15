<div id="changePasswordContainer" name="changePasswordContainer" style="margin-top:1em; display:none">
    <h3>Change password:</h3>
    <form class="form-horizontal"">
        <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-10">
                <input id="password" class="form-control password" required type="password" placeholder="Password"/>
            </div>
        </div>
        <div class="form-group">
            <label for="newPassword" class="col-sm-2 control-label">New Password:</label>
            <div class="col-sm-10">
                <input id="newPassword" class="form-control password" required type="password" placeholder="New password"/>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmPassword" class="col-sm-2 control-label">Confirm password:</label>
            <div class="col-sm-10">
                <input id="confirmPassword" class="form-control password" required type="password" placeholder="ConfirmPassword"/>
            </div>
        </div>
    </form>
    <div>
    </div>
    <button id="submitChangePass">Change Password</button>
    <div id="error-placeholder"></div>
</div>