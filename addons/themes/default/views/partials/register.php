<div style="padding: 0 20px 0">
    <h3>User details:</h3>
    <form class="form-horizontal" method="post" onsubmit="return registerSite()">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name:</label>
            <div class="col-sm-10">
                <input id="name" class="form-control" required type="text" placeholder="Name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="surname" class="col-sm-2 control-label">Surname:</label>
            <div class="col-sm-10">
                <input id="surname" class="form-control" required type="text" placeholder="Surname"/>
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username:</label>
            <div class="col-sm-10">
                <input id="username" class="form-control" required type="text" placeholder="Username"/>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-10">
                <input id="password" class="form-control" required type="password" placeholder="Password"/>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmPassword" class="col-sm-2 control-label">Confirm password:</label>
            <div class="col-sm-10">
                <input id="confirmPassword" class="form-control" required type="password" placeholder="ConfirmPassword"/>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-10">
                <input id="email" class="form-control" required type="text" placeholder="Email"/>
            </div>
        </div>
        <h3>Site details:</h3>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">URL:</label>
            <div class="col-sm-10">
                <input id="url" class="form-control" required type="text" placeholder="http://"/>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title:</label>
            <div class="col-sm-10">
                <input id="title" class="form-control" required type="text" placeholder="Title"/>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" rows="6" required placeholder="Description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Category:</label>
            <div class="col-sm-10">
                <select id="category" class="form-control">
                    <option selected value="1">WOW</option>
                    <option value="2">Minecraft</option>
                </select>
            </div>
        </div>
        <div>
            <input class="btn btn-primary" id="submit" style="width:100%; margin-top:10px;" type="submit" value="Add Site" />
        </div>
    </form>
</div>