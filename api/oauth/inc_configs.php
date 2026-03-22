<?php
/**
 *
 * @package Castor\Core\REST_API
 *
 * Gathers database connection information from CMS configuration files
 *
 * @author Vince Wooll <sales@castor.net>
 *
 *  @version Castor 10.7.2
 *
 * @copyright	2005-2023 Vince Wooll
 * Castor (tm) PHP, CSS & Javascript files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly
 */


if (!defined('CASTOR_API_CMS_ROOT')) {
	define('CASTOR_API_CMS_ROOT', dirname(dirname(dirname(dirname(__FILE__)))));
	define('CASTOR_API_CASTOR_ROOT', dirname(dirname(dirname(__FILE__))));
}

if (file_exists(CASTOR_API_CMS_ROOT.DIRECTORY_SEPARATOR.'configuration.php')) {
	if (!defined('_JEXEC')) {
		define('_JEXEC', 1);
	}
	require_once CASTOR_API_CMS_ROOT.DIRECTORY_SEPARATOR.'configuration.php';

	$CONFIG = new JConfig();

	$db = $CONFIG->db;
	$host = $CONFIG->host;
	$dbprefix = $CONFIG->dbprefix;
	$dsn = 'mysql:dbname='.$db.';host='.$host;
	$username = $CONFIG->user;
	$password = $CONFIG->password;
} else {
	die(json_encode('Cant find configuration file.')); // No findie el config file!
}

define('CASTOR_API_DB_NAME', $db);
define('CASTOR_API_DB_HOST', $host);
define('CASTOR_API_DB_USERNAME', $username);
define('CASTOR_API_DB_PASSWORD', $password);
define('CASTOR_API_DB_DB_PREFIX', $dbprefix);



