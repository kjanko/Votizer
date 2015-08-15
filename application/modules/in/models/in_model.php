<?php

class In_model extends CI_Model
{
	public function validate($ip, $id, $type)
	{
		$query = $this->db->get_where('top_daily_voters', array('ip' => $ip, 'site_id' => $id, 'type' => $type));
		
		$this->db->query("UPDATE top_sites SET total_visitors=total_visitors+1 WHERE id='$id'");

		if($query->num_rows() > 0)
			return false;
		else
			return true;
	}
	
	public function insert($ip, $id, $type)
	{
		$data = array(
			'ip' => $ip,
			'site_id' => $id,
			'type' => $type
		);
		
		$this->db->insert('top_daily_voters', $data);
		
		if($type == 0)
			$this->db->query("UPDATE top_sites SET in_votes=in_votes+1 WHERE id='$id'");
		else
			$this->db->query("UPDATE top_sites SET out_votes=out_votes+1 WHERE id='$id'");
	}
}