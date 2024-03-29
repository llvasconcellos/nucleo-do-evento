<?php
//
// Copyright (C) 2004 W.H.Welch
// All rights reserved.
//
// This source file is part of the 404SEF Component, a Mambo 4.5.1
// custom Component By W.H.Welch - http://sef404.sourceforge.net/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// Please note that the GPL states that any headers in files and
// Copyright notices as well as credits in headers, source files
// and output (screens, prints, etc.) can not be removed.
// You can extend them with your own credits, though...
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// German Translation by M. Stenzel - mastergizmo@arcor.de and Matrikular - coicvc@web.de
//
// Dont allow direct linking
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// admin interface
DEFINE('_COM_SEF_CONFIG','sh404SEF<br/>Konfiguration');
DEFINE('_COM_SEF_CONFIG_DESC','Konfigurieren Sie alle sh404SEF Einstellungen');
DEFINE('_COM_SEF_HELP','sh404SEF<br/>Hilfe');
DEFINE('_COM_SEF_HELPDESC','Brauchen Sie Hilfe bei sh404SEF?');
DEFINE('_COM_SEF_INFO','ARTIO sh404SEF<br/>Dokumentation');
DEFINE('_COM_SEF_INFODESC','Betrachten Sie die s404SEF Projekt Zusammenfassung und Dokumentation');
DEFINE('_COM_SEF_VIEWURL','SEF Urls<br />ansehen / bearbeiten');
DEFINE('_COM_SEF_VIEWURLDESC','Ansehen/Bearbeiten der SEF Urls');
DEFINE('_COM_SEF_VIEW404','404 Logs<br />ansehen / bearbeiten');
DEFINE('_COM_SEF_VIEW404DESC','Ansehen/Bearbeiten der 404 Logs');
DEFINE('_COM_SEF_VIEWCUSTOM','Eigene Umleitungen<br />(Redirects)<br /> ansehen / bearbeiten');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Ansehen/Bearbeiten Eigene Umleitungen(Redirects)');
DEFINE('_COM_SEF_SUPPORT','Support<br/>Homepage');
DEFINE('_COM_SEF_SUPPORTDESC','Verbinden Sie sich zur 404SEF Homepage (neues Fenster)');
DEFINE('_COM_SEF_BACK','Zur&uuml;ck zur sh404SEF Konfigurations&uuml;bersicht');
DEFINE('_COM_SEF_PURGEURL','SEF Urls<br/>l&ouml;schen');
DEFINE('_COM_SEF_PURGEURLDESC','SEF Urls l&ouml;schen');
DEFINE('_COM_SEF_PURGE404','404 Logs <br/>l&ouml;schen');
DEFINE('_COM_SEF_PURGE404DESC','404 Logs l&ouml;schen');
DEFINE('_COM_SEF_PURGECUSTOM','Eigene Umleitungen<br/>l&ouml;schen');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Eigene Umleitungen l&ouml;schen');
DEFINE('_COM_SEF_WARNDELETE','Achtung!!!<br/>Sie sind dabei etwas zu l&ouml;schen: ');
DEFINE('_COM_SEF_RECORD',' Eintrag');
DEFINE('_COM_SEF_RECORDS',' Eintr&auml;ge');
DEFINE('_COM_SEF_NORECORDS','Keine Eintr&auml;ge gefunden.');
DEFINE('_COM_SEF_PROCEED',' Vorgang Starten ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','Eintr&auml;ge erfolgreich gel&ouml;scht');
DEFINE('_PREVIEW_CLOSE','Fenster Schliessen');
DEFINE('_COM_SEF_EMPTYURL','Sie m&uuml;ssen eine URL f&uuml;er die Umleitung angeben.');
DEFINE('_COM_SEF_NOLEADSLASH','Da sollte kein vorangehender "SLASH" an der neuen SEF URL sein');
DEFINE('_COM_SEF_BADURL','Die alte Nicht-SEF Url muss mit index.php beginnen');
DEFINE('_COM_SEF_URLEXIST','Diese URL existiert bereits in der Datenbank!');
DEFINE('_COM_SEF_SHOW0','Zeige SEF Urls');
DEFINE('_COM_SEF_SHOW1','Zeige 404 Logs');
DEFINE('_COM_SEF_SHOW2','Zeige Eigene Umleitungen');
DEFINE('_COM_SEF_INVALID_URL','INVALIDE URL: dieser Link ben&ouml;tigt ein valides Itemid,aber es wurde keins gefunden.<br/>L&ouml;sung: Erstellen Sie einen Men&uuml;eintrag f&uuml; diesen Artikel. Sie brauchen ihn nicht zu ver&ouml;ffentlichen, es reicht dass der Eintrag existiert.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>404: Nicht gefunden</h1><h4>Entschuldigung, aber die angeforderte Seite konnte nicht gefunden werden.</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Bitte etwas zum l&ouml;schen ausw&auml;hlen');
DEFINE('_COM_SEF_ASC',' (aufsteigend) ');
DEFINE('_COM_SEF_DESC',' (absteigend) ');
DEFINE('_COM_SEF_WRITEABLE',' <strong><font color="green">beschreibbar</font></strong>');
DEFINE('_COM_SEF_UNWRITEABLE',' <strong><font color="red">Nicht beschreibbar</font></strong>');
DEFINE('_COM_SEF_USING_DEFAULT',' <strong><font color="red">Benutze Standard Werte</font></strong>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>Hinweis: Die SEF Unterst&uuml;tzung in Joomla ist momentan deaktiviert. Um SEF zu benutzen, aktivieren Sie es bitte in der <a href='".
	$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Globale Konfiguration</a> auf der SEO Seite.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG','404 SEF Konfiguration');
DEFINE('_COM_SEF_TITLE_BASIC','Standard Konfiguration');
DEFINE('_COM_SEF_ENABLED','Aktiviert');
DEFINE('_COM_SEF_TT_ENABLED','Wenn Sie diese Optoin auf Nein setzen wird die Standard Joomla! SEF Funktion benutzt.');
DEFINE('_COM_SEF_DEF_404_PAGE','<strong>Standard 404 Seite</strong><br>');
DEFINE('_COM_SEF_REPLACE_CHAR','Zu ersetzendes Zeichen');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Vorgabe um unbekannte Zeichen und Symbole im URL zu ersetzen.');
DEFINE('_COM_SEF_PAGEREP_CHAR','Trennzeichen');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Trennzeichen Vorgabe welche die Seitenzahlen vom Rest des URL trennt.');
DEFINE('_COM_SEF_STRIP_CHAR','Auszublenden Zeichen');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Zeichen und Symbole die dem URL entnommen werden sollen. Durch | getrennt anzugeben.');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Zeichen am Anfang oder Ende entfernen');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Zeichen die am Anfang oder Ende eines URL entfernt werden sollen, werden hier durch ein | getrennt angegeben.');
DEFINE('_COM_SEF_USE_ALIAS','Benutze Titel Alias');
DEFINE('_COM_SEF_TT_USE_ALIAS','An dieser Stelle k&ouml;nnen Sie w&auml;hlen ob statt des Original- der Titel-Alias verwendet werden soll.');
DEFINE('_COM_SEF_SUFFIX','Dateiendung');
DEFINE('_COM_SEF_TT_SUFFIX','Erweiterung f&uuml;r Dateien. Zum deaktivieren lassen Sie dieses Feld leer. Ein h&auml;ufiger Eintrag w&auml;re z.B. .html');
DEFINE('_COM_SEF_ADDFILE','Standard index Datei');
DEFINE('_COM_SEF_TT_ADDFILE','Dateiname der an einen leeren URL angeh&auml;ngt wird wenn keine Datei existiert.<br />N&uuml;tzlich wenn Bots ihre Seiten nach einer bestimmten Datei durchsuchen und beim Nicht-Auffinden eine 404 Fehlermeldung zur&uuml;ckgeben w&uuml;rden.');
DEFINE('_COM_SEF_PAGETEXT','Seiten Text');
DEFINE('_COM_SEF_TT_PAGETEXT','Text der bei mehrseitigen Dokumenten an den URL angehangen wird.<br />Die Seitennummer wird duch %s dargestellt.');
DEFINE('_COM_SEF_LOWER','Nur Kleinbuchstaben');
DEFINE('_COM_SEF_TT_LOWER','Konvertiert alle Zeichen im URL zu Kleinbuchstaben.');
DEFINE('_COM_SEF_SHOW_SECT','Sektion anzeigen');
DEFINE('_COM_SEF_TT_SHOW_SECT','Bei <strong>Ja</strong> werden die Sektionsnamen in den URL aufgenommen');
DEFINE('_COM_SEF_HIDE_CAT','Kategorie verbergen');
DEFINE('_COM_SEF_404PAGE','404 Seite');
DEFINE('_COM_SEF_TT_404PAGE','Statische Content Seite die beim Fehler: <strong>404 Seite nicht gefunden</strong> angezeigt wird<br />Der Status, ver&ouml;ffentlicht oder nicht, wird nicht ber&uuml;cksichtigt');
DEFINE('_COM_SEF_TITLE_ADV','Erweiterte Konfiguration');
DEFINE('_COM_SEF_TT_ADV','<strong>Standard Handler</strong><br/>Die Seite wird normal abgearbeitet.<br/>Falls eine Advanced Extension vorhanden ist, wird diese benutzt.<br /><strong>Keine Zwischenspeicherung</strong><br/>Es erfolgt keine Zwischenspeicherung in der Datenbank. Das standard Joomla! SEF System wird benutzt.<br/><strong>&Uuml;berspringen</strong><br/>Keine SEF Urls f&uuml;r diese Komponente<br/>');
DEFINE('_COM_SEF_TT_ADV4','Erweiterte Optionen f&uuml;r ');
DEFINE('_COM_SEF_TITLE_MANAGER','SEF URL Manager');
DEFINE('_COM_SEF_VIEWMODE','Ansichtsmodus:');
DEFINE('_COM_SEF_SORTBY','Sortieren nach:');
DEFINE('_COM_SEF_HITS','Zugriffe');
DEFINE('_COM_SEF_DATEADD','Datum hinzugef&uuml;gt');
DEFINE('_COM_SEF_SEFURL','SEF Url');
DEFINE('_COM_SEF_URL','Url');
DEFINE('_COM_SEF_REALURL','Reale Url');
DEFINE('_COM_SEF_EDIT','Bearbeiten');
DEFINE('_COM_SEF_ADD','Hinzuf&uuml;gen');
DEFINE('_COM_SEF_NEWURL','Neue SEF URL');
DEFINE('_COM_SEF_TT_NEWURL','Nur Relative Umleitung vom Joomla/Mambo Root Verzeichnis <i>ohne</i> vorangehenden SLASH');
DEFINE('_COM_SEF_OLDURL','Alte Nicht-SEF Url');
DEFINE('_COM_SEF_TT_OLDURL','Diese URL muss mit index.php beginnen');
DEFINE('_COM_SEF_SAVEAS','als Eigene Umleitung speichern');
DEFINE('_COM_SEF_TITLE_SUPPORT','sh404SEF Hilfe');
DEFINE('_COM_SEF_HELPVIA','<strong>In den folgenden Foren finden Sie Hilfe:</strong>');
DEFINE('_COM_SEF_OFFICIAL','Offizielles Projekt Forum');
DEFINE('_COM_SEF_MAMBERS','Mambers Forum');
DEFINE('_COM_SEF_TITLE_PURGE','404 SEF Databank l&ouml;schen');
// component interface
DEFINE('_COM_SEF_NOREAD','FATALER FEHLER: Datei kann nicht gelesen werden ');
DEFINE('_COM_SEF_CHK_PERMS','Bitte &uuml;berpruefen Sie die Datei Berechtigungen und stellen Sie sicher, dass auf die Datei zugegriffen werden kann.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','DEBUG DATA DUMP COMPLETE: Laden der Seite abgebrochen');
DEFINE('_COM_SEF_STRANGE','Etwas seltsames ist passiert. Das sollte nicht vorkommen<br />');
// added by shumisha
// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Liste der zu ersetzenden Zeichen');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Anhand dieser Ausschluss-Tabelle lassen sich unerlaubte Zeichen oder Nicht-Lateinische Zeichens�tze durch hier definierte Zeichenfolgen ersetzten.<br />Das einzuhaltende Format lautet:<br />AlterWERT TRENNZEICHEN NeuerWERT.<br />In der Praxis werden altes und neues Zeichen durch ein | getrennt und jede weitere Ausschluss-Regel durch ein Komma definiert.<br />Es k�nnen auf diese Weise viele verschiedene Regeln erstellt werden. Ebenso das Ersetzen von Mehrfach-Zeichen wie im folgenden Beispiel ist m�glich: �|oe');
// cache params
define('_COM_SEF_SH_CACHE_TITLE', 'Cache Verwaltung');
define('_COM_SEF_SH_USE_URL_CACHE', 'URL Cache aktivieren');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Bei Aktivierung dieser Option werden SEF URLs in einen Zwischenspeicher gelegt der die Ladezeiten der Seite erheblich erh&ouml;ht. Dieser Vorgang verbraucht allerdings mehr Speicher!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Cache Gr�&szlig;e');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Wenn Sie den URL Zwischenspeicher aktiviert haben k&ouml;nnen Sie an dieser Stelle einen Maximalwert festlegen. &Uuml;berschreitet die Anzahl der URLs diesen Wert wird zwar fortgesetzt, allerdings werden diese nicht zwischengespeichert, was die Ladezeit erh&ouml;ht.<br />Grob gesagt verbraucht jede URL ca. 200 bytes - 100 davon f&uuml;r die SEF URL und 100 f&uuml;r nicht-sef URLs.<br />Beispiel: 5000 URLs verbrauchen ca. 1 Mb Speicher.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', '&Uuml;bersetzungsmanagement');
define('_COM_SEF_SH_TRANSLATE_URL', 'URL &uuml;bersetzen');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Wenn Sie eine mehrsprachige Seite nutzen und diese Option aktiviert haben werden SEF URL Elemente anhand der eingestellten Sprache der Besucher und den Joom!Fish vorgaben &uuml;bersetzt.<br />Sollten Sie diese Option deaktiveren oder nur eine Sprache benutzen wird die in Joomla! eingetragene standard Sprache verwendet.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Itemid Verwaltung');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Einf&uuml;gen der Men&uuml;-Itemid');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Wenn in einem Url keine Itemid vorhanden ist bevor er in einen SEF Url umgewandelt wird, erh&auml;lt dieser die aktuelle Men&uuml; Itemid.<br />Dies stellt sicher, dass der Link, sollte er geklickt werden,  auf der Seite bleibt.');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Men&uuml;titel bei fehlender Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Wenn in einem Url keine Itemid gesetzt wurde bevor er in einen SEF Url umgewandelt wird, und Sie diese Option aktivieren, wird der Titel des Men&uuml;eintrags in den SEF-Url eingebunden.<br />Haben Sie die Option:<br />Einf�gen der Men�-Itemid<br />aktiviert, sollte auch diese Funktion auf <strong>Ja</strong> gesetzt werden.<br /> Es verhindert, dass Beispielsweise -2, -3,- ... an den URL angehangen werden wenn dieser von verschiedenen Seiten angezeigt wird.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Men&uuml; &Uuml;berschrift immer einf&uuml;gen');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Wenn aktiv, wird der Titel des Men�punktes welcher zu der Itemid in dem Nicht SEF URL geh�rt (oder der aktuelle Men�punkt Titel wenn keine Itemid gesetzt ist), in dem SEF URL eingef�gt.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Itemid an SEF URL anh&auml;ngen');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Aktivieren Sie diese Option wenn Sie m�chten dass die Nicht SEF Itemid (oder die aktuelle ID des Men�punktes wenn keine Itemid in dem nicht SEF URL gesetzt wurde) dem SEF URL vorangestellt wird. Dieses sollte anstelle des -Immer Men�titel einf�gen- Paramters verwendet werden falls Sie mehrere gleichnamige Men�punkte haben.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'Men&uuml; ID');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Standard Men&uuml; &Uuml;berschrift');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'Wenn Sie die vorherige Option auf <strong>Ja</strong> gesetzt haben k&ouml;nnen Sie hier den Text der in den SEF URL eingef&uuml;gt wird &uuml;berschreiben.<br />Hinweis: Dieser Text kann nicht ge&auml;ndert werden und wird beispielsweise nicht &uuml;bersetzt.');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'Virtuemart Konfiguration');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Shop Namen in URL einf&uuml;gen');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Wenn <strong>Ja</strong> wird der Shop Name basierend auf den Titel des Men&uuml;eintrags dem SEF URL vorangestellt.');
define('_COM_SEF_SH_SHOP_NAME', 'Standard Shop Name');
define('_COM_SEF_TT_SH_SHOP_NAME', 'Sie k&ouml;nnen hier einen alternativen Shop Namen angeben und somit den in der Konfiguration hinterlegten Text &uuml;berschreibt. Dieser Text kann weder nachtr&auml;glich ge&auml;ndert noch &uuml;bersetzt werden.');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Produkt ID verwenden');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Wenn <strong>Ja</strong> wird die Joomla! interne Produkt ID (Nicht SKU), vor dem Namen des Shops eingef&uuml;gt.<br /><strong>Beispiel:</strong><br />beispiel.de/3-my-very-nice-product.html.<br />Dies ist n&uuml;tzlich sollten sie gleichnamige Artikel vertreiben und die Kategorienamen nicht anzeigen lassen.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Art. Nr. als Namen verwenden');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Wenn <strong>Ja</strong> wird die von Ihnen angegebene Artikel Nr. anstatt des Namens verwendet.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Hersteller Namen einf&uuml;gen');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Wenn <strong>Ja</strong> wird der Herstellername, sofern er existiert, der SEF URL hinzugef&uuml;gt.<br /><strong>Beispiel:</strong><br />beispiel.de/manufacturer-name/product-name.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Hersteller ID einf&uuml;gen');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Wenn <strong>Ja</strong> wird dem Herstellernamen die dazugeh&ouml;rige ID vorangestellt.<br /><strong>Beispiel:</strong><br />beispiel.de/6-manufacturer-name/3-my-very-nice-product.html');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Insert categories');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'Bei <strong>Keine</strong> werden keine Kategorienamen dem URL hinzugef&uuml;gt.<br /><strong>Beispiel:</strong><br />beispiel.de/joomla-cms.html<br />Wird die Option <strong>Nur die Letzte anzeigen</strong> gew&auml;hlt, enth&auml;lt der URL den Kategorienamen des jeweiligen Produktes.<br /><strong>Beispiel:</strong><br />beispiel.de/joomla/joomla-cms.html<br /><strong>Unterkategorien</strong> bedeutet, dass der Name der Kategorie des Artikels inkl. aller Unterkategorien dem Link hinzugef&uuml;gt wird.<br /><strong>Beispiel:</strong><br />beispiel.de/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Keine');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'Nur die Letzte anzeigen');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Unterkategorien');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Kategorie ID in URL einf&uuml;gen');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Hier k&ouml;nnen Sie entscheiden ob zu jedem URL einer Kategorie, dessen ID vorangestellt wird.<br /><strong>Beispiel:</strong><br />beispiel.de/1-software/4-cms/1-joomla/joomla-cms.html');
// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Unique ID');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Numerische ID in den URL einf&uuml;gen');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Aktivieren Sie diese Option um so eine bessere Schnittstelle zu Diensten wie z.B. wie Google News bereitzustellen. In diese Fall wird eine numerische ID an den URL angeh&auml;ngt.<br />Ein Beispiel w&auml;re:<br />2007041100000<br />wobei: <strong>20070411</strong> dem Erstellungsdatum und: <strong>00000</strong><br />einer internen, eindeutigen ID des Content Elements darstellt.<br />Da Sie diesen Wert sp&auml;ter nicht mehr &auml;ndern k&ouml;nnen, sollten Sie das Erstellungsdatum erst dann setzen, wenn Ihr Beitrag bereit f&uuml;r die Ver&ouml;ffentlichung ist.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'All categories');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Geltend f&uuml;r welche Kagetorie');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Ausgehend von den hier angew&auml;hlten Kategorien wird die numerische ID in den SEF URL des jeweiligen Kontent Elements eingef&uuml;gt.<br />Durch halten der Strg-Taste ist eine Mehrfachauswahl m&ouml;glich.');
// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 Weiterleitung von Nicht-SEF zu SEF');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Wenn aktiv, werden Nicht-SEF URL die bereits in der Datenbank gespeichert sind, zur SEF URL weitergleitet.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'SSL gesicherte URL');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', 'Sollten Sie SSL gesicherte Seiten benutzen, dann tragen Sie hier den vollen Basis URL Ihrer Seite ein.<br />Setzen Sie hier keinen wird, so wird: http<srong>s</strong>://beispielseite.de benutzt.<br />Die Angabe muss ohne abschlie&szlig;ende Slashes erfolgen.<br /><strong>Beispiel:</strong><br />https://www.beispielseite.de oder https://beispielseite.de/WasAuchImma');
// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'iJoomla Magazin Konfiguration');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'iJoomla Magazin im Content aktivieren');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Wenn <strong>Ja</strong> wird der ed Parameter, insofern dieser der com_content Komponente &uuml;bergeben wird, als iJoomla Magazin Edition ID interpretiert.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Ausgabe ID in URL einf&uuml;gen');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Wenn <strong>Ja</strong> wird die Interne Ausgaben ID dem Ausgaben-Namen in einem URL vorangestellt.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Magazin Name in URL einf&uuml;gen');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Bei <strong>Ja</strong> wird immer der Name des Magazins, basierend auf dem Men&uuml;titel Eintrag, dem SEF URL vorangestellt.');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Standard Magazin Name');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Wenn der vorherige Parameter aktiviert wurde, enth&auml;lt der SEF URL den hier vergebenen Namen. Es ist nicht m&ouml;glich diesen Eintrag nachtr&ouml;glich zu &auml;ndern, es erfolgt keine &Uuml;bersetzung.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Magazin ID in URL einf&uuml;gen');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Wenn <strong>Ja</strong> wird die Interne Magazin ID dem Magazin-Namen in einem URL vorangestellt<br /><strong>Beispiel:</strong><br />beispiel.de/<strong>4</strong>-Joomla-magazine/Good-article-title.html');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Artikel ID in URL einf&uuml;gen');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Aktivieren dieser Option f&uuml;hrt dazu, dass die Artikel ID dem Artikel-Titel in einem URL vorangestellt wird.<br /><strong>Beispiel:</strong> beispiel.de/Joomla-magazine/<strong>56</strong>-Good-article-title.html');
define('_COM_SEF_SH_CB_TITLE', 'Community Builder Konfiguration');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Community Builder Namen einf&uuml;gen');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Wenn <strong>Ja</strong> wird jedem SEF Link der Community Builder Komponente dessen Community Builder Men&uuml;-Element Titel vorangestellt.');
define('_COM_SEF_SH_CB_NAME', 'Standard Name der CB Komponente');
define('_COM_SEF_TT_SH_CB_NAME', 'Wenn die vorherige Option aktiviert wurde, kann hier der Text angegeben werden, welcher den Standard Namen im SEF URL &uuml;berschreibt. Eine sp&auml;tere &Auml;nderung und eine &Uuml;bersetzung sind nicht m&ouml;glich.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Benutzer Namen einf&uuml;gen');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Diese Option kann bei gro&szlig;er User Anzahl zu hoher Last der Datenbank f&uuml;hren.<br />Sie bewirkt, dass der Name in den SEF URL aufgenommen wird. Sollten Sie diese Option deaktivieren wird das regul&auml;re ID Format benutzt.<br /><strong>Beispiel:</strong><br />..../send-user-email.html?user=245');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Benutzer ID voranstellen');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Sollten Benutzer mit gleichem Namen existieren, kann hiermit eingestellt werden, dass dem Namen die dazugeh&ouml;rige ID vorangestellt wird.');
define('_COM_SEF_SH_LOG_404_ERRORS', '404 Fehlermeldungen aufzeichnen');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Durch das Aktivieren dieser Option werden 404 Fehler in der Datenbank gespeichert. Dies kann Ihnen sp&auml;ter dabei helfen eventuelle Fehler in den Links zu finden. Die Funktion verbraucht zus&auml;tzlichen Speicher. Sollten Ihre Links also fehlerfrei sein, k&ouml;nnen Sie diese Option deaktivieren.');
define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Zus&auml;tzlicher Text');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Wenn <strong>Ja</strong> wird dem URL der Browse Category zus&auml;tzlicher Text angeh&auml;ngt.<br /><strong>Beispiel:</strong><br />.../category-A/View-all-products.html VS ..../category-A/');
// V 1.2.4.l
DEFINE('_COM_SEF_IMPORT_EXPORT','URL Import / Export');
// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301 redirect from JOOMLA SEF to sh404SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'If set to <strong>Yes</strong>, JOOMLA standard SEF url will be 301 redirected to their sh404SEF equivalent, if any in the database. If it does not exists, it will be created on the fly, unless there is some POST data, in which case nothing happens.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Insert flypage name');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'If set to Yes, the flypage name will be inserted in the URL leading to a product details. Can be deactivated if you use only one flypage.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Letterman configuration ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Default Itemid for Letterman page');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Enter Itemid of page to be inserted in Letterman links (unsubscribe, confirmation messages, ...');
define('_COM_SEF_SH_FB_TITLE', 'Fireboard Configuration ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Insert Fireboard name');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'If set to <strong>Yes</strong>, the menu element title leading to Fireboard main page will be prepended to all Fireboard SEF URL');
define('_COM_SEF_SH_FB_NAME', 'Default Fireboard Name');
define('_COM_SEF_TT_SH_FB_NAME', 'If set to <strong>yes<strong>, Fireboard name (as defined by Fireboard menu item title) will allways be prepended to SEF URL.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Insert category name');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'If set to Yes, the name category will be inserted into all SEF links to a post or a category');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Kategorie ID angeben');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'If set to <strong>Yes</strong>, category ID will be prepended to its name <strong>whe previous option is also set to Yes</strong>, just in case two categories have the same name.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Insert post subject');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'If set to <strong>Yes</strong>, each post subject will be inserted in the SEF url leading to this post ');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Insert post ID');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'If set to <strong>Yes</strong>, each post ID will be prepended to its subject <strong>whe previous option is also set to Yes</strong>, just in case two posts have the same subject.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Insert language code in URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'If set to <strong>Yes</strong>, the ISO code of the page language will be inserted in the SEF URL, except if language is default site language.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Do not translate');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Do not insert code');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'URL procssing');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'For each component installed:<br /><b>use default handler</b><br/>process normally, if an SEF Advanced extension is present it will be used instead. <br/><b>nocache</b><br/>do not store in DB and create old style SEF URLs<br/><b>skip</b><br/>do not make SEF urls for this component<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Translate URL');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'For each component installed, select if URL should be translated. No effect if site has only one language.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'ISO Code w&auml;hlen');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'For each component installed, and if your site is multi-lingual, choose to insert or not the target language ISO code in the SEF URL. For instance : www.monsite.com/<strong>fr</strong>/introduction.html. fr stands for french. This code will not be inserted in default language URL.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Pseudonym angeben');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'If set to <strong>Yes</strong>, the user pseudo will be inserted in SEF URL, if you have activated this option above, instead of its actual name.');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Override sef_ext file');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Do not override sef_ext');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Some components come with their own sef_ext files intended for use with OpenSEF or SEF Advanced. If this parameter is on (Override sef_ext), this extension file will not be used, and sh404SEF own plugin will be used instead (assuming there is one for that particular component). If not, then the component`s own sef_ext file will be used.');

// undefined ? - Matrikular 2007.05.23 
define('_COM_SEF_LICENSE', 'Lizenz');
define('_COM_SEF_COPYRIGHT', 'Copyright');
define('_COM_SEF_INSTALLED_VERS', 'Versions Nummer');
define('_COM_SEF_IMPORT', 'Importieren');
define('_COM_SEF_EXPORT', 'Exportieren');
define('_COM_SEF_SHOW_CAT', 'Kategorie anzeigen');
define('_COM_SEF_TT_SHOW_CAT', 'Bei <strong>Ja</strong> werden die Kategorienamen in den URL aufgenommen');
define('_COM_SEF_CONFIG_UPDATED', 'Ihre &Auml;nderungen wurden gespeichert');
define('_COM_SEF_USE_DEFAULT', 'Standard Handler');
define('_COM_SEF_SKIP', '&Uuml;berspringen');
define('_COM_SEF_NOCACHE', 'Keine Zwischenspeicherung');
// com_poll declaration for config-translation - Matrikular
define('_COM_SEF_COMPOLL', 'Umfrage-Komponente');

//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Main');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Advanced');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'By component');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', 'Encode URL');
define('_COM_SEF_TT_SH_ENCODE_URL', 'If set to Yes, URL will be encoded so as to be compatible with languages having non-latin characters. Encoded URL will look like : mysite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', 'Filter');
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Do you want to clear the URL cache ? This is highly recommended after changing configuration. To generate again the cache, you should browse again your homepage, or better : generate a sitemap for your site.');
define('_FULL_TITLE', 'Haupttitel');
define('_TITLE_ALIAS', 'Titel Alias');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Table');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Custom');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menu id');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Force non sef if HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'If set to Yes, URL will be forced to non sef after switching to SSL mode(HTTPS). This allows operation with some shared SSL servers causing problems otherwise.');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Guess Itemid on homepage');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'If set to yes, and on homepage only, Itemid of com_content URLs will be removed and replaced by the one sh404SEF guestimates. This is useful when some content elements can be viewed on the frontpage (in blog view for instance), and also on other pages on the site.');

?>
