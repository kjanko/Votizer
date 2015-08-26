var base_url = '<?php echo base_url();?>'
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
        category : $("#category").val()
    };
	
    if(form_data.password != $("#confirmPassword").val())
    {
        $("#password").addClass('error-input');
        $("#confirmPassword").addClass('error-input');
        return;
    }

    $.ajax(
        {
            url: base_url + '/ajax/registerSite',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alertify.success(json.msg);
                        setTimeout( function() { location="/login" }, 1000);
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

$(function(){
    $('input.register').keypress(function(e) {
        if(e.which == 13) {
            $(this).blur();
            $(this).parent().parent().siblings('.submit').focus().click();
            return false;
        }
    });
})
