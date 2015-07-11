<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Register Controller

class Register extends MX_Controller {

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
			->set_layout('index')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('content', 'partials/register')
			->title('IgnitionCMS | Register')
		->build('register', $data);
	}
}

