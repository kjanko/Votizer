<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'libraries/captcha/captcha.php';

class In extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function vote($id)
	{						
		$site = $this->sites->getDataById($id);
		
		if(!$site)
		{
			show_404();
		}
		
		$key = $this->config->item('recaptcha_api_key');
		
		$data = array(
			'site' => $site[0],
			'api_key' => $key
		);
		

		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Vote')
		->build('in', $data);
	}
	
	public function validate($id)
	{
		$secret = $this->config->item('recaptcha_secret_key');

		$response = null;
		
		$reCaptcha = new ReCaptcha($secret);
		$response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $this->input->post("g-recaptcha-response"));
		
		if($response != null && $response->success) 
		{
			$this->load->model('In_model', 'votes');
			if($this->votes->validate($_SERVER["REMOTE_ADDR"], $id, 0))
				$this->votes->insert($_SERVER["REMOTE_ADDR"], $id, 0);
		}
		redirect('home');
	}
}

/* End of file in.php */
/* Location: ./application/modules/in/controllers/in.php */