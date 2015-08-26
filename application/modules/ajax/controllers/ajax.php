<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// AJAX Controller
include APPPATH . 'libraries/banbuilder/CensorWords.php';

class Ajax extends MX_Controller
{
	protected $censor;
	protected $badlinks;

    public function __construct()
    {
        parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('acp/Page_model', 'pages');
		$this->load->model('acp/Settings_model', 'settings');

		$this->censor = new CensorWords;

		$censoredWords = $this->general->getBlacklistProfanityData();
		$censoredLinks = $this->general->getBlacklistUrlData();

		$this->badlinks = array();

		foreach($censoredLinks as $v)
		{
			array_push($this->badlinks, $v['url']);
		}

		foreach($censoredWords as $v)
		{
			array_push($this->censor->badwords, $v['word']);
		}

		if(!$this->input->is_ajax_request())
		{
			show_404();
		}
    }
	function index()
	{
		show_error('Access denied!');
	}

    function userLogin()
    {
		$domain = $_SERVER['SERVER_NAME'];
		$c = curl_init();

		curl_setopt($c, CURLOPT_URL, 'http://votizer.com/remote/');
		curl_setopt($c, CURLOPT_POST, true);
		curl_setopt($c, CURLOPT_POSTFIELDS, 'domain='.$domain);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_HEADER, 0);

		$response = curl_exec($c);

		curl_close($c);
		
		if($response == 2)
			die("Invalid license");
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->input->post('user');
			
			$login = $this->users->login($username, $password);

			if($login == "Good")
			{
				if($this->users->getUserRank($username) >= 2 && $user == "false")
				{
					$data = array(
						'success' => '1',
						'msg' => 'Success! Please wait while we redirect you...'
					);

					echo json_encode($data);
				}
				else if($user == "true")
				{
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
			else if($login == "Banned")
			{
				$data = array(
					'success' => '2',
					'msg' => 'Your account has been banned.'
				);

				echo json_encode($data);
			}
			else if($login == "Bad")
			{
				$data = array(
					'success' => '2',
					'msg' => 'Incorrect credentials.'
				);

				echo json_encode($data);
			}
		}
    }
    function addCategory()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_error_delimiters(' ', ' ');
            $this->form_validation->set_rules('category', 'Category', 'required');

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
                $category = $this->input->post('category');

                if($this->settings->insertCategory($category))
                {
                    $data = array(
                        'success' => '1',
                        'msg' => 'Success! The category was successfully added.'
                    );

                    echo json_encode($data);
                }
                else
                {
                    $data = array(
                        'success' => '2',
                        'msg' => 'Error! This category already exists!'
                    );

                    echo json_encode($data);
                }
            }
        }
    }
    function addAdvert()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_error_delimiters(' ', ' ');
            $this->form_validation->set_rules('bannerUrl', 'Banner URL', 'required');
            $this->form_validation->set_rules('targetUrl', 'Target URL', 'required');
            $this->form_validation->set_rules('location', 'Location', 'required|is_natural');

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
                $url = $this->input->post('bannerUrl');
                $href = $this->input->post('targetUrl');
                $location = $this->input->post('location');

                if($this->settings->insertAdvert($url, $href, $location))
                {
                    $data = array(
                        'success' => '1',
                        'msg' => 'Success! The advertisement was successfully added.'
                    );

                    echo json_encode($data);
                }
                else
                {
                    $data = array(
                        'success' => '2',
                        'msg' => 'Error! This advertisement already exists!'
                    );

                    echo json_encode($data);
                }
            }
        }
    }
    function editAdvert()
    {
        $this->form_validation->set_error_delimiters(' ', ' ');

        $field = $this->input->post('field');
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if($field == "url"){
            $this->form_validation->set_rules('value', 'Banner URL', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'success' => '2',
                    'msg' => validation_errors()
                );

                echo json_encode($data);
                return;
            }
            if($this->settings->updateAdvertUrl($id, $value)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Advertisement has been changed.'
                );
                echo json_encode($data);
                return;
            }
        }
        else if($field == "target")
        {
            $this->form_validation->set_rules('value', 'Target URL', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'success' => '2',
                    'msg' => validation_errors()
                );

                echo json_encode($data);
                return;
            }
            if($this->settings->updateAdvertHref($id, $value)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Advertisement has been changed.'
                );
                echo json_encode($data);
                return;
            }
        }
        else if($field == "location")
        {
            $this->form_validation->set_rules('value', 'Location', 'required|is_natural');
            if ($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'success' => '2',
                    'msg' => validation_errors()
                );

                echo json_encode($data);
                return;
            }
            if($this->settings->updateAdvertLocation($id, $value)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Advertisement has been changed.'
                );
                echo json_encode($data);
                return;
            }
        }
        $data = array(
            'success' => '2',
            'msg' => 'Advertisement already exists.'
        );
        echo json_encode($data);
    }
    function editNavigation()
    {
        $this->form_validation->set_error_delimiters(' ', ' ');

        $field = $this->input->post('field');
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if($field == "href"){
            $this->form_validation->set_rules('value', 'Link URL', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'success' => '2',
                    'msg' => validation_errors()
                );

                echo json_encode($data);
                return;
            }
            if($this->settings->updateNavigationHref($id, $value)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Navigation link has been changed.'
                );
                echo json_encode($data);
                return;
            }
        }
        else if($field == "name")
        {
            $this->form_validation->set_rules('value', 'Link Name', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'success' => '2',
                    'msg' => validation_errors()
                );

                echo json_encode($data);
                return;
            }
            if($this->settings->updateNavigationName($id, $value)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Navigation link has been changed.'
                );
                echo json_encode($data);
                return;
            }
        }
        else if($field == "permission")
        {
            $this->form_validation->set_rules('value', 'Link Name', 'required|is_natural');
            if ($this->form_validation->run() == FALSE)
            {
                $data = array(
                    'success' => '2',
                    'msg' => validation_errors()
                );

                echo json_encode($data);
                return;
            }
            if($this->settings->updateNavigationPermission($id, $value)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Navigation link has been changed.'
                );
                echo json_encode($data);
                return;
            }
        }
        $data = array(
            'success' => '2',
            'msg' => 'Advertisement already exists.'
        );
        echo json_encode($data);
    }
    function editCategory()
    {
        $this->form_validation->set_error_delimiters(' ', ' ');
        $this->form_validation->set_rules('category', 'Category name', 'required');

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
            $category = $this->input->post('category');
            $id = $this->input->post('id');

            if($this->settings->updateCategory($id, $category)) {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! Category has been changed.'
                );
                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Category already exists.'
                );
                echo json_encode($data);
            }

        }
    }
    function editNavigationPosition()
    {
        $orderedLinks = json_decode($_POST['orderedLinks']);
        $position = 0;
        foreach($orderedLinks as $linkId){
            if($this->settings->updateNavigationPosition($linkId, $position)) {

            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Sorry. Something went wrong.'
                );
                echo json_encode($data);
                return;
            }
            $position++;
        }
        $data = array(
            'success' => '1',
            'msg' => 'Success! Category has been changed.'
        );
        echo json_encode($data);

    }
    function removeCategory()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $id = $this->input->post('id');

            if($this->settings->removeCategory($id))
            {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! The category has been successfully deleted.'
                );

                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Error! Something went wrong while deleting this category!'
                );

                echo json_encode($data);
            }
        }
    }

    function removeNavigation()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $id = $this->input->post('id');

            if($this->settings->navigationIdExists($id))
            {
                $this->settings->updateNavPositions($id);
                $this->settings->removeNavigation($id);
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! The navigation link has been successfully deleted.'
                );

                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Error! Something went wrong while deleting this navigation link!'
                );

                echo json_encode($data);
            }
        }
    }

    function removeAdvert()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $id = $this->input->post('id');

            if($this->settings->removeAdvert($id))
            {
                $data = array(
                    'success' => '1',
                    'msg' => 'Success! The advertisement has been successfully deleted.'
                );

                echo json_encode($data);
            }
            else
            {
                $data = array(
                    'success' => '2',
                    'msg' => 'Error! Something went wrong while deleting this advertisement!'
                );

                echo json_encode($data);
            }
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
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('inVotes', 'In Votes', 'required|is_natural');
			$this->form_validation->set_rules('outVotes', 'Out Votes', 'required|is_natural');
			$this->form_validation->set_rules('bannerUrl', 'Banner URL', 'required|trim|max_length[256]');
			$this->form_validation->set_rules('url', 'URL', 'required|trim|max_length[256]');

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

				if($this->sites->update($id, $title, $description, $category_id, $in, $out, $bannerUrl, $url))
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

    private function writeToConfig($oldValue, $newValue, $varName)
    {
        $file = file_get_contents(APPPATH . 'config/settings.php');
        $oldRow = "config['$varName'] = '$oldValue'";
        $newRow = "config['$varName'] = '$newValue'";

        $newFile = str_replace($oldRow, $newRow, $file, $count);

        file_put_contents(APPPATH . 'config/settings.php', $newFile);
    }
	
	function setTheme()
	{
        $this->config->load('template.php');
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		else
		{
			$value = $this->input->post('theme_name');
			$old = $this->config->item('theme');
			self::writeToTemplate($old, $value, 'theme');
		}

		$data = array(
			'success' => '1',
			'msg' => 'Success! The theme has been successfully changed.'
		);

		echo json_encode($data);
	}
	
	private function writeToTemplate($oldValue, $newValue, $varName)
    {
        $file = file_get_contents(APPPATH . 'config/template.php');
        $oldRow = "config['$varName'] = '$oldValue'";
        $newRow = "config['$varName'] = '$newValue'";

        $newFile = str_replace($oldRow, $newRow, $file, $count);

        file_put_contents(APPPATH . 'config/template.php', $newFile);
    }

    function editSettings()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            foreach($this->input->post() as $k => $v)
            {
                $oldValue = $this->config->item($k);
                self::writeToConfig($oldValue, $v, $k);
            }

            $data = array(
                'success' => '1',
                'msg' => 'Success! The settings data has been successfully changed.'
            );

            echo json_encode($data);
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

                if ($this->general->banWord($word))
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
    function addPremium()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_error_delimiters(' ', ' ');
            $this->form_validation->set_rules('endDate', 'End date', 'required');

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
                $endDate = $this->input->post('endDate');

                if($this->settings->makePremium($id, $endDate))
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
                        'msg' => 'The time period that premium is valid cannot be reduced.'
                    );

                    echo json_encode($data);
                }

            }
        }
    }
    function addNavigation()
    {
        if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_error_delimiters('<div class="error-box">', '</div>');
            $this->form_validation->set_rules('url', 'Link URL', 'required');
            $this->form_validation->set_rules('name', 'Link Name', 'required');
            $this->form_validation->set_rules('permission', 'Permission', 'required|is_natural');

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
                $name = $this->input->post('name');
                $url = $this->input->post('url');
                $permission = $this->input->post('permission');

                if($this->settings->insertNavigation($url, $name, $permission))
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
                        'msg' => 'Error! Something went wrong while creating this navigation!'
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

	function getSearchData($table, $tableRow, $view)
	{
		$value = $this->input->post('query');

		$array = array(
			$tableRow => $value
		);

		$data = $this->general->searchData($table, $array);

		$output = array(
			$table => $data
		);

		if($data)
		{
			$result = array(
				'success' => '1',
				'html' => $this->parser->parse($view, $output, true)
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
        $this->form_validation->set_error_delimiters('<div style="width: 80%" class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('fname', 'Name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'Surname', 'required|alpha');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|alpha_dash');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
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
            $rank = 0;
            $url = $this->input->post('url');
            $description = $this->input->post('description');
            $title = $this->input->post('title');
            $categoryId = $this->input->post('category');

			$censorTitle = $this->censor->censorString($title);
			$censorDesc = $this->censor->censorString($description);

			if(in_array($url, $this->badlinks))
			{
				$data = array(
					'success' => '2',
					'msg' => 'Your URL is blacklisted. Please try again.'
				);

				echo json_encode($data);
			}
			else
			{
				if(!$this->users->doesExist($uname, $email))
				{
					if($this->users->create($fname, $lname, $uname, $password, $email, $rank))
					{
						$userId = $this->users->getUserId($uname);
						$this->sites->create($censorTitle['clean'], $censorDesc['clean'], $userId, $categoryId, $url);
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
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
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

			$censorTitle = $this->censor->censorString($title);
			$censorDesc = $this->censor->censorString($description);

			if(in_array($url, $this->badlinks))
			{
				$data = array(
					'success' => '2',
					'msg' => 'Your URL is blacklisted. Please try again.'
				);

				echo json_encode($data);
			}
			else
			{
				//if url is valid
				if($this->sites->updateUCP($userId, $url, $censorDesc['clean'], $censorTitle['clean'], $categoryId))
				{
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
    }
    function changePassword()
    {
        $this->form_validation->set_error_delimiters('<div style="width: 80%" class="alert alert-danger">', '</div>');
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