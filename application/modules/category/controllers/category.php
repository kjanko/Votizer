<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Category Controller

class Category extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	function _remap($parameter)
	{
        $this->index($parameter);
    }
	
	public function index($category)
	{			
		$this->load->model('category_model', 'categories');

		$id = $this->categories->getCategoryId($category);
		
		$servers = $this->sites->getDataByCategory($id);
		$navigation = $this->general->getHeaderNavigation();
		$sidebar = $this->general->getAdvertisements(0);
		$featured = $this->sites->getFeaturedData();
	
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
			->title($this->config->item('site_title'), $category)
		->build('home', $data);
	}
}

/* End of file category.php */
/* Location: ./application/modules/home/controllers/category.php */