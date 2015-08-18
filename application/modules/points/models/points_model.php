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
	
	public function getExpirationDate($site_id)
	{
		return $this->db->get_where('top_subscriptions', array('site_id' => $site_id))->row()->exp_date;
	}
}