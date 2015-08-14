<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Out extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function vote($id)
	{				
		$this->load->model('in/In_model', 'votes');
		
		if($this->votes->validate($_SERVER["REMOTE_ADDR"], $id, 1))
			$this->votes->insert($_SERVER["REMOTE_ADDR"], $id, 1);
		
		$site = $this->sites->getDataById($id);
		redirect($site[0]['url']);

	}
}

/* End of file out.php */
/* Location: ./application/modules/out/controllers/out.php */