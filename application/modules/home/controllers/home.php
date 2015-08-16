<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Homepage Controller

class Home extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
		$this->general->insertUserActivity($_SERVER['REMOTE_ADDR']);
    }
	
	public function index()
	{			
		$servers = $this->sites->getData();
		$navigation = $this->general->getHeaderNavigation();
		$sidebar = $this->general->getAdvertisements(0);
		$featured = $this->sites->getFeaturedData();
		$homepage = $this->general->getHomepageData(); //ToDo
	
		$data = array(
			'servers' => $servers,
			'navigation' => $navigation,
			'sidebar' => $sidebar,
			'featured' => $featured
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Home')
		->build('home', $data);
	}
}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */