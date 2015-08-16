<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		$this->load->model('category/category_model', 'categories');

		$categories = $this->categories->getData();
		$navigation = $this->general->getHeaderNavigation();
		$sidebar = $this->general->getAdvertisements(0);
		$featured = $this->sites->getFeaturedData();
		
		$data = array(
			'navigation' => $navigation,
			'sidebar' => $sidebar,
			'featured' => $featured,
			'categories' => $categories
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Register')
		->build('register', $data);
	}
}