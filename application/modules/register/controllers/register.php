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
		
		$data = array(
			'categories' => $categories,
            'analyticsPropertyID' => $this->config->item('analytics_property_id')
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