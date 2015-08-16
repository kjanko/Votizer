<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
  * General Asset Helper
  *
  * Helps generate links to asset files of any sort. Asset type should be the
  * name of the folder they are stored in.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    the asset type (name of folder)
  * @param		string    optional, module name
  * @return		string    full url to asset
  */

function get_asset_instance()
{
	$ci =& get_instance();
	$ci->load->library('asset');
	return $ci->asset;
}

function get_ci_instance()
{
	$ci =& get_instance();
	return $ci;
}

// ------------------------------------------------------------------------

function css($asset_name, $module_name = NULL, $attributes = array())
{
	return get_asset_instance()->css($asset_name, $module_name, $attributes);
}

function theme_css($asset, $attributes = array())
{
	return css($asset, '_theme_', $attributes);
}

function css_url($asset_name, $module_name = NULL)
{
	return get_asset_instance()->css_url($asset_name, $module_name);
}

function css_path($asset_name, $module_name = NULL)
{
	return get_asset_instance()->css_path($asset_name, $module_name);
}

// ------------------------------------------------------------------------


function image($asset_name, $module_name = NULL, $attributes = array())
{
	return get_asset_instance()->image($asset_name, $module_name, $attributes);
}

function theme_image($asset, $attributes = array())
{
	return image($asset, '_theme_', $attributes);
}

function image_url($asset_name, $module_name = NULL)
{
	return get_asset_instance()->image_url($asset_name, $module_name);
}

function image_path($asset_name, $module_name = NULL)
{
	return get_asset_instance()->image_path($asset_name, $module_name);
}

// ------------------------------------------------------------------------


function js($asset_name, $module_name = NULL)
{
	return get_asset_instance()->js($asset_name, $module_name);
}

function theme_js($asset, $attributes = array())
{
	return js($asset, '_theme_', $attributes);
}

function js_url($asset_name, $module_name = NULL)
{
	return get_asset_instance()->js_url($asset_name, $module_name);
}

function js_path($asset_name, $module_name = NULL)
{
	return get_asset_instance()->js_path($asset_name, $module_name);
}

// ------------------------------------------------------------------------

function set_theme($theme)
{
	return get_asset_instance()->set_theme($theme);
}

?>