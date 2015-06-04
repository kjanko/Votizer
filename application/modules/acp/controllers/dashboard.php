<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Dashboard Controller

class Dashboard extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		
		//--------------------------//
		//		  XML Data         //
		//------------------------//
		$doc = new DOMDocument();
		$doc->load('http://kjanko.com/XML.xml');
		$arrFeeds = array();
		foreach ($doc->getElementsByTagName('topic') as $node) 
		{
			$itemRSS = array ( 
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'content' => $node->getElementsByTagName('content')->item(0)->nodeValue,
				'date' => $node->getElementsByTagName('date')->item(0)->nodeValue
			);
			array_push($arrFeeds, $itemRSS);
		}	
		//------------------------//
		
		$data = array(
			'username' => $this->session->userdata('username'),
			'navigation' => $this->general->getNavigationData(),
			'feeds' => $arrFeeds
		);
		
		$this->parser->parse('dashboard', $data);
	}
	
	public function users()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		
		$data = array(
			'username' => $this->session->userdata('username'),
			'users' => $this->db->get('top_users')->result_array()
		);
		
		$this->parser->parse('users/users', $data);
	}
	public function sites()
	{
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
		
		$data = array(
			'username' => $this->session->userdata('username'),
			'sites' => $this->sites->getData()
		);
		
		$this->parser->parse('sites/sites', $data);
	}
	
	public function users_edit($username,$url)
	{
		$data = array(
			'user' => $this->users->get_user_data($username),
			'backUrl' => $url
		);
		
		$this->parser->parse('users/users-edit', $data);
	}
	public function sites_edit($id)
	{
		$data = array(
			'id' => $this->sites->getDataById($id),
		);
		
		$this->parser->parse('sites/sites-edit', $data);
	}
	
	public function users_add()
	{
		$this->parser->parse('users/users-add');
	}
	
	
	public function logout()
	{
		$this->users->logout('acp');
	}
}

/* End of file dashboard.php */
/* Location: ./application/modules/acp/controllers/dashboard.php */