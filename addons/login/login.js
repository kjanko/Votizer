$(function(){
    userLogin();
})
function userLogin()
{
    $('#login-submit').click(function()
    {
        var form_data =
        {
            username : $('#login-username').val(),
            password : $('#login-password').val(),
            user : "true"
        };

        $.ajax(
            {
                url: '/ajax/user_login',
                type: 'POST',
                data: form_data,
                success:
                    function(message)
                    {
                        var json = jQuery.parseJSON(message);

                        if(json.success === '3')
                        {
                            $('.information-box').hide()
                            $('.information-box').removeClass('error-box')
                            $('.information-box').addClass('confirmation-box').html(json.msg).show('scale');
                            setTimeout( function() {  location="/home" }, 1000 );
                        }
                        else if(json.success === '2')
                        {
                            $('#login-username').addClass('error-input');
                            $('#login-password').addClass('error-input');
                            $('.information-box').addClass('error-box').html(json.msg).show('scale');
                        }
                    }
            });

        return false;

    });
}
