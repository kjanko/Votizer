<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Register Controller

class editSite extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->general->insertUserActivity($_SERVER['REMOTE_ADDR']);
    }
	
	public function index()
	{
        if($this->session->userdata('activity'))
        {
            $userId = $this->session->userdata('id');
            $site = $this->sites->getSiteByUserId($userId);
            $user = $this->users->getUserByUserId($userId);
            if($site == false || $user == false){
                show_404();
            }else{
                $userData = array (
                    'username' => $user->username,
                    'name' => $user->name,
                    'surname' => $user->l_name,
                    'email' => $user->email
                );
                $siteData = array (
                    'url' => $site->url,
                    'title' => $site->title,
                    'description' => $site->description,
                    'category' => $site->category_id
                );
                $data = array(
                    'site' => $siteData,
                    'user' => $userData
                );
                $this->template
                    ->set_layout('editSite')
                    ->set_partial('metadata', 'partials/metadata')
                    ->set_partial('header', 'partials/headerNew')
                    ->set_partial('user', 'partials/editUser')
                    ->set_partial('site', 'partials/editSite')
                    ->set_partial('password', 'partials/editPassword')
                    ->title('IgnitionCMS | Edit site')
                    ->build('editSite', $data);
            }
        }else{
            redirect("/login");
        }
	}
    public function logout()
    {
        $this->users->logout('home');
    }
}

