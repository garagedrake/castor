<?php
/**
 * Core file.
 *
 * @author Vince Wooll <sales@castor.net>
 *
 *  @version Castor 10.7.2
 *
 * @copyright	2005-2023 Vince Wooll
 * Castor (tm) PHP, CSS & Javascript files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly
 **/

// ################################################################
defined('_CASTOR_INITCHECK') or die('');
// ################################################################
	
	/**
	 *
	 * @package Castor\Core\Classes
	 *
	 */
	#[AllowDynamicProperties]
class castor_check_support_key
{

	/**
	 *
	 *
	 *
	 */

	public function __construct($task = '')
	{
		$this->task = $task;
		$this->key_valid = false;

		$this->shop_status = 'CLOSED';
		$this->check_license_key();
	}
	
	/**
	 *
	 *
	 *
	 */

	public function get_shop_status()
	{
		$request = 'request=shop_status';
		$response = query_shop($request);
		if (is_object($response)) {
			$this->shop_status = $response->status;
		} else {
			$this->shop_status = 'CLOSED';
		}
	}
	
	/**
	 *
	 *
	 *
	 */

	public function remove_plugin_licenses_file()
	{
		unlink(CASTOR_TEMP_ABSPATH.$this->user_plugin_license_temp_file_name);
	}
	
	/**
	 *
	 *
	 *
	 */

	public function get_user_plugin_licenses()
	{
		include_once CASTOR_TEMP_ABSPATH.$this->user_plugin_license_temp_file_name;
		$this->plugin_licenses = plugin_licenses();
	}
	
	/**
	 *
	 *
	 *
	 */

	public function check_license_key($force = false, $key = '')
	{
		$this->key_valid = true;
		$this->key_hash = 'CASTOR-FREE-LICENSE';
		$this->expires = 'Never';
		$this->key_status = 'Active';
		$this->owner = 'Castor Community';
		$this->license_name = 'Castor Free Edition';
		$this->allows_plugins = '1';
		$this->is_trial_license = false;
		$this->allowed_plugins = array();
	}
}

