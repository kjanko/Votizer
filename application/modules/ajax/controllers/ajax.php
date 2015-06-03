<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// AJAX Controller

class Ajax extends MX_Controller 
{

    public function __construct()
    {
        parent::__construct();
		
		$this->load->library('form_validation');
		
		/*if(!$this->input->is_ajax_request())
		{
			show_404();
		}*/
    }
	function index()
	{
		show_error('Access denied!');
	}

	function user_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($this->users->login($username, $password))
		{
			if($this->users->get_user_rank($username) >= 2)
			{
				$data = array(
					'success' => '1',
					'msg' => 'Success! Please wait while we redirect you...'
				);
				
				echo json_encode($data);
			}
			else
			{
				$data = array(
					'success' => '2',
					'msg' => 'Access denied.'
				);
				
				echo json_encode($data);
			}
		}
		else
		{
			$data = array(
				'success' => '2',
				'msg' => 'Incorrect credentials.'
			);
			
			echo json_encode($data);
		}
	}
	
	function user_activity()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$data = array(
				'result' => $this->users->get_total_user_count(),
				'session' => $this->users->get_total_users_online()
			);
			
			echo json_encode($data);
		}
	}
	
	function edit_user()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
			$this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
			$this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|alpha_dash');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
			$this->form_validation->set_rules('rank', 'Rank', 'required|is_natural');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data = array(
					'success' => '3', 
					'msg' => validation_errors()
				);
				
				echo json_encode($data);
			}
			else
			{
				$id = $this->input->post('id');
				$uname = $this->input->post('uname');
				$fname = $this->input->post('fname');
				$lname = $this->input->post('lname');
				$email = $this->input->post('email');
				$rank = $this->input->post('rank');
				
				if($this->users->update($id, $uname, $fname, $lname, $email, $rank))
				{
					$data = array(
						'success' => '1',
						'msg' => 'Success! Please wait while you are being redirected.'
					);
					
					echo json_encode($data);
				}
				else
				{
					$data = array(
						'success' => '2',
						'msg' => 'Error! Something went wrong while editing this user!'
					);
					
					echo json_encode($data);
				}
			}
		}
	}
	
	function add_user()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{			
			$this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
			$this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
			$this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|alpha_dash');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
			$this->form_validation->set_rules('rank', 'Rank', 'required|is_natural');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data = array(
					'success' => '3', 
					'msg' => validation_errors()
				);
				
				echo json_encode($data);
			}
			else
			{
				$uname = $this->input->post('uname');
				$fname = $this->input->post('fname');
				$lname = $this->input->post('lname');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$rank = $this->input->post('rank');
				
				if($this->users->create($fname, $lname, $uname, $password, $email, $rank))
				{
					$data = array(
						'success' => '1',
						'msg' => 'Success! Please wait while you are being redirected.'
					);
					
					echo json_encode($data);
				}
				else
				{
					$data = array(
						'success' => '2',
						'msg' => 'Error! Something went wrong while creating this user! Please make sure that another user does not exist with the same username or email.'
					);
					
					echo json_encode($data);
				}
			
			}
		}
	}
	
	function remove_user()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$uname = $this->input->post('uname');
			
			if($this->users->remove($uname))
			{
				$data = array(
					'success' => '1',
					'msg' => 'Success! The user has been deleted.'
				);
				
				echo json_encode($data);
			}
			else
			{
				$data = array(
					'success' => '2',
					'msg' => 'Error! Something went wrong while deleting this user!'
				);
				
				echo json_encode($data);
			}
		}
	}
	
	function blacklistIP($method)
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$ip = $this->input->post('ip');
			
			switch($method)
			{
				case 'insert':
					if($this->general->insertBlacklistIP($ip))
					{
						$data = array(
							'success' => '1',
							'msg' => 'Success! The IP has been blacklisted.'
						);
					
						echo json_encode($data);
					}
					else
					{
						$data = array(
								'success' => '2',
								'msg' => 'Error! Something went wrong while blacklisting this IP.'
							);
					
						echo json_encode($data);
					}
				break;
				
				case 'remove':
					if($this->general->removeBlacklistIP($ip))
					{
						$data = array(
							'success' => '1',
							'msg' => 'Success! The IP has been removed from the blacklist.'
						);
					
						echo json_encode($data);
					}
					else
					{
						$data = array(
								'success' => '2',
								'msg' => 'Error! Something went wrong while whitelisting the IP.'
							);
					
						echo json_encode($data);
					}
				break;
				
				case 'update':
					$new = $this->input->post('ip_new');
					if($this->general->updateBlacklistIP($ip, $new))
					{
						$data = array(
							'success' => '1',
							'msg' => 'Success! The IP has been successfully updated.'
						);
					
						echo json_encode($data);
					}
					else
					{
						$data = array(
								'success' => '2',
								'msg' => 'Error! Something went wrong while updating the IP.'
							);
					
						echo json_encode($data);
					}
				break;
			}
		}
	}
}

/* End of file ajax.php */
/* Location: ./application/modules/ajax/controllers/ajax.php */