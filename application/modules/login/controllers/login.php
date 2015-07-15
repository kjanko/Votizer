<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Register Controller

class Login extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->general->insertUserActivity($_SERVER['REMOTE_ADDR']);
    }
	
	public function index()
	{
		$data = array(
		);

		$this->template
			->set_layout('login')
			->set_partial('metadata', 'partials/metadata')
            ->set_partial('header', 'partials/headerNew')
			->set_partial('content', 'partials/login')
			->title('IgnitionCMS | Login')
		->build('login', $data);
	}
}

