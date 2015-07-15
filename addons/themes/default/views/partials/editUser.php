<h3>User details:</h3>
<form class="form-horizontal" method="post" onsubmit="return editSite()">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username:</label>
        <div class="col-sm-10">
            <input id="username" class="form-control" required type="text" placeholder="Username" readonly value="{$user.username}"/>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-10">
            <input id="name" class="form-control" required type="text" placeholder="Name" value="{$user.name}"/>
        </div>
    </div>
    <div class="form-group">
        <label for="surname" class="col-sm-2 control-label">Surname:</label>
        <div class="col-sm-10">
            <input id="surname" class="form-control" required type="text" placeholder="Surname" value="{$user.surname}"/>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Email:</label>
        <div class="col-sm-10">
            <input id="email" class="form-control" required type="text" placeholder="Email" value="{$user.email}"/>
        </div>
    </div>
    <a href="#changePasswordContainer" id="changePass">Change Password</a>