<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter TopCMS Library
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Sites
 * 
 */
 
class Sites
{

	private $_ci;

	function __construct()
	{
		// Create an instance of CodeIgniter
		$this->_ci = &get_instance();
	}

	/*
	|-------------------------------------|
	|           SITES                     |
	|-------------------------------------|
										 */
	
	public function isPremium($id)
	{
		if($this->_ci->$query = $this->db->get_where('top_sites', array('id' => $id))->get()->row()->premium == 0)
			return false;
		else 
			return true;
	}
	public function create($title, $content, $userid, $banner, $url)
	{
		// Set the data
		$data = array(
			'title' => $title,
			'content' => $content,
			'user_id' => $userid,
			'banner' => $banner,
			'url' => $url
		);
		// Insert the data
		$this->_ci->db->insert('sites', $data);
		
		return true;
	}
	
	public function remove($id)
	{
		// Remove the site
		$this->_ci->db->delete('sites', array('id' => $id));
		
		return true;
	}
	
	public function update($id, $title, $content, $banner, $url)
	{
		$data = array(
			'title' => $title,
			'content' => $content,
			'user_id' => $userid,
			'banner' => $banner,
			'url' => $url
		);
		
		$this->_ci->db
			->where('id', $id)
			->update('top_sites', $data);
		
		return true;
	}
	
	public function getDataById($id)
	{
		return $this->_ci->db
					->get_where('top_sites', array('id' => $id))
					->result_array();
	}
	
	public function getData()
	{
		$data = $this->_ci->db->get('top_sites')->result_array();
		foreach($data as $k => $v)
		{
			$username = $this->_ci->users->getUsername($data[$k]['user_id']);
			$data[$k]['username'] = $username;
		}
		
		return $data;
	}
}

// END Sites Class

/* End of file Sites.php */
/* Location: ./application/libraries/Sites.php */