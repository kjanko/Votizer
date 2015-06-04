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
	
	public function insertUserActivity($ip)
	{
		$data = array(
			'ip' => $ip
		);
		
		return $this->_ci->db->insert('top_users_activity', $data);
	}
	
	public function getUserActivityData($type, $unique)
	{
		if(!$unique)
		{
			if($type == "today")
			{
				$date = date("Y-m-d");
				$query = $this->db->query("SELECT COUNT(DISTINCT ip,`date`) as `total` FROM top_users_activity WHERE `date` >= ?", array($date));
			}
			else
			{
				$date = date("Y-m-d", time() - 60*60*24*30);
				$query = $this->db->query("SELECT COUNT(DISTINCT ip) as `total` FROM top_users_activity WHERE `date` >= ?", array($date));
			}
			
			$row = $query->result_array();
			
			return $row[0]['total'];
		}
		else
		{
			if($type == "today")
			{
				$date = date("Y-m-d");
			}
			else
			{
				$date = date("Y-m-d", time() - 60*60*24*30);
			}

			$query = $this->db->query("SELECT COUNT(*) as `total` FROM top_users_activity WHERE `date` >= ?", array($date));

			$row = $query->result_array();
			
			return $row[0]['total'];
		}
	}
	
	public function getIncome($type)
	{
		if($type == "this")
		{
			$date = date("Y-m");
		}
		else
		{
			$date = date("Y-m", time() - 60*60*24*30);
		}

		$query = $this->db->query("SELECT amount FROM top_monthly_income WHERE month=?", array($date));

		if($query->num_rows())
		{
			$row = $query->result_array();

			return $row[0]['amount'];
		}
		else
		{
			return 0;
		}
	}
}

// END General Class

/* End of file General.php */
/* Location: ./application/libraries/General.php */