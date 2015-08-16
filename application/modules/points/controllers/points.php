<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Points Controller
include APPPATH . 'libraries/paymentwall/paymentwall.php';

class Points extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
		
		if(!$this->session->userdata('activity'))
		{
			redirect('login');
		}
    }
	
	public function index()
	{				
		Paymentwall_Base::setApiType(Paymentwall_Base::API_VC);
		Paymentwall_Base::setAppKey($this->config->item('paymentwall_app_key'));
		Paymentwall_Base::setSecretKey($this->config->item('paymentwall_secret_key'));
		
		$user = $this->users->getUserById($this->users->getUserId($this->session->userdata('username')));
		
		$widget = new Paymentwall_Widget(
			$user->id,
			$this->config->item('paymentwall_widget_code'),
			array(),
			array(
				'email' => $user->email,
				'customer[username]' => $user->username,
				'customer[firstname]' => $user->name,
				'customer[lastname]' => $user->l_name
			)
		);

		$data = array(
			'widget' => $widget->getHtmlCode()
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Buy Points')
		->build('points', $data);
	}
}

/* End of file points.php */
/* Location: ./application/modules/points/controllers/points.php */