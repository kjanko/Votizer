function adminLogin()
{
	$('#login-submit').click(function() 
	{
		var form_data = 
		{
			username : $('#login-username').val(),
			password : $('#login-password').val()
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
					
					if(json.success === '1')
					{
						$('.information-box').addClass('confirmation-box').html(json.msg).show('scale');
						setTimeout( function() {  location="/acp/dashboard" }, 3000 );
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

function displayChart()
{
	$.ajax(
	{
		url: '/ajax/user_activity',
		type: 'POST',
		success:
			function(result)
			{ 
				var json =  jQuery.parseJSON(result);
				
				$.jqplot('chartdiv',  [[[2, 2], [5, 2], [3, 3], [1.6, 2]]],
				{ 
					axes:
					{
						yaxis:
						{
							min:1, 
							max:json.result
						},
						xaxis:
						{
							min:1,
							max:5
						}
					}
				});
			}
	});
}

function showEditUser(username)
{
	$.get('/acp/dashboard/users_edit/' + username, function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}

function showAddUser()
{
	$.get('/acp/dashboard/users_add/', function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}

function editUser()
{
	var form_data = 
	{
		id : $("input[name='id']").val(),
		uname : $("input[name='uname']").val(),
		fname : $("input[name='fname']").val(),
		lname : $("input[name='lname']").val(),
		email : $("input[name='email']").val(),
		rank : $("input[name='rank']").val()
	};
	
	$.ajax(
	{
		url: '/ajax/edit_user',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/users" }, 500);
				}
				else if(json.success === '2')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/users" }, 500);
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

function addUser()
{
	var form_data = 
	{
		uname : $("input[name='uname']").val(),
		fname : $("input[name='fname']").val(),
		lname : $("input[name='lname']").val(),
		email : $("input[name='email']").val(),
		password : $("input[name='password']").val(),
		rank : $("input[name='rank']").val()
	};
	
	$.ajax(
	{
		url: '/ajax/add_user',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/users" }, 500);
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

function removeUser(username)
{
	var form_data = 
	{
		uname : username
	}
	
	$.ajax(
	{
		url: '/ajax/remove_user',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					$('#' + username).hide('slow', function(){ $(this).remove(); });
				}
				else if(json.success === '2')
				{
					alert(json.msg);
				}
			}
	});	
	return false;
}