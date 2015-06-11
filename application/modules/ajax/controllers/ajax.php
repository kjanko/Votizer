<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// AJAX Controller

class Ajax extends MX_Controller 
{

    public function __construct()
    {
        parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('acp/Page_model', 'pages');
		
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
	function edit_site()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
			$this->form_validation->set_rules('categoryId', 'Username', 'required|is_natural');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Descripton', 'required');
			$this->form_validation->set_rules('inVotes', 'In Votes', 'required|is_natural');
			$this->form_validation->set_rules('outVotes', 'Out Votes', 'required|is_natural');
			$this->form_validation->set_rules('bannerUrl', 'Banner URL', 'required');
			$this->form_validation->set_rules('url', 'URL', 'required');
			
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
				$category_id = $this->input->post('categoryId');
				$title = $this->input->post('title');
				$description = $this->input->post('description');
				$in = $this->input->post('inVotes');
				$out = $this->input->post('outVotes');
				$bannerUrl = $this->input->post('bannerUrl');
				$url = $this->input->post('url');
				$premium = $this->input->post('premium');
				
				if($this->sites->update($id, $title, $description, $category_id, $in, $out, $bannerUrl, $url, $premium))
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
	
	function banUser()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
				$user = $this->input->post('uname');
				$data = $this->users->get_user_id($user);
				if(!empty($data))
				{
					$this->general->updateBlacklistUser($data, 1);
					$data = array(
						'success' => '1',
						'msg' => 'Success! The user '.$user.' has been banned!'
					);
					
					echo json_encode($data);
				}
				else
				{
					$data = array(
						'success' => '2',
						'msg' => 'Error! This user does not exist!'
					);
					
					echo json_encode($data);
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
	
	function removeUser()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$uname = $this->input->post('uname');
			$query = $this->db->select('id')->from('top_users')->where('username', $uname)->get()->row()->id;

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
	
	function remove_site()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$id = $this->input->post('id');
			
			if($this->sites->remove($id))
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
	
	function banIp()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
			$this->form_validation->set_rules('ip', 'Ip', 'required|valid_ip');
			
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
				$ip = $this->input->post('ip');
				
				if($this->general->insertBlacklistIP($ip))
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
						'msg' => 'Error! This IP already exists!'
					);
					
					echo json_encode($data);
				}
			}
		}
	}
	
	function removeBlacklistIp()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$ip = $this->input->post('postIP');
			
			if($this->general->removeBlacklistIP($ip))
			{
				$data = array(
					'success' => '1',
					'msg' => 'Success! The IP has been deleted from the blacklist.'
				);
				
				echo json_encode($data);
			}
			else
			{
				$data = array(
					'success' => '2',
					'msg' => 'Error! Something went wrong while deleting this IP from the blacklist!'
				);
				
				echo json_encode($data);
			}
		}
	}
	function removeBlacklistUsers()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$id = $this->input->post('id');
			if($this->general->updateBlacklistUser($id, 0))
			{
				$data = array(
					'success' => '1',
					'msg' => 'Success! The IP has been deleted from the blacklist.'
				);
				
				echo json_encode($data);
			}
			else
			{
				$data = array(
					'success' => '2',
					'msg' => 'Error! Something went wrong while deleting this IP from the blacklist!'
				);
				
				echo json_encode($data);
			}
		}
	}
	
	function editPage()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('url', 'URL', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');
			
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
				$title = $this->input->post('title');
				$url = $this->input->post('url');
				$content = $this->input->post('content');
				
				if($this->pages->update($id, $url, $title, $content))
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
						'msg' => 'Error! Something went wrong while editing this page!'
					);
					
					echo json_encode($data);
				}
			}
		}
	}
	
	function removePage()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$id = $this->input->post('postID');
			
			if($this->pages->remove($id))
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
					'msg' => 'Error! Something went wrong while removing this page!'
				);
				
				echo json_encode($data);
			}
		}
	}
}

/* End of file ajax.php */
/* Location: ./application/modules/ajax/controllers/ajax.php */