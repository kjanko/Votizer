<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Premium Controller

class Premium extends MX_Controller 
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
	
		$data = array(
			'points' => $this->users->getBalance($this->session->userdata('username'))
		);
		
		$this->template
			->set_layout('default')
			->set_partial('metadata', 'partials/metadata')
			->set_partial('header', 'partials/header')
			->set_partial('sidebar', 'partials/sidebar')
			->set_partial('featured', 'partials/featured')
			->set_partial('footer', 'partials/footer')
			->title($this->config->item('site_title'), 'Premium')
		->build('premium', $data);
	}
	
	public function purchase($id)
	{
		$this->load->model('points/points_model', 'points');
		
		$site = $this->sites->getSiteByUserId($this->session->userdata('id'));
		
		if($site->premium == 0)
			$date = date('Y-m-d');
		else
			$date = $this->points->getExpirationDate($site->id);
		switch($id)
		{
			case 1:
				if($this->users->getBalance($this->session->userdata('username')) >= $this->config->item('shop_starter'))
				{
					$this->users->updateBalance($this->session->userdata('username'), $this->users->getBalance($this->session->userdata('username')) - $this->config->item('shop_starter'));
					$final = self::endCycle($date, 1);
					$this->points->insertSubscription($site->id, $final);
					redirect('premium');
				}
				else
					redirect('premium');
			break;
			
			case 2:
				if($this->users->getBalance($this->session->userdata('username')) >= $this->config->item('shop_value'))
				{
					$this->users->updateBalance($this->session->userdata('username'), $this->users->getBalance($this->session->userdata('username')) - $this->config->item('shop_value'));
					$final = self::endCycle($date, 3);
					$this->points->insertSubscription($site->id, $final);
					redirect('premium');
				}
				else
					redirect('premium');
			break;
			
			case 3:
				if($this->users->getBalance($this->session->userdata('username')) >= $this->config->item('shop_pro'))
				{
					$this->users->updateBalance($this->session->userdata('username'), $this->users->getBalance($this->session->userdata('username')) - $this->config->item('shop_pro'));
					$final = self::endCycle($date, 6);
					$this->points->insertSubscription($site->id, $final);
					redirect('premium');
				}
				else
					redirect('premium');

			break;
			
			case 4:
				if($this->users->getBalance($this->session->userdata('username')) >= $this->config->item('shop_premium'))
				{
					$this->users->updateBalance($this->session->userdata('username'), $this->users->getBalance($this->session->userdata('username')) - $this->config->item('shop_premium'));
					$final = self::endCycle($date, 12);
					$this->points->insertSubscription($site->id, $final);
					redirect('premium');
				}
				else
					redirect('premium');
			break;
		}
	}
	
	function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) 
		{
            return $dateObject->diff($next);
        } 
		else 
		{
            return new DateInterval('P'.$months.'M');
        }
    }

	function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add(self::add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }
}

/* End of file premium.php */
/* Location: ./application/modules/premium/controllers/premium.php */