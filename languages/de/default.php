<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao module om_backend
 * 
 * @copyright OMOS.de 2014 <http://www.omos.de>
 * @author    René Fehrmann <rene.fehrmann@omos.de>
 * @package   om_backend
 * @link      http://www.omos.de
 * @license   LGPL
 */


/**
 * Tooltips
 */
$GLOBALS['TL_LANG']['om_backend']['id_search']       = 'ID suchen';
$GLOBALS['TL_LANG']['om_backend']['update_database'] = 'Datenbank aktualisieren';
$GLOBALS['TL_LANG']['om_backend']['new_template']    = 'Ein neues Template erstellen';
$GLOBALS['TL_LANG']['om_backend']['sync_files']      = 'Dateisystem & Datenbank synchronisieren';
$GLOBALS['TL_LANG']['om_backend']['stylesheets']     = 'Stylesheets Theme \'%s\' bearbeiten';
$GLOBALS['TL_LANG']['om_backend']['modules']         = 'Frontend-Module Theme \'%s\' bearbeiten';
$GLOBALS['TL_LANG']['om_backend']['layouts']         = 'Seitenlayouts Theme \'%s\' bearbeiten';
$GLOBALS['TL_LANG']['om_backend']['image_size']      = 'Bildgrößen Theme \'%s\' bearbeiten';


/**
 * Id search
 */
$GLOBALS['TL_LANG']['om_backend']['search_title']    = 'ID-Suche'; 
$GLOBALS['TL_LANG']['om_backend']['search_submit']   = 'ID-Suche starten';
$GLOBALS['TL_LANG']['om_backend']['search_headline'] = 'Im Contao Backend nach einer ID suchen.';
$GLOBALS['TL_LANG']['om_backend']['search_options']  = array('element' => 'Inhaltselement', 'module' => 'Modul', 'page' => 'Seite', 'article' => 'Artikel', 'news' => 'Nachricht', 'event' => 'Event');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['om_backend']['button_delete']   = 'Löschen';
$GLOBALS['TL_LANG']['om_backend']['button_cut']      = 'Verschieben';
$GLOBALS['TL_LANG']['om_backend']['button_copy']     = 'Kopieren';
$GLOBALS['TL_LANG']['om_backend']['button_override'] = 'Überschreiben';
$GLOBALS['TL_LANG']['om_backend']['button_edit']     = 'Bearbeiten';
$GLOBALS['TL_LANG']['om_backend']['button_alias']    = 'Aliase generieren';
 

/**
 * Options
 */
$GLOBALS['TL_LANG']['om_backend']['toolbar'][0] = 'Toolbar nicht anzeigen';
$GLOBALS['TL_LANG']['om_backend']['toolbar'][1] = 'Toolbar rechts anzeigen';
$GLOBALS['TL_LANG']['om_backend']['toolbar'][2] = 'Toolbar oben anzeigen';


/**
 * Features
 */
$GLOBALS['TL_LANG']['om_backend']['feature']['viewInfoOnShift']    = 'ID´s anzeigen, bei gehaltener Shift-Taste';
$GLOBALS['TL_LANG']['om_backend']['feature']['showElementButtons'] = 'Zeige Buttons zur Auswahl von Inhaltselementen';


/**
 * Error messages
 */
$GLOBALS['TL_LANG']['om_backend']['error_id_not_found'] = 'Die ID %s konnte nicht gefunden werden.';
