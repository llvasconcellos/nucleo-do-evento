<?php
/**
 * SEF module for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

$debug = 0;

if ($mosConfig_sef) {
//shumisha end of removal
 
	// Load language file.
	if (file_exists($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/language/'.$mosConfig_lang.'.php')){
	  include($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/language/'.$mosConfig_lang.'.php');
	}
	else {
	  include($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/language/english.php');
	}

	// Load config data.
	$sef_config_class = $GLOBALS['mosConfig_absolute_path']."/administrator/components/com_sef/sef.class.php";
	$sef_config_file = $GLOBALS['mosConfig_absolute_path']."/administrator/components/com_sef/config/config.sef.php";

	if (!is_readable($sef_config_file)) die(_COM_SEF_NOREAD."( $sef_config_file )<br />"._COM_SEF_CHK_PERMS);
	if (is_readable($sef_config_class)) require_once($sef_config_class);
	else die(_COM_SEF_NOREAD."( $sef_config_class )<br />"._COM_SEF_CHK_PERMS);

	$sefConfig = new SEFConfig();

	// Check for kind of SEF or no SEF at all
	// V 1.2.4.l : removed : all urls are now processed by sef404 class, to allow for automatic redirects from non-sef/joomla sef to sh404SEF
/*	if (strstr($_SERVER['REQUEST_URI'], 'index.php/content/view/') || strstr($_SERVER['REQUEST_URI'], 'index.php/component/option,') || strstr($_SERVER['REQUEST_URI'], '/component/option,')) {
		// Gewone SEF component
		require_once('functions.php');
		decodeurls_mambo();
	}
	elseif (strstr($_SERVER['REQUEST_URI'], 'index.php/view/')) {
		//Geen gewone SEF, maar wel een ander soort SEF, bijvoorbeeld die van Tim
		require_once('functions.php');
		decodeurls_tim();
	}
	else {
		//Anders is het een gewone URL of die van sef404
	}
*/

	if ($sefConfig->Enabled) {

		$sef404 = $GLOBALS['mosConfig_absolute_path']."/components/com_sef/sef404.php";

		if (is_readable($sef404)) {
			$index = str_replace($GLOBALS['mosConfig_live_site'],"",$_SERVER['PHP_SELF']);
			$base = dirname($index);

			if ($base =="\\") $base = "/";

			$base .= (($base == "/") ? "" :"/");

			$index = basename($index);

			$URI = array();



			if (isset ($_SERVER['REQUEST_URI'])) {

				//strip out the base

				$REQUEST = str_replace($GLOBALS['mosConfig_live_site'],"",$_SERVER['REQUEST_URI']);

				$REQUEST = preg_replace("/^".preg_quote($base,"/")."/","",$REQUEST);

				$URI = new Net_URL($REQUEST);

			}else{

				$QUERY_STRING = isset($_SERVER['QUERY_STRING']) ? "?".$_SERVER['QUERY_STRING'] : "";

				$URI = new Net_URL($index.$QUERY_STRING);

			}

			if ($debug) {

				echo"<pre>";

				print_r($URI);

				print_r($_SERVER);

				echo"</pre>";

				die();

			}

			//Make sure host name matches our config, we need this later.

			if (strpos($GLOBALS['mosConfig_live_site'],$URI->host) === false) {

				header("HTTP 1.0 301 Moved Permanently");

				header("Location: ".$GLOBALS['mosConfig_live_site']);

			}else

				include_once($sef404);

		}else

			die(_COM_SEF_NOREAD."( $sef404 )<br />"._COM_SEF_CHK_PERMS);



	}else{

		$mambo_sef = $GLOBALS['mosConfig_absolute_path']."/includes/sef.php";

		if (is_readable($mambo_sef)) include($mambo_sef);

		else {

			die(_COM_SEF_NOREAD."( $mambo_sef )<br />"._COM_SEF_CHK_PERMS);

		}

	}

}else{

	function sefRelToAbs( $string ) {

		return $string;

	}

}

?>
