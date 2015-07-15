$(function(){
    $("#changePass").click(function(){
        $("#changePasswordContainer").show();
        $('html, body').animate({
            scrollTop: $("#changePasswordContainer").offset().top
        }, 1500);
    })
    $("#submitChangePass").click(function(){
        changePassword();
    });
    $(".password").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            changePassword();
        }
    });
});
function editSite()
{
    var form_data =
    {
        fname : $("#name").val(),
        lname : $("#surname").val(),
        email : $("#email").val(),
        url : $("#url").val(),
        title : $("#title").val(),
        description : $("#description").val(),
        category : $("#category").val()
    };
    $.ajax(
        {
            url: '/ajax/editSite',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alert(json.msg);
                    }
                    else if(json.success === '2')
                    {
                        alert(json.msg);
                    }
                    else if(json.success === '3')
                    {
                        $('.information-box').remove();
                        $('#error-placeholder').html(json.msg).show('scale');
                    }
                }
        });
    return false;
}
function changePassword(){
    var form_data =
    {
        password : $("#password").val(),
        newPassword : $("#newPassword").val()
    };
    if(form_data.newPassword != $("#confirmPassword").val())
    {
        $("#newPassword").addClass('error-input');
        $("#confirmPassword").addClass('error-input');
        return;
    }
    $("#newPassword").removeClass('error-input');
    $("#confirmPassword").removeClass('error-input');

    $.ajax(
        {
            url: '/ajax/changePassword',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alert(json.msg);
                        //setTimeout( function() { location="/acp/dashboard/sites" }, 500);
                    }
                    else if(json.success === '2')
                    {
                        alert(json.msg);
                        //setTimeout( function() { location="/acp/dashboard/sites" }, 500);
                    }
                    else if(json.success === '3')
                    {
                        $('#error-placeholder').html(json.msg).show('scale');
                    }
                }
        }
    );
    return false;
}