$(document).ready(function() 
{
	$("#success_message").hide();
	
    $('#contact_form').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
			subject: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please insert a subject'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please enter a message'
					}
				}
			}
		}
	})
	.on('success.form.bv', function(e)
	{
		// Prevent form submission
		e.preventDefault();
				
		// Get the form instance
		var $form = $(e.target);
		
		// Use Ajax to submit form data
		$.ajax({
                url: '/contact/mail',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) 
				{
					$('#contact_form')[0].reset();
					$("#success_message").show();
                    $('#success_message').slideDown({ opacity: "show" }, "slow");
				}
		});
	});
});