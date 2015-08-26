var base_url = '<?php echo base_url();?>';
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
    $('input.ucp').keypress(function(e) {
        if(e.which == 13) {
            $(this).blur();
            $(this).parent().parent().siblings('.submit').focus().click();
            return false;
        }
    });
});
function editUserDetails(){
    var form_data =
    {
        fname : $("#name").val(),
        lname : $("#surname").val(),
        email : $("#email").val()
    };
    $.ajax(
        {
            url: base_url + '/ajax/editUserDetails',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alertify.success(json.msg);
                    }
                    else if(json.success === '2')
                    {
                        alertify.alert(json.msg);
                    }
                }
        }
    );
    return false;
}
function editSiteDetails()
{
    var form_data =
    {
        url : $("#url").val(),
        title : $("#title").val(),
        description : $("#description").val(),
        category : $("#category").val()
    };
    $.ajax(
        {
            url: base_url + '/ajax/editSiteDetails',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alertify.success(json.msg);
                    }
                    else if(json.success === '2')
                    {
                        alertify.alert(json.msg);
                    }
                }
        }
    );
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
        alertify.alert("Password and confirm password field do not match.")
        return;
    }
    $("#newPassword").removeClass('error-input');
    $("#confirmPassword").removeClass('error-input');

    $.ajax(
        {
            url: base_url + '/ajax/changePassword',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alertify.success(json.msg);
                        setTimeout( function() { location="/ucp" }, 750);
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
    return false;
}