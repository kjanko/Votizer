<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auction extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
		
		$this->load->model('auction_model', 'auction');
		$this->load->model('points/points_model', 'points');
    }
	
	public function index()
	{						
		$auction = $this->auction->getActiveAuction();
		
		$date = date('Y-m-d');
		
		if($date >= $this->auction->getEndingDate())
		{
			$this->auction->closeAuction();
			$this->session->set_userdata(array("notification-message" => "No active auction."));
			redirect('notification/error');
		}
		else
		{		
			$data = array(
				'auction' => $auction,
				'totalBids' => $this->auction->getTotalBids(),
				'bidders' => $this->auction->getHighestBidders()
			);
			
			if($this->session->userdata('activity'))
				$data['currentBid'] = $this->auction->getCurrentBid();
			
			$errors = array_filter($auction);
			
			if(!empty($errors))
			{
				$this->template
					->set_layout('default')
					->set_partial('metadata', 'partials/metadata')
					->set_partial('header', 'partials/header')
					->set_partial('sidebar', 'partials/sidebar')
					->set_partial('featured', 'partials/featured')
					->set_partial('footer', 'partials/footer')
					->title($this->config->item('site_title'), 'Auction House')
				->build('auction', $data);
			}
			else
			{
				$this->session->set_userdata(array("notification-message" => "No active auction."));
				redirect('notification/error');
			}
		}
	}
	
	public function pay()
	{
		$winner = $this->auction->isWinner();
		
		if(!$this->session->userdata('activity'))
		{
			redirect('login');
		}
		else
		{
			if(!$winner)
			{
				show_404();
			}
			else
			{
				if($this->users->getBalance($this->session->userdata('username')) >= $winner)
				{
					$this->auction->finishAuction($winner);
					$this->points->remove($this->session->userdata('id'), $winner);
					$this->db->empty_table('top_auctions_bids');
					$this->auction->createAuction();
					$this->session->set_userdata(array("notification-message" => "Your payment has been completed."));
					redirect('notification/success');
				}
				else
				{
					$this->session->set_userdata(array("notification-message" => "Not enough credits!"));
					redirect('notification/error');
				}
			}	
		}
	}
		
		
	
	public function bid()
	{
		if(!$this->session->userdata('activity'))
		{
			redirect('login');
		}
		else
		{
			if($this->auction->isEligible())
			{
				$bid = $this->input->post('bid');
				if($bid >= $this->config->item('auction_minimum_bid'))
				{
					$this->auction->bid($bid);
					$this->session->set_userdata(array("notification-message" => "Your bid has been successfully placed."));
					redirect('notification/success');
				}
				else
				{
					$this->session->set_userdata(array("notification-message" => "Your bid needs to be higher than the minimum bid."));
					redirect('notification/error');
				}
			}
			else
			{
				$this->session->set_userdata(array("notification-message" => "You are not eligible to bid on this auction."));
				redirect('notification/error');
			}
		}
	}
}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */