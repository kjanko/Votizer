function userLogin()
{
    var form_data =
    {
        username : $('#username').val(),
        password : $('#password').val(),
        user : "true"
    };
    $.ajax(
        {
            url: 'ajax/userLogin',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '3')
                    {
                        alertify.success(json.msg);
                        setTimeout( function() {  location="home" }, 1000 );
                    }
                    else if(json.success === '2')
                    {
                        alertify.alert(json.msg);
                    }
                }
        }
    );
}
$(function(){
    $('input.login').keypress(function(e) {
        if(e.which == 13) {
            $(this).blur();
            $('.submit').focus().click();
            return false;
        }
    });
})
