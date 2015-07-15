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
    //***********
	function user_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
        $user = $this->input->post('user');

		if($this->users->login($username, $password))
		{
			if($this->users->get_user_rank($username) >= 2 && $user == "false")
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

	function user_activity()
	{
		if($this->session->userdata('activity') && $this->session->userdata('rank') < 2)
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
		if($this->session->userdata('activity') && $this->session->userdata('rank') < 2)
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
    //**********
	function editSiteACP()
	{
        if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
        {
            show_404();
        }
		else
		{
			$this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
			$this->form_validation->set_rules('categoryId', 'CategoryId', 'required|is_natural');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('inVotes', 'In Votes', 'required|is_natural');
			$this->form_validation->set_rules('outVotes', 'Out Votes', 'required|is_natural');
			$this->form_validation->set_rules('bannerUrl', 'Banner URL', 'required');
            $this->form_validation->set_rules('premium', 'Premium', 'required|is_natural');
			$this->form_validation->set_rules('url', 'URL', 'required');
			//Valid url check
            //Check valid image url at banner url
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

				if($this->sites->updateACP($id, $title, $description, $category_id, $in, $out, $bannerUrl, $url, $premium))
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
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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

    function banProfanity()
    {
        if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
                        'msg' => 'Error! This word already exists!'
                    );

                    echo json_encode($data);
                }
            }
        }
    }

	function add_user()
	{
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
						'msg' => 'Username or email is already taken.'
					);

					echo json_encode($data);
				}

			}
		}
	}

	function removeUser()
	{
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
                        'msg' => 'Error! This IP already exists!'
                    );

                    echo json_encode($data);
                }
            }
        }
    }

	function removeBlacklistIp()
	{
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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

    function removeBlacklistProfanity()
    {
        if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
		if(!$this->session->userdata('activity') | $this->session->userdata('rank') < 2)
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
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
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
	function addSite()
	{
		if(!$this->session->userdata('activity') || $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
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
	//***************
    function registerSite()
    {
        $this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
        $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|alpha_dash');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('rank', 'Rank', 'required|is_natural');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

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
            $this->form_validation->set_rules('category', 'Category', 'required|is_natural');

            if(!$this->users->doesExist($uname, $email))
            {
                //if url is valid
                if($this->users->create($fname,$lname,$uname,$password,$email,$rank)) {
                    $userId = $this->users->get_user_id($uname);
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
    //***************
    function editSite()
    {
        $this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
        $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
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
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $url = $this->input->post('url');
            $description = $this->input->post('description');
            $title = $this->input->post('title');
            $categoryId = $this->input->post('category');

            $userId = $this->session->userdata('id');

            if(!$this->users->emailTaken($email,$userId))
            {
                //if url is valid
                if($this->sites->update($userId, $url, $description, $title, $categoryId) && $this->users->updateUser($userId, $fname, $lname, $email)) {
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
                    'msg' => 'Email is already taken.'
                );
                echo json_encode($data);
            }

        }
    }
    //***************
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

            if($this->users->edit_password($username, $oldPassword, $password))
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