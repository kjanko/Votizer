<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Homepage Controller

class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->general->insertUserActivity($_SERVER['REMOTE_ADDR']);
    }
	
	public function index()
	{	
		$categories = $this->cms->get_database_data('top_categories');
		$content = $this->cms->get_database_data('top_servers');
		
		$data = array(
			'categories' => $categories,
			'servers' => $content
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->title('IgnitionCMS | Home')
		->build('home', $data);
	}
}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */