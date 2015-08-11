function registerSite()
{
    var form_data =
    {
        fname : $("#name").val(),
        lname : $("#surname").val(),
        uname : $("#username").val(),
        password : $("#password").val(),
        email : $("#email").val(),
        url : $("#url").val(),
        title : $("#title").val(),
        description : $("#description").val(),
        category : $("#category").val(),
        rank : 0
    };
    if(form_data.password != $("#confirmPassword").val())
    {
        $("#password").addClass('error-input');
        $("#confirmPassword").addClass('error-input');
        return;
    }
    $.ajax(
        {
            url: '/ajax/registerSite',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alert(json.msg);
                        setTimeout( function() { location="/home" }, 500);
                    }
                    else if(json.success === '2')
                    {
                        alert(json.msg);
                    }
                }
        }
    );
    return false;
}
