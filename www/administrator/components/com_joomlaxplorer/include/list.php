<?php
// ensure this file is being included by a parent file
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' );
/**
 * @version $Id: $
 * @package joomlaXplorer
 * @copyright soeren 2007
 * @author The joomlaXplorer project (http://joomlacode.org/gf/project/joomlaxplorer/)
 * @author The  The QuiX project (http://quixplorer.sourceforge.net)
 * 
 * @license
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 * 
 * Alternatively, the contents of this file may be used under the terms
 * of the GNU General Public License Version 2 or later (the "GPL"), in
 * which case the provisions of the GPL are applicable instead of
 * those above. If you wish to allow use of your version of this file only
 * under the terms of the GPL and not to allow others to use
 * your version of this file under the MPL, indicate your decision by
 * deleting  the provisions above and replace  them with the notice and
 * other provisions required by the GPL.  If you do not delete
 * the provisions above, a recipient may use your version of this file
 * under either the MPL or the GPL."
 * 
 * Directory-Listing Functions
 */
//------------------------------------------------------------------------------
// HELPER FUNCTIONS (USED BY MAIN FUNCTION 'list_dir', SEE BOTTOM)
function make_list(&$_list1, &$_list2) {		// make list of files
	$list = array();

	if($GLOBALS["direction"]=="ASC") {
		$list1 = $_list1;
		$list2 = $_list2;
	} else {
		$list1 = $_list2;
		$list2 = $_list1;
	}
	
	if(is_array($list1)) {
		while (list($key, $val) = each($list1)) {
			$list[$key] = $val;
		}
	}
	
	if(is_array($list2)) {
		while (list($key, $val) = each($list2)) {
			$list[$key] = $val;
		}
	}
	
	return $list;
}

/**
 * make tables & place results in reference-variables passed to function
 * also 'return' total filesize & total number of items
 *
 * @param string $dir
 * @param array $dir_list
 * @param array $file_list
 * @param int $tot_file_size
 * @param int $num_items
 */
function get_dircontents($dir, &$dir_list, &$file_list, &$tot_file_size, &$num_items) {						// make table of files in dir

	$homedir = realpath($GLOBALS['home_dir']);
	$tot_file_size = $num_items = 0;
	// Open directory
	
	$handle = @$GLOBALS['jx_File']->opendir(get_abs_dir($dir));
	
	if($handle===false && $dir=="") {
	  	$handle = @$GLOBALS['jx_File']->opendir($homedir . $GLOBALS['separator']);
	}
	
	if($handle===false) {
		jx_Result::sendResult('list', false, $dir.": ".$GLOBALS["error_msg"]["opendir"]);
	}
	$file_list = array();
	$dir_list = array();
	// Read directory
	while(($new_item = @$GLOBALS['jx_File']->readdir($handle))!==false) {
		
		if( is_array( $new_item ))  {
			$abs_new_item = $new_item;
		} else {
			$abs_new_item = get_abs_item($dir, $new_item);
		}
		/*if(get_is_dir( $abs_new_item)) {
			continue;
		}*/		
		if ($new_item == "." || $new_item == "..") continue;
		
		if(!@$GLOBALS['jx_File']->file_exists($abs_new_item)) {
			//jx_Result::sendResult( 'list', false, $dir."/$abs_new_item: ".$GLOBALS["error_msg"]["readdir"]);
		}
		if(!get_show_item($dir, $new_item)) continue;		

		$new_file_size = @$GLOBALS['jx_File']->filesize($abs_new_item);
		$tot_file_size += $new_file_size;
		$num_items++;

		$new_item_name = $new_item;
		if( jx_isFTPMode() ) {
			$new_item_name = $new_item['name'];
		}
		
		if(get_is_dir( $abs_new_item)) {
			
			if($GLOBALS["order"]=="modified") {
				$dir_list[$new_item_name] =
					@$GLOBALS['jx_File']->filemtime($abs_new_item);
			} else {	// order == "size", "type" or "name"
				
				$dir_list[$new_item_name] = $new_item;
			}
		} else {
			if($GLOBALS["order"]=="size") {
				$file_list[$new_item_name] = $new_file_size;
			} elseif($GLOBALS["order"]=="modified") {
				$file_list[$new_item_name] =
					@$GLOBALS['jx_File']->filemtime($abs_new_item);
			} elseif($GLOBALS["order"]=="type") {
				$file_list[$new_item_name] =
					get_mime_type( $abs_new_item, "type");
			} else {	// order == "name"
				$file_list[$new_item_name] = $new_item;
			}
		}
	}
	
	@$GLOBALS['jx_File']->closedir($handle);
	
	// sort
	if(is_array($dir_list)) {
		if($GLOBALS["order"]=="modified") {
			if($GLOBALS["direction"]=="ASC") arsort($dir_list);
			else asort($dir_list);
		} else {	// order == "size", "type" or "name"
			if($GLOBALS["direction"]=="ASC") ksort($dir_list);
			else krsort($dir_list);
		}
	}
	
	// sort
	if(is_array($file_list)) {
		if($GLOBALS["order"]=="modified") {
			if($GLOBALS["direction"]=="ASC") arsort($file_list);
			else asort($file_list);
		} elseif($GLOBALS["order"]=="size" || $GLOBALS["order"]=="type") {
			if($GLOBALS["direction"]=="ASC") asort($file_list);
			else arsort($file_list);
		} else {	// order == "name"
			if($GLOBALS["direction"]=="ASC") ksort($file_list);
			else krsort($file_list);
		}
	}
	if( $GLOBALS['start'] > $num_items ) {
		$GLOBALS['start'] = 0;
	}

}
/**
 * This function assembles an array (list) of files or directories in the directory specified by $dir
 * The result array is send using JSON
 *
 * @param string $dir
 * @param string $sendWhat Can be "files" or "dirs"
 */
function send_dircontents($dir, $sendWhat='files') {	// print table of files
	global $dir_up, $mainframe;
	
	// make file & dir tables, & get total filesize & number of items
	get_dircontents($dir, $dir_list, $file_list, $tot_file_size, $num_items);
	if( $sendWhat == 'files') {
		$list = $file_list;
	} elseif( $sendWhat == 'dirs') {
		$list = $dir_list;
	} else {
		$list = make_list( $dir_list, $file_list );
	}
	
	$i = 0;
	$toggle = false;
	$items['totalCount'] = count($list);
	$items['items'] = array();
	$dirlist = array();
	$list = array_slice( $list, $GLOBALS['start'], $GLOBALS['limit']);
	while(list($item,$info) = each($list)) {
		// link to dir / file
		if( is_array( $info )) {
			$abs_item=$info;
			if( extension_loaded('posix')) {
				$user_info = posix_getpwnam( $info['user']);
				$file_info['uid'] = $user_info['uid'];
				$file_info['gid'] = $user_info['gid'];
			}
		} else {
			$abs_item=get_abs_item($dir,$item);
			$file_info = @stat( $abs_item );
		}
		$is_dir = get_is_dir($abs_item);
		
		$items['items'][$i]['name'] = $item;
		$items['items'][$i]['is_file'] = get_is_file( $abs_item);
		$items['items'][$i]['is_archive'] = jx_isArchive( $item ) && !jx_isFTPMode();
		$items['items'][$i]['is_writable'] = $is_writable = @$GLOBALS['jx_File']->is_writable( $abs_item );
		$items['items'][$i]['is_chmodable'] = $is_chmodable = @$GLOBALS['jx_File']->is_chmodable( $abs_item );
		$items['items'][$i]['is_readable'] = $is_readable =@$GLOBALS['jx_File']->is_readable( $abs_item );
		$items['items'][$i]['is_deletable'] = $is_deletable = @$GLOBALS['jx_File']->is_deletable( $abs_item );
		$items['items'][$i]['is_editable'] = get_is_editable($abs_item);
		
		$items['items'][$i]['icon'] = _JX_URL."/images/".get_mime_type($abs_item, "img");
		$items['items'][$i]['size'] = parse_file_size(get_file_size( $abs_item));
	// type
		$items['items'][$i]['type'] = get_mime_type( $abs_item, "type");
	// modified
		$items['items'][$i]['modified'] = parse_file_date( get_file_date($abs_item) );
	// permissions
		$perms = get_file_perms( $abs_item );
		if( strlen($perms)>3) {
			$perms = substr( $perms, 2 );
		}
		$items['items'][$i]['perms'] = $perms. ' ('. parse_file_perms( $perms ).')';
			
		if( extension_loaded( "posix" )) {
			$user_info = posix_getpwuid( $file_info["uid"] );
			//$group_info = posix_getgrgid($file_info["gid"] );
			$items['items'][$i]['owner'] = $user_info["name"]. " (".$file_info["uid"].")";
		} else {
			$items['items'][$i]['owner'] = 'n/a';
		}
		if( $is_dir && $sendWhat != 'files') {

			$id = $dir. $GLOBALS['separator'].$item;
			$id = str_replace( $GLOBALS['separator'], '_RRR_', $id );

			$qtip ="<strong>".jx_Lang::mime('dir',true)."</strong><br /><strong>".jx_Lang::msg('miscperms',true).":</strong> ".$perms."<br />";
			$qtip.='<strong>'.jx_Lang::msg('miscowner',true).':</strong> '.$items['items'][$i]['owner'];
			$dirlist[] = array('text' => htmlspecialchars($item),
								'id' => $id,
								'qtip' => $qtip,
								'is_writable' => $is_writable,
								'is_chmodable' => $is_chmodable,
								'is_readable' => $is_readable,
								'is_deletable' => $is_deletable,
								'cls' => 'folder');
		}
		if( !$is_dir && $sendWhat == 'files' || $sendWhat == 'both') {
			$i++;
		}
	}
	while( @ob_end_clean() );
	
	if( $sendWhat == 'dirs') {
		$result = $dirlist;
	} else {
		$result = $items;
	}
	$json = new Services_JSON();
	echo $json->encode( $result );
	
	jx_exit();
	
}
class jx_List extends jx_Action {
	
	function execAction($dir) {			// list directory contents
		global $dir_up, $mosConfig_live_site, $_VERSION;
		
		$allow=($GLOBALS["permissions"]&01)==01;
		$admin=((($GLOBALS["permissions"]&04)==04) || (($GLOBALS["permissions"]&02)==02));
		
		$dir_up = dirname($dir);
		if($dir_up==".") $dir_up = "";
		
		if(!get_show_item($dir_up,basename($dir))) {
			jx_Result::sendResult('list', false, $dir." : ".$GLOBALS["error_msg"]["accessdir"]);	
		}
		
		// Sorting of items
		if($GLOBALS["direction"]=="ASC") {
			$_srt = "no";
		} else {
			$_srt = "yes";
		}
		
		show_header();
		
		$GLOBALS['mainframe']->addcustomheadtag( '
		<script type="text/javascript" src="'. _JX_URL . '/fetchscript.php?'
			.'subdir[0]=scripts/codepress/&amp;file[0]=codepress.js'
			.'&amp;subdir[1]=scripts/extjs/&amp;file[1]=yui-utilities.js'
			.'&amp;subdir[2]=scripts/extjs/&amp;file[2]=ext-yui-adapter.js'
			.'&amp;subdir[3]=scripts/extjs/&amp;file[3]=ext-all.js&amp;gzip='.$GLOBALS['mosConfig_gzip'].'"></script>
		<script type="text/javascript" src="'. $mosConfig_live_site .'/administrator/index2.php?option=com_joomlaxplorer&amp;action=include_javascript&amp;file=functions.js"></script>	
		<link rel="stylesheet" href="'. _JX_URL . '/fetchscript.php?subdir[0]=scripts/extjs/css/&file[0]=ext-all.css&amp;subdir[1]=scripts/extjs/css/&file[1]=ytheme-aero.css&amp;gzip='.$GLOBALS['mosConfig_gzip'].'" />');
		?>
		<div id="dirtree"></div>
	<div id="dirtree-panel"></div>
	<div id="item-grid"></div>
	
	<?php
		// That's the main javascript file to build the Layout & App Logic
		include( _JX_PATH.'/scripts/application.js.php' );
		
	}

}
?>
