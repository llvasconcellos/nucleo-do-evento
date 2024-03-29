<?php

$ja_color = $ja_color_default;
$ja_width = $ja_width_default;
$ja_font_size = $ja_font_size_default;

getUserSetting();

function getUserSetting(){
	global $ja_color, $ja_font_size, $ja_width, $ja_menutype, $ja_template_name, $ja_template_absolute_path ;
	global $ja_font_size_default, $ja_color_default, $ja_width_default, $ja_tool;

	if (isset($_COOKIE['JATheme']) && $_COOKIE['JATheme'] == $ja_template_name){
		if (($ja_tool & 1) && isset($_COOKIE['ScreenType'])){
			$ja_width = $_COOKIE['ScreenType'];
		}
		if (($ja_tool & 2) && isset($_COOKIE['FontSize'])){
			$ja_font_size = $_COOKIE['FontSize'];
		}
		if (($ja_tool & 4) && isset($_COOKIE['ColorCSS']) && $_COOKIE['ColorCSS']){
			$ja_color = $_COOKIE['ColorCSS'];
		}
	}else{
		$exp = time() + 60*60*24*355;
		setcookie ('JATheme', $ja_template_name, $exp, '/');
		setcookie ('ColorCSS', $ja_color_default, $exp, '/');
		setcookie ('ScreenType', $ja_width_default, $exp, '/');
		setcookie ('FontSize', $ja_font_size_default, $exp, '/');
	}

	if (!is_file("$ja_template_absolute_path/css/colors/$ja_color.css")) $ja_color = $ja_color_default;
}

function getCurrentURL(){
	$cururl = mosGetParam( $_SERVER, 'REQUEST_URI', '' );
	if(($pos = strpos($cururl, "index.php"))!== false){
		$cururl = substr($cururl,$pos);
	}
	$cururl =  sefRelToAbs($cururl);
	$cururl =  ampReplace($cururl);
	return $cururl;
}

function genMenuHead(){
	global $ja_template_path,$ja_menutype, $ja_tool,$ja_font_size;
	$html = "";
	if ($ja_menutype == 1) {
		$html = '<link href="'.$ja_template_path.'/ja_splitmenu/ja-splitmenu.css" rel="stylesheet" type="text/css" />';
	}else if ($ja_menutype == 2) {
		$html = '<link href="'.$ja_template_path.'/ja_cssmenu/ja-sosdmenu.css" rel="stylesheet" type="text/css" />
					<script language="javascript" type="text/javascript" src="'. $ja_template_path.'/ja_cssmenu/ja.cssmenu.js"></script>';
	} else if ($ja_menutype == 3) {
		$html = '<link href="'. $ja_template_path .'/ja_transmenu/ja-transmenuh.css" rel="stylesheet" type="text/css" />
					<script language="javascript" type="text/javascript" src="'.$ja_template_path.'/ja_transmenu/ja-transmenu.js"></script>';
	} else if ($ja_menutype == 4) {
		$html = '<link href="'. $ja_template_path .'/ja_scriptdlmenu/ja-scriptdlmenu.css" rel="stylesheet" type="text/css" />
					<script language="javascript" type="text/javascript" src="'.$ja_template_path.'/ja_scriptdlmenu/ja-scriptdlmenu.js"></script>';
	}

	if ($ja_tool){
	?>
		<script type="text/javascript">
		var currentFontSize = <?php echo $ja_font_size; ?>;
		</script>
	<?php
	}
	echo $html;
}

function genColorHead(){
	global $ja_color_themes, $ja_color, $ja_template_path, $ja_tool;
	$html = '';
	foreach ($ja_color_themes as $ja_color_theme) {
		if ($ja_color == $ja_color_theme){
			$html .= '<link href="'.$ja_template_path.'/css/colors/'.$ja_color_theme.'.css" rel="stylesheet" type="text/css" title="'.$ja_color_theme.'" />'."\n";
		}else{
			if ($ja_tool & 2) //Load this css when color tool enabled
				$html .= '<link href="'.$ja_template_path.'/css/colors/'.$ja_color_theme.'.css" rel="alternate stylesheet" type="text/css" title="'.$ja_color_theme.'" />'."\n";
		}
	}
	echo $html;
}

function genToolMenu($jatool){
	global $ja_template_path,$ja_font_size_default, $ja_font_size, $ja_color_themes, $ja_width, $ja_color;
	echo "<span class=\"ja-usertools\">";
	if ($jatool & 1){//show screen tools
		?>
	    <a href="#Narrow" onclick="return false;"><img title="800x600" src="<?php echo $ja_template_path;?>/images/<?php echo $ja_color?>/user-screen1<?php echo ( ($ja_width=="narrow") ? "-hilite" : "" ) ?>.gif" alt="Resolu��o 800x600" id="ja-tool-narrow" onclick="changeToolHilite(curtool, this);curtool=this;setScreenType('narrow');" /></a>
	    <a href="#Wide" onclick="return false;"><img title="1024x768" src="<?php echo $ja_template_path;?>/images/<?php echo $ja_color?>/user-screen2<?php echo ( ($ja_width=="wide") ? "-hilite" : "" ) ?>.gif" alt="Resolu��o 1024x768" id="ja-tool-wide" onclick="changeToolHilite(curtool, this);curtool=this;setScreenType('wide');" /></a>
<?php } 
	if ($jatool & 2){//show font tools
?>
      <a href="#Increase" onclick="return false;"><img title="Aumentar tamanho da fonte" src="<?php echo $ja_template_path;?>/images/<?php echo $ja_color?>/user-increase.gif" alt="Aumentar tamanho da fonte" id="ja-tool-increase" onclick="changeFontSize(1); return false;" /></a>
	    <a href="#Decrease" onclick="return false;"><img title="Diminuir tamanho da fonte" src="<?php echo $ja_template_path;?>/images/<?php echo $ja_color?>/user-decrease.gif" alt="Diminuir tamanho da fonte" id="ja-tool-decrease" onclick="changeFontSize(-1); return false;" /></a>
	    <a href="#Default" onclick="return false;"><img title="Tamanho padr�o da fonte" src="<?php echo $ja_template_path;?>/images/<?php echo $ja_color?>/user-reset.gif" alt="Tamanho padr�o da fonte" id="ja-tool-reset" onclick="revertStyles(<?php echo $ja_font_size_default;?>); return false;" /></a>
		<?php
	}
	if ($jatool & 4){//show color tools
		?>
	<?php
 	foreach ($ja_color_themes as $ja_color_theme) {
	?>
     	<a href="#<?php echo $ja_color_theme;?>" onclick="return false;"><img style="cursor: pointer;" src="<?php echo $ja_template_path;?>/images/<?php echo $ja_color?>/<?php echo $ja_color_theme;?><?php echo ( ($ja_color==$ja_color_theme) ? "-hilite" : "" ) ?>.gif" title="<?php echo $ja_color_theme;?> color" alt="<?php echo $ja_color_theme;?> color" id="ja-tool-<?php echo $ja_color_theme;?>color" onclick="setActiveStyleSheet('<?php echo $ja_color_theme;?>');return false;" /></a>
	<?php
	}
	}
	?>
    </span>
	<script type="text/javascript">
	var curtool = document.getElementById('<?php echo "ja-tool-$ja_width"; ?>');
	var curcolor = document.getElementById('<?php echo ( ($ja_color=="") ? "ja-tool-defaultcolor" : "ja-tool-{$ja_color}color" ) ?>');
	</script>
	<?php
}

function ja_loadHeader($position){
	global $ja_template_path;
	$filename =  ja_getImageSrc($position);
	if ($filename) {
		echo $filename;
	}
}

function ja_getImageSrc ($position){
	global $ja_template_path, $ja_template_absolute_path;
	if (isset( $GLOBALS['_MOS_MODULES'][$position] )) {
		$modules = $GLOBALS['_MOS_MODULES'][$position];
	} else {
		$modules = array();
	}
	foreach ($modules as $module){
		$filename = $module->title;
		$regex = '/(\.gif)|(.jpg)|(.png)|(.bmp)$/i';
		if (is_file($ja_template_absolute_path."/images/header/".$filename) && preg_match($regex, $filename)) {
			return "$ja_template_path/images/header/" . $filename;
		}
	}
	return "";
}

function getCurrentMenuIndex(){
	global $Itemid, $database, $mosConfig_shownoauth, $my;
	//Get top menu id;
	$id = $Itemid;
	$menutype = 'mainmenu';
	$ordering = '0';
	while (1){
		$sql = "select parent, menutype, ordering from #__menu where id = $id limit 1";
		$database->setQuery($sql);
		$row = null;
		$database->loadObject($row);
		if ($row) {
			$menutype = $row->menutype;
			$ordering = $row->ordering;
			if ($row->parent > 0)
			{
				$id = $row->parent;
			}else break;
		}else break;
	}
	if ($mosConfig_shownoauth) {
		$sql = "SELECT count(*) FROM #__menu AS m"
		. "\nWHERE menutype='". $menutype ."' AND published='1' AND parent=0 and ordering < $ordering";
	} else {
		$sql = "SELECT count(*) FROM #__menu AS m"
		. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$my->gid' AND parent=0 and ordering < $ordering";
	}
	$database->setQuery($sql);

	return $database->loadResult();
}


function calSpotlight ($spotlight) {

	/********************************************
	$spotlight = array ('position1', 'position2',...)
	*********************************************/
	$modules = array();	
	$modules_s = array();	
	foreach ($spotlight as $position) {
		if( mosCountModules($position) ){
			$modules_s[] = $position;
		}
		$modules[$position] = '-full';
	}
	
	if (!count($modules_s)) return null;
	
	$width = round(99.6/count($modules_s),1) . "%";

	if (count ($modules_s) > 1){
		$modules[$modules_s[0]] = "-left";
		$modules[$modules_s[count ($modules_s) - 1]] = "-right";
		for ($i=1; $i<count ($modules_s) - 1; $i++){
			$modules[$modules_s[$i]] = "-center";
		}
	}
	return array ('modules'=>$modules, 'width'=>$width);
}

function getOpenMenuItems($menutype = 'mainmenu'){
		global $database, $my, $cur_template, $Itemid;
		global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_shownoauth;

		if ($mosConfig_shownoauth) {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1'"
			. "\nORDER BY parent,ordering";
		} else {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$my->gid'"
			. "\nORDER BY parent,ordering";
		}
		$database->setQuery( $sql );
		$rows = $database->loadObjectList( 'id' );

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ($rows as $v ) {
			$pt = $v->parent;
			$list = $children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}

		// second pass - collect 'open' menus
		$open = array( $Itemid );
		$count = 20; // maximum levels - to prevent runaway loop
		$id = $Itemid;
		while (--$count) {
			if (isset($rows[$id]) && $rows[$id]->parent > 0) {
				$id = $rows[$id]->parent;
				$open[] = $id;
			} else {
				break;
			}
		}
  return $open;
}
?>