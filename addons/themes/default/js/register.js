function registerSite()
{
    $("#password").removeClass('error-input');
    $("#confirmPassword").removeClass('error-input');
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
    //Check profanity
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
                        alertify.alert(json.msg);
                        setTimeout( function() { location="/home" }, 500);
                    }
                    else if(json.success === '2')
                    {
                        alertify.alert(json.msg);
                    }
                    else if(json.success === '3')
                    {
                        $('#error-placeholder').html(json.msg).show('scale');
                    }
                }
        }
    );
}
