<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Notification Controller

class Notification extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function error()
	{	
		$data = array(
			'message' => $this->session->userdata('notification-message')
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Notification')
		->build('error', $data);
	}
	
	public function success()
	{	
		$data = array(
			'message' => $this->session->userdata('notification-message'),
            'analyticsPropertyID' => $this->config->item('analytics_property_id')
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Notification')
		->build('success', $data);
		
		$this->session->unset_userdata('notification-message');
	}
}
/* End of file notification.php */
/* Location: ./application/modules/notification/controllers/notification.php */