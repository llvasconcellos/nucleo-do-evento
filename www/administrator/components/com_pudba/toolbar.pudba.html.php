<?php
###############################################
# PU Database Admin - A Joomla 1.0.X Component#
# Copyright (C) 2007  by Pragmatic Utopia     #
# Homepage   : www.pragmaticutopia.com        #
# Email      : rick@pragmaticutopia.com       #
# Version    : 1.0.0                          #
# License    : Released under GPL             #
#					      #
# Based on PHP Mini MySQL Admin		      #
# (c) 2004-2007 Oleg Savchuk <osa@viakron.com>#
# Charset support - 			      #
# thanks to Alex Didok http://www.main.com.ua #
#					      #
# http://phpminiadmin.sourceforge.net	      #
###############################################

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class pumenu {

  	function TABLES_MENU() 
	{
		mosMenuBar::startTable();
   		mosMenuBar::spacer();
   		mosMenuBar::endTable();
  	}
	
  	function DEFAULT_MENU() 
	{
		mosMenuBar::startTable();
   		mosMenuBar::spacer();
   		mosMenuBar::endTable();
  	}
		
}
?>
