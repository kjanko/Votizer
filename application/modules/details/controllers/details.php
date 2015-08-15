<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Details extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function show($id)
	{
        $navigation = $this->general->getHeaderNavigation();
        $sidebar = $this->general->getAdvertisements(0);
        $featured = $this->sites->getFeaturedData();
        $site = $this->sites->getDataById($id);

        $total = $site[0]['in_votes'] + $site[0]['out_votes'] + $site[0]['total_visitors'];
        $total = 100/$total;
        $graphData = array();
        $graphData['in_votes'] = $total * $site[0]['in_votes'];
        $graphData['out_votes'] = $total * $site[0]['out_votes'];
        $graphData['total_visitors'] = $total * $site[0]['total_visitors'];
        if(!$site)
        {
            show_404();
        }
        $rank = $this->sites->getRank($id);
        $site[0]['rank'] = $rank;
        $data = array(
            'navigation' => $navigation,
            'sidebar' => $sidebar,
            'featured' => $featured,
            'site' => $site[0],
            'graphData' => $graphData
        );


        $this->template
            ->set_layout('single_column')
            ->set_partial('metadata', 'partials/metadata')
            ->set_partial('header', 'partials/header')
            ->set_partial('featured', 'partials/featured')
            ->set_partial('footer', 'partials/footer')
            ->title($this->config->item('site_title'), 'Details')
           ->build('details', $data);
    }
}