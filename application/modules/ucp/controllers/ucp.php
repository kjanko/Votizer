<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ucp extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
		
		if(!$this->session->userdata('activity'))
		{
			redirect('login');
		}
    }
	
	public function index()
	{			
		if($this->session->userdata('activity'))
        {
			$this->load->model('auction/auction_model', 'auction');

            $userId = $this->session->userdata('id');
            $site = $this->sites->getSiteByUserId($userId);
            $user = $this->users->getUserById($userId);
				
            if(empty($site) || empty($user))
			{
                show_404();
            }
			else
			{
                $winnerBid = $this->auction->isWinner();

                $servers = $this->sites->getDataById($this->users->getSiteId($this->session->userdata('id')));

                if($site->premium == 1)
                {
                    $this->load->model('points/points_model', 'points');
                    $expiry_date = $this->points->getExpirationDate($site->id);
                }
                else
                    $expiry_date = "no active subscription";
					
                $userData = array(
                    'username' => $user->username,
                    'name' => $user->name,
                    'surname' => $user->l_name,
                    'email' => $user->email
                );
				
                $siteData = array(
                    'url' => $site->url,
                    'title' => $site->title,
                    'description' => $site->description,
                    'category' => $site->category_id
                );
				
				$this->load->model('category/category_model', 'categories');

				$currentCategory['name'] = $this->categories->getCategoryName($site->category_id);
				$currentCategory['id'] = $site->category_id;
				$categories = $this->categories->getData();
				
				$data = array(
					'categories' => $categories,
					'currentCategory' => $currentCategory,
					'site' => $siteData,
                    'user' => $userData,
					'expiration_date' => $expiry_date,
					'servers' => $servers,
                    'analyticsPropertyID' => $this->config->item('analytics_property_id')
				);
				
				if($winnerBid)
					$data['winnerBid'] = $winnerBid;
		
				$this->template
					->set_layout('default')
					->set_partial('metadata', 'partials/metadata')
					->set_partial('header', 'partials/header')
					->set_partial('sidebar', 'partials/sidebar')
					->set_partial('featured', 'partials/featured')
					->set_partial('footer', 'partials/footer')
					->title($this->config->item('site_title'), 'User Control Panel')
				->build('ucp', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */