<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'libraries/paymentwall/paymentwall.php';

class Postback extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
		
		if(!$this->session->userdata('activity'))
		{
			redirect('login');
		}
    }
	
	public function paymentwall()
	{		
		$this->load->model('points/points_model', 'points');
	
		Paymentwall_Base::setApiType(Paymentwall_Base::API_VC);
		Paymentwall_Base::setAppKey($this->config->item('paymentwall_app_key'));
		Paymentwall_Base::setSecretKey($this->config->item('paymentwall_secret_key'));
		
		$pingback = new Paymentwall_Pingback($this->input->get(), $_SERVER['REMOTE_ADDR']);

		if($pingback->validate()) 
		{
			$virtualCurrency = $pingback->getVirtualCurrencyAmount();
			$date = date('Y-m-d')
			$uid = $this->input->get('uid');
			
			if($pingback->isDeliverable()) 
			{
				if($this->points->isValid($this->input->get('ref')))
				{
					$this->points->add($this->input->get('uid'), $virtualCurrency);
					$this->points->log($this->input->get('uid'), $ref, date("Y-m-d"));
					$this->points->updateDailyIncome($date, $virtualCurrency);

				}
			} 
			elseif($pingback->isCancelable()) 
			{
				echo 'Something went wrong while processing your request!';
			} 
			echo 'OK';
		} 
		else 
		{
			echo $pingback->getErrorSummary();
		}
	}
}