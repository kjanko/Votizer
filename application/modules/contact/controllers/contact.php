<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{		
		$data = array();
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Contact Us')
		->build('contact', $data);
	}
	
	public function mail()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('email');
			
			$this->email->from($this->input->post('email'), $this->input->post('first_name').' '.$this->input->post('last_name'));
			$this->email->to($this->config->item('admin_mail')); 
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('comment'));
			
			$this->email->send();
		}
		else
			echo 'No direct script access allowed';
	}
}