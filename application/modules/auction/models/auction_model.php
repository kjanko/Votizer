<?php

class Auction_model extends CI_Model
{
	// array, return the current active auction

	public function getActiveAuction()
	{
		return $this->db->get_where('top_auctions', array('status' => 1))->result_array();
	}
	
	public function getHighestBidders()
	{
		return $this->db->order_by('current_bid')->limit(5)->get('top_auctions_bids')->result_array();	
	}
	
	// void, create new auction
	
	public function createAuction()
	{
		$date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime('+2 Weeks'));
		$sponsored = self::endCycle($date, 1); // 1 month
				
		$data = array(
			'status' => 1,
			'date_open' => $date,
			'date_close' => $endDate,
			'sponsored_start' => $endDate,
			'sponsored_close' => $sponsored
		);
		
		$this->db->insert('top_auctions', $data);
	}
	
	// void, close the active auction
	
	public function closeAuction()
	{
		$data = array(
			'status' => 0,
			'winner_id' => self::getHighestBidderSiteId(),
			'winner_bid' => self::getHighestBid()
		);
		$this->db->where('status', 1)->update('top_auctions', $data);
	}
	
	//void, finish the auction
	
	public function finishAuction($winner_bid)
	{
		$this->db->where('status', 0)->where('winner_bid', $winner_bid)->update('top_auctions', array('status' => 2));
		$this->db->update('top_sites', array('featured' => 0));
		$this->db->where('user_id', $this->session->userdata('id'))->update('top_sites', array('featured' => 1));
	}
	
	// void, post a bid
	
	public function bid($bid)
	{
		$data = array();
		
		$date = date('Y-m-d');
		$auctionId = self::getCurrentAuctionId();
		$siteId = $this->sites->getSiteByUserId($this->session->userdata('id'))->id;
		
		if($date >= self::getEndingDate())
		{
			$this->session->set_userdata(array("notification-message" => "This auction is no longer active."));
			redirect('notification/error');
		}
		else
		{
		
			if($this->db->get_where('top_auctions_bids', array('site_id' => $siteId))->num_rows() > 0)
			{
				$data = array(
					'current_bid' => self::getCurrentBid() + $bid,
					'site_id' => $siteId, 
					'auction_id' => $auctionId
				);
				
				$this->db->update('top_auctions_bids', $data);
			}
			else
			{
				$data = array(
					'current_bid' => $bid,
					'site_id' => $siteId, 
					'auction_id' => $auctionId
				);
				$this->db->insert('top_auctions_bids', $data);
			}
		}
	}
	
	// string, returns ending date
	
	public function getEndingDate()
	{
		return $this->db->where('status', 1)->get('top_auctions')->row()->date_close;	
	}
	
	// int, get the bid of the current loggedin user
	
	public function getCurrentBid()
	{
		$siteId = $this->sites->getSiteByUserId($this->session->userdata('id'))->id;
		
		if($this->db->get_where('top_auctions_bids', array('site_id' => $siteId))->num_rows() > 0)
			return $this->db->get_where('top_auctions_bids', array('site_id' => $siteId))->row()->current_bid;
		else
			return 0;
	}
	
	//int get the highest bid
	
	public function getHighestBid()
	{		
		return $this->db->order_by('current_bid')->limit(1)->get('top_auctions_bids')->row()->current_bid;	
	}
	
	//int, get site id of the highest bidder
	
	public function getHighestBidderSiteId()
	{
		return $this->db->order_by('current_bid')->limit(1)->get('top_auctions_bids')->row()->site_id;
	}

	//int, the total amount of bids on current auction
	
	public function getTotalBids()
	{
		return $this->db->get_where('top_auctions_bids', array('auction_id' => self::getCurrentAuctionId()))->num_rows();
	}
	
	//int, get the id of the current active auction
	
	public function getCurrentAuctionId()
	{
		return $this->db->get_where('top_auctions', array('status' => 1))->row()->id;
	}
	
	// bool, check if user is eligible for bidding
	
	public function isEligible()
	{
		$siteId = $this->sites->getSiteByUserId($this->session->userdata('id'))->id;
		
		if($this->sites->isPremium($siteId) && ($this->sites->getRank($siteId) < $this->config->item('auction_minimum_rank')))
			return true;
		else
			return false;
	}
	
	// checks if logged in user is a winner and returns his winning bid
	
	public function isWinner()
	{
		$site = $this->sites->getSiteByUserId($this->session->userdata('id'));
		
		if($this->db->get_where('top_auctions', array('winner_id' => $site->id, 'status' => 0))->num_rows() > 0)
		{
			return $this->db->get_where('top_auctions', array('winner_id' => $site->id, 'status' => 0))->row()->winner_bid;
		}
		else
			return false;
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