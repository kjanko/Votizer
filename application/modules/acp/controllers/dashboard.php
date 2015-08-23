<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Dashboard Controller

class Dashboard extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Page_model', 'pages');
		
		if(!$this->session->userdata('activity') && $this->session->userdata('rank') < 2)
		{
			show_404();
		}
    }
	
	public function index()
	{		
		$data = array(
			'username' => $this->session->userdata('username'),
			'navigation' => $this->general->getNavigationData(),
			'graph' => $this->getGraph(),
			//ToDo: load this segment via AJAX to speedup the site
			'feeds' => $this->general->getXMLData('http://kjanko.com/XML.xml') 
		);
		
		$this->parser->parse('dashboard', $data);
	}
	
	private function getGraph()
	{
		$row = $this->general->getGraph();
		
		$data = array(
			'stack' => $this->arrayFormat($row),
			'top' => $this->getHighestValue($row),
			'first_date' => $this->getFirstDate($row),
			'last_date' => $this->getLastDate($row)
		);
		
		return $data;
	}
	
	private function getHighestValue($array)
	{
		if($array)
		{
			$highest = 0;

			foreach($array as $value)
			{
				if($value['ipCount'] > $highest)
				{
					$highest = $value['ipCount'];
				}
			}

			return $highest;
		}
		else
		{
			return false;
		}
	}

	private function arrayFormat($array)
	{
		if($array)
		{
			$output = "";
			$first = true;

			foreach($array as $month)
			{
				if($first)
				{
					$first = false;
					$output .= $month['ipCount'];
				}
				else
				{
					$output .= ",".$month['ipCount'];
				}
			}

			return $output;
		}
		else
		{
			return false;
		}
	}

	private function getLastDate($array)
	{
		if($array)
		{
			$value = preg_replace("/-/", " / ", $array[count($array)-1]['date']);

			return preg_replace("/ \/ [0-9]*$/", "", $value);
		}
		else
		{
			return false;
		}
	}

	private function getFirstDate($array)
	{
		if($array)
		{
			$value = preg_replace("/-/", " / ", $array[0]['date']);

			return preg_replace("/ \/ [0-9]*$/", "", $value);
		}
		else
		{
			return false;
		}
	}
	
	public function pages()
	{
		$data = array(
			'username' => $this->session->userdata('username'),
			'pages' => $this->pages->getPages()
		);
		
		$this->parser->parse('pages/page', $data);
	}
	
	public function pages_edit($id, $backUrl)
	{
		$data = array(
			'page' => $this->pages->getPageById($id),
			'backUrl' => $backUrl
		);
		
		$this->parser->parse('pages/pages-edit', $data);
	}
	
	public function pages_add($backUrl)
	{
		$data = array(
			'backUrl' => $backUrl
		);

		$this->parser->parse('pages/pages-add', $data);
	}

    public function addNavigation()
    {
        $this->parser->parse('settings/addNavigation');
    }
	
	public function users()
	{
		$data = array(
			'username' => $this->session->userdata('username'),
			'users' => $this->db->get('top_users')->result_array()
		);
		
		$this->parser->parse('users/users', $data);
	}
	
	public function users_add()
	{
		$this->parser->parse('users/users-add');
	}
	
	public function users_edit($username,$url)
	{
		$data = array(
			'user' => $this->users->get_user_data($username),
			'backUrl' => $url
		);
		
		$this->parser->parse('users/users-edit', $data);
	}

    public function addPremium($id, $url)
    {
        $site = $this->db->get_where('top_sites', array('id' => $id))->result_array();
        $user = $this->db->get_where('top_users', array('id' => $site['0']['user_id']))->result_array();
        $username = $user['0']['username'];
        $title = $site['0']['title'];

        if($site['0']['premium'] == 0)
            $date = null;
        else
            $date = $this->db->get_where('top_subscriptions', array('site_id' => $id))->row()->exp_date;

        $data = array(
            'id' => $id,
            'username' => $username,
            'backUrl' => $url,
            'title' => $title,
            'date' => $date
        );

        $this->parser->parse('settings/addPremium', $data);
    }
	
	public function sites()
	{		
		$data = array(
			'username' => $this->session->userdata('username'),
			'sites' => $this->sites->getData()
		);
		
		$this->parser->parse('sites/sites', $data);
	}
	
	public function sites_edit($id)
	{
		$data = array(
			'id' => $this->sites->getDataById($id),
		);
		
		$this->parser->parse('sites/sites-edit', $data);
	}
	
	public function blacklist()
	{		
		$data = array(
			'username' => $this->session->userdata('username'),
			'blacklistIps' => $this->general->getBlacklistData()
		);
		
		$this->parser->parse('blacklist/blacklist', $data);
	}
	
	public function blacklistIps()
	{
		$data = array(
			'blacklistIps' => $this->general->getBlacklistData()
		);
		
		$this->parser->parse('blacklist/blacklistIps', $data);
	}
	
	public function blacklistUsers()
	{
		$data = array(
			'blacklistUsers' => $this->general->getBlacklistUserData()
		);
		
		$this->parser->parse('blacklist/blacklistUsers', $data);
	}
    public function blacklistUrls()
    {
        $data = array(
            'blacklistUrls' => $this->general->getBlacklistUrlData()
        );

        $this->parser->parse('blacklist/blacklistUrls', $data);
    }
    public function blacklistProfanity()
    {
        $data = array(
            'blacklistProfanity' => $this->general->getBlacklistProfanityData()
        );

        $this->parser->parse('blacklist/blacklistProfanity', $data);
    }
    public function categories()
    {
        $data = array(
            'username' => $this->session->userdata('username'),
            'categories' => $this->db->get('top_categories')->result_array()
        );

        $this->parser->parse('settings/categories', $data);
    }
	
    public function advertisements()
    {
        $data = array(
            'username' => $this->session->userdata('username'),
            'adverts' => $this->db->get('top_advertisements')->result_array()
        );

        $this->parser->parse('settings/advertisements', $data);
    }
	
    public function themes()
    {	
        $themes = array_filter(scandir($_SERVER['DOCUMENT_ROOT']. 'addons/themes'), function($item) {
          return !is_dir($_SERVER['DOCUMENT_ROOT'] . 'addons/themes' . $item) && $item==explode('.', $item);
        });
		
        $data = array(
            'username' => $this->session->userdata('username'),
            'themes' => $themes,
            'active' => $this->config->item("theme")
        );
        $this->parser->parse('settings/themeChanger', $data);
    }

    public function navigation()
    {
        $data = array(
            'username' => $this->session->userdata('username'),
            'navigation' => $this->db->order_by("position")->get('top_navigation_header')->result_array()
        );

        $this->parser->parse('settings/navigation', $data);
    }

    public function settings()
    {
        $data = array(
            'username' => $this->session->userdata('username'),
            'recaptcha_secret_key' => $this->config->item("recaptcha_secret_key"),
            'recaptcha_api_key' => $this->config->item("recaptcha_api_key"),
            'paymentwall_secret_key' => $this->config->item("paymentwall_secret_key"),
            'paymentwall_app_key' => $this->config->item("paymentwall_app_key"),
            'paymentwall_widget_code' => $this->config->item("paymentwall_widget_code"),
            'shop_starter' => $this->config->item("shop_starter"),
            'shop_value' => $this->config->item("shop_value"),
            'shop_pro' => $this->config->item("shop_pro"),
            'shop_premium' => $this->config->item("shop_premium"),
            'site_title' => $this->config->item("site_title"),
            'site_keywords' => $this->config->item("site_keywords"),
            'site_description' => $this->config->item("site_description"),
            'admin_mail' => $this->config->item("admin_mail"),
            'logo_blue' => $this->config->item("logo_blue"),
            'logo_gray' => $this->config->item("logo_gray"),
            'middle_section_title' => $this->config->item("middle_section_title"),
            'middle_section_description' => $this->config->item("middle_section_description"),
            'auction_minimum_bid' => $this->config->item("auction_minimum_bid"),
            'auction_minimum_rank' => $this->config->item("auction_minimum_rank"),
            'disqus_shortname' => $this->config->item("disqus_shortname")
        );

        $this->parser->parse('settings/settings', $data);
    }

    public function subscriptions()
    {
        $subscriptions = $this->db->get('top_subscriptions')->result_array();
        $counter = 0;
        foreach($subscriptions as $item)
		{
            $site = $this->db->get_where('top_sites', array('id' => $item['site_id']))->result_array();
            $user = $this->db->get_where('top_users', array('id' => $site['0']['user_id']))->result_array();
            $subscriptions[$counter]['username'] = $user['0']['username'];
            $subscriptions[$counter]['title'] = $site['0']['title'];
            $counter++;
        }
        $data = array(
            'username' => $this->session->userdata('username'),
            'subscriptions' => $subscriptions
        );

        $this->parser->parse('settings/subscriptions', $data);
    }

	public function logout()
	{
		$this->users->logout('acp');
	}
}

/* End of file dashboard.php */
/* Location: ./application/modules/acp/controllers/dashboard.php */