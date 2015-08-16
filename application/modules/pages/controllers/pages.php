<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    } 
	
	function _remap($parameter)
	{
        $this->index($parameter);
    }
	
	public function index($controller)
	{
		$navigation = $this->general->getHeaderNavigation();
		$sidebar = $this->general->getAdvertisements(0);
		$featured = $this->sites->getFeaturedData();

		$this->load->model('acp/page_model', 'pages');
		
		$page = $this->pages->getPageByController($controller);
		
		$data = array(
			'navigation' => $navigation,
			'sidebar' => $sidebar,
			'featured' => $featured,
			'page' => $page[0]
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), $page[0]['title'])
		->build('page', $data);
	}
}