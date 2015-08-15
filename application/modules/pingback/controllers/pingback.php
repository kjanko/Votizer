<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pingback extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function get($ip, $siteid)
	{
		$this->load->model('in/in_model', 'votes');

		if(!$this->votes->validate($ip, $siteid, 0))
			echo 1;
		else
			echo 0;

	}
}