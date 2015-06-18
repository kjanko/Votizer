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

function showEditUser(username, backUrl)
{
	$.get('/acp/dashboard/users_edit/' + username + '/' + backUrl , function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}

function showEditPage(id, backUrl)
{
	$.get('/acp/dashboard/pages_edit/' + id + '/' + backUrl , function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}

function showAddPage(backUrl)
{
	$.get('/acp/dashboard/pages_add/' + backUrl , function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}

function showBlacklistIps()
{
	$.get('/acp/dashboard/blacklistIps/', function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}
function showBlacklistUsers()
{
	$.get('/acp/dashboard/blacklistUsers/', function(data) 
	{
		$('.content-module-main').html(data).show('scale');
	});
}
function showBlacklistProfanity()
{
    $.get('/acp/dashboard/blacklistProfanity/', function(data)
    {
        $('.content-module-main').html(data).show('scale');
    });
}
function showEditSite(id)
{
	$.get('/acp/dashboard/sites_edit/' + id, function(data) 
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

function editPage()
{
	var form_data = 
	{
		id : $("input[name='id']").val(),
		title : $("input[name='title']").val(),
		url : $("input[name='url']").val(),
		content : tinyMCE.activeEditor.getContent()
	};
	
	$.ajax(
	{
		url: '/ajax/editPage',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/pages" }, 500);
				}
				else if(json.success === '2')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/pages" }, 500);
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

function removePage(id)
{
	var form_data = 
	{
		postID : id
	};
	
	$.ajax(
	{
		url: '/ajax/removePage',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					$('#' + id).hide('slow', function(){ $(this).remove(); });
				}
				else if(json.success === '2')
				{
					alert(json.msg);
				}
			}
	});	
	return false;
}

function addPage()
{
	var form_data = 
	{
		title : $("input[name='title']").val(),
		url : $("input[name='url']").val(),
		content : tinyMCE.activeEditor.getContent()
	};
	
	$.ajax(
	{
		url: '/ajax/addPage',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/pages" }, 500);
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

function editSite()
{
	var form_data = 
	{
		id : $("input[name='id']").val(),
		categoryId : $("input[name='categoryId']").val(),
		title : $("input[name='title']").val(),
		description : $("input[name='description']").val(),
		inVotes : $("input[name='inVotes']").val(),
		outVotes : $("input[name='outVotes']").val(),
		bannerUrl : $("input[name='bannerUrl']").val(),
		premium : $("input[name='premium']").val(),
		url : $("input[name='url']").val()
	};
	
	$.ajax(
	{
		url: '/ajax/edit_site',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/sites" }, 500);
				}
				else if(json.success === '2')
				{
					alert(json.msg);
					setTimeout( function() { location="/acp/dashboard/sites" }, 500);
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
		url: '/ajax/removeUser',
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
function removeSite(siteId)
{
	var form_data = 
	{
		id : siteId
	}
	
	$.ajax(
	{
		url: '/ajax/remove_site',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					$('#' + siteId).hide('slow', function(){ $(this).remove(); });
				}
				else if(json.success === '2')
				{
					alert(json.msg);
				}
			}
	});	
	return false;
}

function banUser() {
    var form_data =
    {
        uname: $("input[name='user']").val()
    };

    $.ajax(
        {
            url: '/ajax/banUser',
            type: 'POST',
            data: form_data,
            success: function (message) {
                var json = jQuery.parseJSON(message);

                if (json.success === '1') {
                    alert(json.msg);
                    setTimeout(function () {
                        showBlacklistUsers()
                    }, 500);
                }
                else if (json.success === '2') {
                    alert(json.msg);
                }
            }
        }
    );
    return false;
}

function banProfanity()
{
    var form_data =
    {
        word : $("input[name='word']").val(),
        replacement : $("input[name='replacement']").val()
    };

    $.ajax(
        {
            url: '/ajax/banProfanity',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        alert(json.msg);
                        setTimeout( function() { showBlacklistProfanity() }, 500);
                    }
                    else if(json.success === '2')
                    {
                        alert(json.msg);
                    }
                    else if(json.success === '3')
                    {
                        alert("The word and replacement word fields are required");

                    }
                }
        });
    return false;
}

function banIp()
{
	var form_data = 
	{
		ip : $("input[name='ip']").val()
	};
	
	$.ajax(
	{
		url: '/ajax/banIp',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					alert(json.msg);
					setTimeout( function() { showBlacklistIps() }, 500);
				}
				else if(json.success === '2')
				{
					alert(json.msg);
				}
				else if(json.success === '3')
				{
					alert("Invalid IP");
				}
			}
	});	
	return false;
}

function removeBlacklistIps(id, ip)
{
	var form_data = 
	{
		postIP : ip
	}
	
	$.ajax(
	{
		url: '/ajax/removeBlacklistIp',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					$('#' + id).hide('slow', function(){ $(this).remove(); });
				}
				else if(json.success === '2')
				{
					alert(json.msg);
				}
			}
	});	
	return false;
}
function removeBlacklistProfanity(id)
{
    var form_data =
    {
        postID : id
    }

    $.ajax(
        {
            url: '/ajax/removeBlacklistProfanity',
            type: 'POST',
            data: form_data,
            success:
                function(message)
                {
                    var json = jQuery.parseJSON(message);

                    if(json.success === '1')
                    {
                        $('#' + id).hide('slow', function(){ $(this).remove(); });
                    }
                    else if(json.success === '2')
                    {
                        alert(json.msg);
                    }
                }
        });
    return false;
}
function removeBlacklistUsers(IpId)
{
	var form_data = 
	{
		id : IpId
	}
	
	$.ajax(
	{
		url: '/ajax/removeBlacklistUsers',
		type: 'POST',
		data: form_data,
		success: 
			function(message) 
			{ 
				var json = jQuery.parseJSON(message);
				
				if(json.success === '1')
				{
					$('#' + IpId).hide('slow', function(){ $(this).remove(); });
				}
				else if(json.success === '2')
				{
					alert(json.msg);
				}
			}
	});	
	return false;
}