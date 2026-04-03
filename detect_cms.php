<?php
/**
 * Detect the host CMS 
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
 * Detects which CMS Castor is installed on.
 * 
 * In theory Castor can (with the appropriate supporting CMS specific functionality) be run on any PHP CMS, although in practice only Joomla is supported. First looks to see if we are installed on a recognised CMS, if _CASTOR_DETECTED_CMS isn't found then we'll scan CASTOR_REMOTEPLUGINS_ABSPATH (typically /castor/remote_plugins/) to find another file that will set the Detected CMS.
 * 
 **/
 
if (file_exists(CASTORCONFIG_ABSOLUTE_PATH.JRDS.'libraries'.JRDS.'src'.JRDS.'Version.php')) {
	if (!defined('JPATH_PLATFORM')) {
		define('JPATH_PLATFORM', 1);
	}

	require_once CASTORCONFIG_ABSOLUTE_PATH.JRDS.'libraries'.JRDS.'src'.JRDS.'Version.php';

	$jversion = new Joomla\CMS\Version();
	if ($jversion::MAJOR_VERSION == '4') {
		define('_CASTOR_DETECTED_CMS', 'joomla4');
		define('_CASTOR_DETECTED_CMS_SPECIFIC_FILES', CASTOR_CMSSPECIFIC_ABSPATH._CASTOR_DETECTED_CMS.JRDS);
	}
	if ($jversion::MAJOR_VERSION == '5') {
		define('_CASTOR_DETECTED_CMS', 'joomla5');
		define('_CASTOR_DETECTED_CMS_SPECIFIC_FILES', CASTOR_CMSSPECIFIC_ABSPATH._CASTOR_DETECTED_CMS.JRDS);
	}
}

if (!defined('_CASTOR_DETECTED_CMS')) {
	define('_CASTOR_DETECTED_CMS', 'unknown');
}

if (_CASTOR_DETECTED_CMS == 'unknown') {
	$message = "Error, cannot detect the current CMS.<br/>  It is possible that you have upgraded your CMS's version and the version of Castor you're running isn't aware of the new version of the CMS. If that's the case then you will need to upgrade Castor too, however before you do please <a href='http://www.castor.net/manual/installation-and-upgrading/11-upgrading'>see this page.</a>";

	throw new Exception($message);
}

