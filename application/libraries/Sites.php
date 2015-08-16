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
		if($this->_ci->db->get_where('top_sites', array('id' => $id))->row()->premium == 0)
			return false;
		else 
			return true;
	}
    public function create($title, $description, $userId, $categoryId, $url)
    {
		$date = date("Y-m-d");
        // Set the data
        $data = array(
            'user_id' => $userId,
            'category_id' => $categoryId,
            'title' => $title,
            'description' => $description,
            'url' => $url,
			'date' => $date
        );
        // Insert the data
        $this->_ci->db->insert('top_sites', $data);

        return true;
    }
	
	public function remove($id)
	{
		// Remove the site
		$this->_ci->db->delete('top_sites', array('id' => $id));
		
		return true;
	}
	
	public function update($id, $title, $description, $categoryId, $in, $out, $bannerUrl, $url, $premium)
	{
		$data = array(
			'title' => $title,
			'description' => $description,
			'category_id' => $categoryId,
			'in_votes' => $in,
			'out_votes' => $out,
			'banner_url' => $bannerUrl,
			'url' => $url,
			'premium' => $premium
		);
		
		$this->_ci->db
			->where('id', $id)
			->update('top_sites', $data);
		
		return true;
	}
    public function updateUCP($userId, $url, $description, $title, $categoryId)
    {
        $data = array(
            'title' => $title,
            'description' => $description,
            'category_id' => $categoryId,
            'url' => $url,
        );

        $this->_ci->db
            ->where('user_id', $userId)
            ->update('top_sites', $data);

        return true;
    }
	
	public function getDataById($id)
	{
		$result = $this->_ci->db->get_where('top_sites', array('id' => $id));
		
		if($result->num_rows() > 0)
		{
			$data = $result->result_array();		
			$data[0]['username'] = $this->_ci->users->getUsername($data[0]['user_id']);
			
			return $data;
		}
		else
			return false;
	}
	
	public function getData()
	{
		$data = $this->_ci->db->order_by("in_votes", "desc")->get('top_sites')->result_array();
		
		foreach($data as $k => $v)
		{
			$username = $this->_ci->users->getUsername($data[$k]['user_id']);
			$data[$k]['username'] = $username;
		}
		
		return $data;
	}
	
	public function getDataByCategory($id)
	{
		$data = $this->_ci->db->order_by("in_votes", "desc")->get_where('top_sites', array('category_id' => $id))->result_array();
		
		foreach($data as $k => $v)
		{
			$username = $this->_ci->users->getUsername($data[$k]['user_id']);
			$data[$k]['username'] = $username;
		}
		
		return $data;
	}
	
	public function getFeaturedData()
	{
		return $this->_ci->db->get_where('top_sites', array('featured' => 1))->result_array();
	}
	
	public function getSiteByUserId($userId)
	{
        $query = $this->_ci->db->get_where('top_sites', array('user_id' => $userId));
		
        if($query->num_rows() > 0)
		{
            return $query->row();
        }
        else
        {
            return false;
        }
    }
	
	public function getRank($id)
	{
        $servers = self::getData();
        $pos = 1;
		
        foreach($servers as $server)
		{
            if($server['id'] == $id)
                break;
            $pos = $pos + 1;
        }
        return $pos;
    }
}

// END Sites Class

/* End of file Sites.php */
/* Location: ./application/libraries/Sites.php */