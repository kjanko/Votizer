<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends MX_Controller 
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
			->title($this->config->item('site_title'), 'Forgot Password')
		->build('forgot', $data);
    }
	
	public function resetPW()
	{
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		
		if($this->users->doesExist($username, $email))
		{
			$password = self::generateRandomString(15);
			
			$this->load->library('email');

			$this->email->from($this->config->item('admin_mail'), 'No reply');
			$this->email->to($email); 
			$this->email->subject('Forgot your password');
			$this->email->message('Your new password is: ' . $password);
			$this->email->send();
			
			$hash = sha1(strtoupper($password));
			
			$data = array(
                'password' => $hash
            );
			
			$this->db->where('email', $email)->update('top_users', $data);

			$this->session->set_userdata(array("notification-message" => "An email has been sent with instructions on how to reset your password."));
			redirect('notification/success');
		}
		else
		{
			$this->session->set_userdata(array("notification-message" => "An error has occured."));
			redirect('notification/error');
		}
	}
	
	private function generateRandomString($length)
	{
		return substr(str_repeat(md5(rand()), ceil($length/32)), 0, $length);
	}
}