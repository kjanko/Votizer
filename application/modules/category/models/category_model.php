<?php

class Category_model extends CI_Model
{
	public function getData()
	{
		return $this->db->get('top_categories')->result_array();
	}

	public function getCategoryId($name)
	{
		$query = $this->db->get_where('top_categories', array('category' => $name));
		
		if($query->num_rows() > 0)
			return $query->row()->id;
		else
			return true;
	}
	
	public function getCategoryName($id)
	{
		$query = $this->db->get_where('top_categories', array('id' => $id));
		
		if($query->num_rows() > 0)
			return $query->row()->category;
		else
			return true;
	}
}