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
		$this->load->model('points/points_model', 'points');
		$this->load->model('auction/auction_model', 'auction');
		
		$date = date('Y-m-d');
		$this->points->removeExpiredSubscriptions($date);
		$this->auction->removeExpiredSponsorship($date);
		$this->sites->resetVoters($date);
		
		$startMonth = date('Y-m-01');
		
		if($date == $startMonth)
			$this->sites->reset($date);

		$servers = $this->sites->getData();
	
		$data = array(
			'servers' => $servers,
            'analyticsPropertyID' => $this->config->item('analytics_property_id')
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