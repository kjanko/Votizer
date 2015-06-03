<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter TopCMS Library
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	General
 * 
 */
 
class General 
{

	private $_ci;

	function __construct()
	{
		// Create an instance of CodeIgniter
		$this->_ci = &get_instance();
	}
	
	public function getNavigationData()
	{
		return $this->_ci->db->get('top_navigation')->result_array();
	}
	
	public function isIPBlacklisted($ip)
	{
		$query = $this->_ci->db
			->select('ip')
			->from('top_blacklist_ip')
			->where('ip', $ip)
		->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	public function insertBlacklistIP($ip)
	{
		if(!self::isIPBlacklisted($ip))
		{
			$data = array(
				'ip' => $ip
			);
			
			return $this->_ci->db->insert('top_blacklist_ip', $data);
		}
		else
			return false;
	}
	
	public function removeBlacklistIP($ip)
	{
		if(self::isIPBlacklisted($ip))
		{
			$data = array(
				'ip' => $ip
			);
			
			return $this->_ci->db->delete('top_blacklist_ip', $data);
		}
		else
			return false;
	}
	
	public function updateBlacklistIP($old, $new)
	{
		if(self::isIPBlacklisted($old))
		{
			$data = array(
				'ip' => $new
			);
			
			return $this->_ci->db->where('ip', $old)->update('top_blacklist_ip', $data);
		}
		else
			return false;
	}
}

// END General Class

/* End of file General.php */
/* Location: ./application/libraries/General.php */