<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| CMS Settings
| -------------------------------------------------------------------------
|
| All the settings related to the CMS's functionality are located here.
|
*/

/*
| -------------------------------------------------------------------------
| Google API Captcha
| -------------------------------------------------------------------------
*/

$config['recaptcha_secret_key'] = '6LcePAATAAAAABjXaTsy7gwcbnbaF5XgJKwjSNwT';
$config['recaptcha_api_key'] = '6LcePAATAAAAAGPRWgx90814DTjgt5sXnNbV5WaW';

/*
| -------------------------------------------------------------------------
| PaymentWall API
| -------------------------------------------------------------------------
*/

$config['paymentwall_secret_key'] = '';
$config['paymentwall_app_key'] = '';
$config['paymentwall_widget_code'] = '';

/*
| -------------------------------------------------------------------------
| Shop Prices
| -------------------------------------------------------------------------
*/

$config['shop_starter'] = '15';
$config['shop_value'] = '39';
$config['shop_pro'] = '59';
$config['shop_premium'] = '90';

/*
| -------------------------------------------------------------------------
| Site Details
| -------------------------------------------------------------------------
*/

$config['site_title'] = 'Votizer';
$config['site_keywords'] = 'Votizer, Topsite, php, Minecraft, wow';
$config['site_description'] = "This is my site's description.";
$config['admin_mail'] = '';

/*
| -------------------------------------------------------------------------
| Theme Details
| -------------------------------------------------------------------------
*/

$config['logo_blue'] = 'votizer';
$config['logo_gray'] = 'cms';
$config['middle_section_title'] = 'Community Servers';
$config['middle_section_description'] = 'Servers ranked according to in votes.';
$config['disqus_shortname'] = '';

/*
| -------------------------------------------------------------------------
| Auction Settings
| -------------------------------------------------------------------------
*/

$config['auction_minimum_bid'] = '0';
$config['auction_minimum_rank'] = '0';


/* End of file settings.php */
/* Location: ./application/config/settings.php */