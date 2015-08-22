<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function getInstance()
{
	$ci =& get_instance();
	return $ci;
}

function getConfigValue($var)
{
	return getInstance()->config->item($var);
}

function getSiteTitle($site_id)
{
	$site = getInstance()->sites->getDataById($site_id);
	return $site[0]['title'];
}

function getSiteRank($site_id)
{
	return getInstance()->sites->getRank($site_id);
}

?>