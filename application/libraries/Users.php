<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter TopCMS Library
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Users
 * 
 */
 
class Users 
{

	private $_ci;

	function __construct()
	{
		// Create an instance of CodeIgniter
		$this->_ci = &get_instance();
	}

	/*
	|-------------------------------------|
	|           USERS                     |
	|-------------------------------------|
										 */
	
	/**
	 *
	 * Creates a session and sets the user's necessary data.
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @return bool
	 *
	 */
	
	public function login($username, $password)
	{
		if(self::isBanned($username))
		{
			return "Banned";
		}
		else
		{	
			$hash = sha1(strtoupper($password));
			
			$query = $this->_ci->db
				->select('username', 'password')
				->from('top_users')
				->where('username', $username)
				->where('password', $hash)
			->get();
			
			// If such account exists
			if($query->num_rows() > 0)
			{
				// Get the user ID
				$id = self::getUserId($username);
				// Get the user rank
				$rank = self::getUserRank($username);
				
				// Set the data
				$data = array(
					'id' => $id,
					'username' => $username,
					'password' => $hash,
					'activity' => TRUE,
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'rank' => $rank
				);
				
				// Pass the data
				$this->_ci->session->set_userdata($data);
				
				return "Good";
			}
			else
				return "Bad";
		}
	}
	
	/**
	 *
	 * Destroy a session.
	 *
	 * @access public
	 * @param string
	 * @return void
	 *
	 */
	
	public function logout($location)
	{
		// Check if the user is logged in
		if($this->_ci->session->userdata('activity'))
		{
			// Destroy the session
			$this->_ci->session->sess_destroy();
			// Redirect
			redirect('/'.$location);
		}
		else
		{
			// Throw an error
			show_error('You are not logged in!');
		}
	}
	
	/**
	 *
	 * Returns data about a user.
	 *
	 * @access public
	 * @param string
	 * @return array
	 *
	 */
	
	public function get_user_data($username)
	{
		return $this->_ci->db->get_where('top_users', array('username' => $username))->result_array();
	}
	
	/**
	 *
	 * Returns the amount of registered users.
	 *
	 * @access public
	 * @return int
	 *
	 */
	
	public function getTotalUsers()
	{
		return $this->_ci->db->get('top_users')->num_rows();
	}
	
	/**
	 *
	 * Returns the amount of online users.
	 *
	 * @access public
	 * @return int
	 *
	 */
	
	public function getUsersOnline()
	{
		return $this->_ci->db->get('ci_session')->num_rows();
	}
	
	/**
	 *
	 * Returns user's ID
	 *
	 * @access public
	 * @param string
	 * @return row
	 *
	 */
	
	public function getUserId($username)
	{
		$query = $this->_ci->db->select('id')->from('top_users')->where('username', $username)->get();
		
		if($query->num_rows() > 0)
			return $query->row()->id;
		else
			return false;
	}
	
	/**
	 *
	 * Returns user's username
	 *
	 * @access public
	 * @param int
	 * @return row
	 *
	 */
	
	public function getUsername($id)
	{
		return $this->_ci->db->select('username')->from('top_users')->where('id', $id)->get()->row()->username;
	}
	
	/**
	 *
	 * Returns user's rank
	 *
	 * @access public
	 * @param string
	 * @return row
	 *
	 */
	
	public function getUserRank($username)
	{
		return $this->_ci->db->select('rank')->from('top_users')->where('username', $username)->get()->row()->rank;
	}
	
	/**
	 *
	 * Checks if user is banned or not
	 *
	 * @access public
	 * @param string
	 * @return row
	 *
	 */
	
	public function isBanned($username)
	{
		$query = $this->_ci->db->select('blacklist')->from('top_users')->where('username', $username)->get();
		
		if($query->num_rows() > 0)
			return $query->row()->blacklist;
		else
			return false;
	}
	
	/**
	 *
	 * Returns the user's balance
	 *
	 * @access public
	 * @param string
	 * @return int
	 *
	 */
	
	public function getBalance($username)
	{
		$query = $this->_ci->db->select('balance')->from('top_users')->where('username', $username)->get();
		
		if($query->num_rows() > 0)
			return $query->row()->balance;
		else
			return false;
	}
	
	public function updateBalance($username, $new)
	{
		$this->_ci->db->query("UPDATE top_users SET balance='$new' WHERE username='$username'");
	}
	
	/**
	 *
	 * Creates a new user
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param string
	 * @return bool
	 *
	 */
	
	public function doesExist($username, $email)
	{
        // Check if username already exists
        if($this->_ci->db->select('username')->from('top_users')->where('username', $username)->get()->num_rows() > 0)
        {
            return true;
        }
        // Check if email already exists
        else if($this->_ci->db->select('email')->from('top_users')->where('email', $email)->get()->num_rows() > 0)
        {
            return true;
        }
		
        return false;
    }

    public function emailTaken($email, $id){
        // Check if email already exists
        if(!$this->_ci->db->select('email')->from('top_users')->where('email', $email)->where('id !=', $id)->get()->num_rows() <= 0)
        {
            return true;
        }
        return false;
    }

    public function create($fname, $lname, $username, $password, $email, $rank)
    {
        $hash = sha1(strtoupper($password));

        // Set the data
        $data = array(
            'name' => $fname,
            'l_name' => $lname,
            'username' => $username,
            'password' => $hash,
            'email' => $email,
            'rank' => $rank
        );

        // Check if user already exists
        if(self::doesExist($username,$email))
		{
            return false;
        }
        // Insert the data
        else
        {
            $this->_ci->db->insert('top_users', $data);
        }

        return true;
    }
	
	/**
	 *
	 * Updates user's data
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @return bool
	 *
	 */

    public function update($id, $username, $fname, $lname, $email, $rank)
    {
        // Set the data
        $data = array(
            'username' => $username,
            'email' => $email,
            'name' => $fname,
            'l_name' => $lname,
            'rank' => $rank
        );
        // Update the user
        $this->_ci->db
            ->where('id', $id)
            ->update('top_users', $data);

        return true;
    }
    public function updateUCP($id, $fname, $lname, $email)
    {
        // Set the data
        $data = array(
            'email' => $email,
            'name' => $fname,
            'l_name' => $lname,
        );
        // Update the user
        $this->_ci->db
            ->where('id', $id)
            ->update('top_users', $data);

        return true;
    }
	
    public function updateSiteId($id, $siteId)
	{
        $data = array(
            's_id' => $siteId
        );
		
        $this->_ci->db
            ->where('id', $id)
            ->update('top_users', $data);
        return true;
    }
	
	public function getSiteId($user_id)
	{
		return $this->_ci->db->where('user_id', $user_id)->get('top_sites')->row()->id;
	}
	
	/**
	 *
	 * Remove a user.
	 *
	 * @access public
	 * @param string
	 * @return bool
	 *
	 */
	
	public function remove($username)
	{
		if($this->_ci->session->userdata('username') != $username)
		{
			// Get the user's ID
			$id = self::getUserId($username);
			// Get the user's rank
			$rank = self::getUserRank($username);
			// Delete the user
			$this->_ci->db->delete('top_users', array('username' => $username));
			// Delete the sites related to the user
			$this->_ci->db->delete('top_sites', array('user_id' => $id));
			
			return true;
		}
		else
			return false;
	}
	
	/**
	 *
	 * Changes the user's password.
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param string
	 * @return bool
	 *
	 */

    public function changePassword($username, $old_password, $new_password)
    {
        $hash = sha1(strtoupper($old_password));
        $new_hash = sha1(strtoupper($new_password));

        // Get the data
        $query = $this->_ci->db
            ->select('username', 'password')
            ->from('top_users')
            ->where('username', $username)
            ->where('password', $hash)
            ->get();

        // Check if such user exists
        if($query->num_rows() <= 0)
        {
            return false;
        }
        else
        {
            // Set the data
            $data = array(
                'password' => $new_hash
            );

            // Update the data
            $this->_ci->db
                ->where('username', $username)
                ->update('top_users', $data);

            return true;
        }
    }
	
	public function getUserById($id)
	{
        $query = $this->_ci->db->get_where('top_users', array('id' => $id));
		
        if($query->num_rows() > 0)
		{
            return $query->row();
        }
        else
        {
            return false;
        }
    }
}

// END Users Class

/* End of file Users.php */
/* Location: ./application/libraries/Users.php */