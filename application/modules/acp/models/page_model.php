<?php

class Page_model extends CI_Model
{
	public function getPages()
	{
		return $this->db->get('top_pages')->result_array();
	}
	
	public function getPageById($id)
	{
		$query = $this->db->get_where('top_pages', array('id' => $id));
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
			return false;
	}

	public function delete($id)
	{
		$this->_ci->db->delete('top_pages', array('id' => $id));
	}

	public function create($controller, $title, $content)
	{
		$data = array(
			'controller' => $controller,
			'title' => $title,
			'content' => $content
		);

		$this->db->insert("top_pages", $data);
	}

	public function update($id, $controller, $title, $content)
	{
		$data = array(
			'controller' => $controller,
			'title' => $title,
			'content' => $content
		);

		if($this->db->where('id', $id)->update("top_pages", $data))
			return true;
		else
			return false;
	}
}