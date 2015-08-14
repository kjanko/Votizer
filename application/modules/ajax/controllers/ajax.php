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

    function userLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->input->post('user');

        if($this->users->login($username, $password))
        {
            if($this->users->getUserRank($username) >= 2 && $user == "false")
            {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Please wait while we redirect you...'
                );

                echo json_encode($data);
            }else if($user == "true"){
                $data = array(
                    'success' => '3',
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
	
	function editUser()
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
	function editSite()
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
			$this->form_validation->set_rules('bannerUrl', 'Banner URL', 'required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists|callback_duplicate_URL_check');
			$this->form_validation->set_rules('url', 'URL', 'required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists|callback_duplicate_URL_check');
			
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
				$data = $this->users->getUserId($user);
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

    function banProfanity()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_rules('word', 'Word', 'required');
            $this->form_validation->set_rules('replacement', 'Replacement', 'required');

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
                $word = $this->input->post('word');
                $replacement = $this->input->post('replacement');

                if ($this->general->banWord($word, $replacement))
                {
                    $data = array(
                        'success' => '1',
                        'msg' => 'Success! Please wait while you are being redirected.'
                    );

                    echo json_encode($data);
                } else {
                    $data = array(
                        'success' => '2',
                        'msg' => 'Error! This word is already banned!'
                    );

                    echo json_encode($data);
                }
            }
        }
    }
	
	function addUser()
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
	
	function removeSite()
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
    function banUrl()
    {
        if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_rules('url', 'Ip', 'required');

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
                $url = $this->input->post('url');

                if($this->general->banUrl($url))
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
                        'msg' => 'Error! This URL already exists!'
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

    function removeBlacklistUrl()
    {
        if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $id = $this->input->post('postId');

            if($this->general->removeBlacklistUrl($id))
            {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! The URL has been deleted from the blacklist.'
                );

                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Error! Something went wrong while deleting this URL from the blacklist!'
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
    function removeBlacklistProfanity()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $id = $this->input->post('postID');

            if($this->general->removeBlacklistProfanity($id))
            {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! The word has been deleted from the blacklist.'
                );

                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Error! Something went wrong while deleting this word from the blacklist!'
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
	
	function addPage()
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
				$title = $this->input->post('title');
				$url = $this->input->post('url');
				$content = $this->input->post('content');
				
				if($this->pages->create($url, $title, $content))
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
						'msg' => 'Error! Something went wrong while creating this page!'
					);
					
					echo json_encode($data);
				}
			
			}
		}
	}
	
	function getSearchData($table)
	{
		$username = $this->input->post('query');
		
		$array = array(
			'username' => $username
		);
		
		$data = $this->general->searchData($table, $array);
		
		$output = array(
			'users' => $data
		);
		
		if($data)
		{
			$result = array(
				'success' => '1',
				'html' => $this->parser->parse('users-search', $output, true)
			);
			
			echo json_encode($result);
		}
		else
		{
			$result = array(
				'success' => '2'
			);
			
			echo json_encode($result);
		}
	}
	function registerSite()
    {
        $this->form_validation->set_error_delimiters('<div style="padding-left: 40px" class="error-box">', '</div>');
        $this->form_validation->set_rules('fname', 'Name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'Surname', 'required|alpha');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|alpha_dash');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('rank', 'Rank', 'required|is_natural');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required|is_natural');

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
            $url = $this->input->post('url');
            $description = $this->input->post('description');
            $title = $this->input->post('title');
            $categoryId = $this->input->post('category');
            if(!$this->users->doesExist($uname, $email))
            {
                //if url is valid
                if($this->users->create($fname,$lname,$uname,$password,$email,$rank)) {
                    $userId = $this->users->getUserId($uname);
                    $this->sites->create($title, $description, $userId, $categoryId, $url);
                    $data = array(
                        'success' => '1',
                        'msg' => 'Success! Please wait while you are being redirected.'
                    );
                }
                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Username or email is already taken.'
                );
                echo json_encode($data);
            }

        }
    }
    function editUserDetails()
    {
        $this->form_validation->set_error_delimiters(' ', ' ');
        $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                'success' => '2',
                'msg' => validation_errors()
            );

            echo json_encode($data);
        }
        else
        {
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');

            $userId = $this->session->userdata('id');

            if(!$this->users->emailTaken($email,$userId))
            {
                //if url is valid
                if($this->users->updateUCP($userId, $fname, $lname, $email)) {
                    $data = array(
                        'success' => '1',
                        'msg' => 'Success! User details has been changed.'
                    );
                }
                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Email is already taken.'
                );
                echo json_encode($data);
            }

        }
    }
    function editSiteDetails()
    {
        $this->form_validation->set_error_delimiters(' ', ' ');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required|is_natural');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array(
                'success' => '2',
                'msg' => validation_errors()
            );

            echo json_encode($data);
        }
        else
        {
            $url = $this->input->post('url');
            $description = $this->input->post('description');
            $title = $this->input->post('title');
            $categoryId = $this->input->post('category');

            $userId = $this->session->userdata('id');

            //if url is valid
            if($this->sites->updateUCP($userId, $url, $description, $title, $categoryId)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Site details has been changed.'
                );
                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Sorry something went wrong.'
                );
                echo json_encode($data);
            }
        }
    }
    function changePassword()
    {
        $this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|alpha_dash');
        $this->form_validation->set_rules('newPassword', 'New password', 'required|min_length[7]|alpha_dash');

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
            $oldPassword = $this->input->post('password');
            $password = $this->input->post('newPassword');

            $username = $this->session->userdata('username');

            if($this->users->changePassword($username, $oldPassword, $password))
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
                    'msg' => 'Password is incorrect.'
                );
                echo json_encode($data);
            }
        }
    }
}

/* End of file ajax.php */
/* Location: ./application/modules/ajax/controllers/ajax.php */