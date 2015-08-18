<?php

class Points_model extends CI_Model
{
	public function add($id, $amount)
	{
		$this->db->query("UPDATE top_users SET balance=balance+$amount WHERE id='$id'");
	}
	
	public function remove($id, $amount)
	{
		$this->db->query("UPDATE top_users SET balance=balance-$amount WHERe id='$id'");
	}
	
	public function log($user_id, $ref, $date)
	{
		$data = array(
			'user_id' => $user_id,
			'ref' => $ref,
			'date' => $date
		);
		
		$this->db->insert('top_paymentwall_logs', $data);
	}
	
	public function updateDailyIncome($date, $amount)
	{
		$query = $this->db->get_where("top_daily_income", array('date' => $date));
		
		if($query->num_rows() > 0)
			$this->db->query("UPDATE top_daily_income SET income=income=$amount WHERE date=$date");
		else
			$this->db->insert('top_daily_income', array('date' => $date, 'income' => $amount));
	}
	
	public function isValid($ref)
	{
		$data = array(
			'ref' => $ref
		);
		$query = $this->db->get_where('top_paymentwall_logs', $data);
		
		if($query->num_rows() > 0)
			return false;
		else
			return true;
	}
	
	public function insertSubscription($site_id, $date)
	{
		$data = array(
			'site_id' => $site_id,
			'exp_date' => $date
		);
		
		$updateData = array(
			'premium' => 1,
		);
		
		if($this->sites->isPremium($site_id))
			$this->db->delete('top_subscriptions', array('site_id' => $site_id));
			
		$this->db->insert('top_subscriptions', $data);
		
		$this->db->where('id', $site_id);
		$this->db->update('top_sites', $updateData);
	}
	
	public function removeExpiredSubscriptions($date)
	{
		$query = $this->db->get_where('top_subscriptions', array('exp_date' => $date));
		if($query->num_rows() > 0)
		{
			$data = $query->result();
			
			foreach($data as $row)
				$this->db->where('id', $row->site_id)->update('top_sites', array('premium' => 0));
				
			$this->db->delete('top_subscriptions', array('exp_date' => $date));
		}
		else
			return false;
	}
	
	
	public function getExpirationDate($site_id)
	{
		return $this->db->get_where('top_subscriptions', array('site_id' => $site_id))->row()->exp_date;
	}
}