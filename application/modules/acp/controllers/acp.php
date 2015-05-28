<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Login Controller

class Acp extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		if($this->session->userdata('activity') && $this->session->userdata('rank') > 1)
		{
			redirect('/acp/dashboard/');
		}
		else
		{
			$this->parser->parse('login');
		}
	}
}

/* End of file acp.php */
/* Location: ./application/modules/acp/controllers/acp.php */