<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Dashboard Controller

class Dashboard extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Page_model', 'pages');
		
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
    }
	
	public function index()
	{		
		$data = array(
			'username' => $this->session->userdata('username'),
			'navigation' => $this->general->getNavigationData(),
			'graph' => $this->getGraph(),
			//ToDo: load this segment via AJAX to speedup the site
			'feeds' => $this->general->getXMLData('http://kjanko.com/XML.xml') 
		);
		
		$this->parser->parse('dashboard', $data);
	}
	
	private function getGraph()
	{
		$row = $this->general->getGraph();
		
		$data = array(
			'stack' => $this->arrayFormat($row),
			'top' => $this->getHighestValue($row),
			'first_date' => $this->getFirstDate($row),
			'last_date' => $this->getLastDate($row)
		);
		
		return $data;
	}
	
	private function getHighestValue($array)
	{
		if($array)
		{
			$highest = 0;

			foreach($array as $value)
			{
				if($value['ipCount'] > $highest)
				{
					$highest = $value['ipCount'];
				}
			}

			return $highest;
		}
		else
		{
			return false;
		}
	}

	private function arrayFormat($array)
	{
		if($array)
		{
			$output = "";
			$first = true;

			foreach($array as $month)
			{
				if($first)
				{
					$first = false;
					$output .= $month['ipCount'];
				}
				else
				{
					$output .= ",".$month['ipCount'];
				}
			}

			return $output;
		}
		else
		{
			return false;
		}
	}

	private function getLastDate($array)
	{
		if($array)
		{
			$value = preg_replace("/-/", " / ", $array[count($array)-1]['date']);

			return preg_replace("/ \/ [0-9]*$/", "", $value);
		}
		else
		{
			return false;
		}
	}

	private function getFirstDate($array)
	{
		if($array)
		{
			$value = preg_replace("/-/", " / ", $array[0]['date']);

			return preg_replace("/ \/ [0-9]*$/", "", $value);
		}
		else
		{
			return false;
		}
	}
	
	public function pages()
	{
		$data = array(
			'username' => $this->session->userdata('username'),
			'pages' => $this->pages->getPages()
		);
		
		$this->parser->parse('pages/page', $data);
	}
	
	public function pages_edit($id, $backUrl)
	{
		$data = array(
			'page' => $this->pages->getPageById($id),
			'backUrl' => $backUrl
		);
		
		$this->parser->parse('pages/pages-edit', $data);
	}
	
	public function pages_add($backUrl)
	{
		$data = array(
			'backUrl' => $backUrl
		);
		
		$this->parser->parse('pages/pages-add', $data);
	}
	
	public function users()
	{
		$data = array(
			'username' => $this->session->userdata('username'),
			'users' => $this->db->get('top_users')->result_array()
		);
		
		$this->parser->parse('users/users', $data);
	}
	
	public function users_add()
	{
		$this->parser->parse('users/users-add');
	}
	
	public function users_edit($username,$url)
	{
		$data = array(
			'user' => $this->users->get_user_data($username),
			'backUrl' => $url
		);
		
		$this->parser->parse('users/users-edit', $data);
	}
	
	public function sites()
	{		
		$data = array(
			'username' => $this->session->userdata('username'),
			'sites' => $this->sites->getData()
		);
		
		$this->parser->parse('sites/sites', $data);
	}
	
	public function sites_edit($id)
	{
		$data = array(
			'id' => $this->sites->getDataById($id),
		);
		
		$this->parser->parse('sites/sites-edit', $data);
	}
	
	public function blacklist()
	{		
		$data = array(
			'username' => $this->session->userdata('username'),
			'blacklistIps' => $this->general->getBlacklistData()
		);
		
		$this->parser->parse('blacklist/blacklist', $data);
	}
	
	public function blacklistIps()
	{
		$data = array(
			'blacklistIps' => $this->general->getBlacklistData()
		);
		
		$this->parser->parse('blacklist/blacklistIps', $data);
	}
	
	public function blacklistUsers()
	{
		$data = array(
			'blacklistUsers' => $this->general->getBlacklistUserData()
		);
		
		$this->parser->parse('blacklist/blacklistUsers', $data);
	}
    public function blacklistProfanity()
    {
        $data = array(
            'blacklistProfanity' => $this->general->getBlacklistProfanityData()
        );

        $this->parser->parse('blacklist/blacklistProfanity', $data);
    }
	
	public function logout()
	{
		$this->users->logout('acp');
	}
}

/* End of file dashboard.php */
/* Location: ./application/modules/acp/controllers/dashboard.php */