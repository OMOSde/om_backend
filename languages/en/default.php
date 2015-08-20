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
$GLOBALS['TL_LANG']['om_backend']['id_search']       = 'Search ID or alias';
$GLOBALS['TL_LANG']['om_backend']['update_database'] = 'Update database';
$GLOBALS['TL_LANG']['om_backend']['new_template']    = 'Create a new template';
$GLOBALS['TL_LANG']['om_backend']['sync_files']      = 'Sync Filesystem & Database';
$GLOBALS['TL_LANG']['om_backend']['stylesheets']     = 'Edit Stylesheets Theme \'%s\'';
$GLOBALS['TL_LANG']['om_backend']['modules']         = 'Edit Frontend-Module Theme \'%s\'';
$GLOBALS['TL_LANG']['om_backend']['layouts']         = 'Edit Seitenlayouts Theme \'%s\'';


/**
 * Id search
 */
$GLOBALS['TL_LANG']['om_backend']['search_title']    = 'ID-Alias-Search';
$GLOBALS['TL_LANG']['om_backend']['search_submit']   = 'Start ID-Alias-Search';
$GLOBALS['TL_LANG']['om_backend']['search_headline'] = 'Search in the Contao back end for an ID or an alias.';
$GLOBALS['TL_LANG']['om_backend']['search_options']  = array('element' => 'Content element', 'module' => 'Module', 'page' => 'Page', 'article' => 'Article', 'news' => 'News', 'event' => 'Event');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['om_backend']['button_delete']   = 'Delete';
$GLOBALS['TL_LANG']['om_backend']['button_cut']      = 'Move';
$GLOBALS['TL_LANG']['om_backend']['button_copy']     = 'Copy';
$GLOBALS['TL_LANG']['om_backend']['button_override'] = 'Override';
$GLOBALS['TL_LANG']['om_backend']['button_edit']     = 'Edit';
$GLOBALS['TL_LANG']['om_backend']['button_alias']    = 'Generate aliases';


/**
 * Options
 */
$GLOBALS['TL_LANG']['om_backend']['toolbar'][0] = 'No toolbar';
$GLOBALS['TL_LANG']['om_backend']['toolbar'][1] = 'Show toolbar right';
$GLOBALS['TL_LANG']['om_backend']['toolbar'][2] = 'Show toolbar top';


/**
 * Features
 */
$GLOBALS['TL_LANG']['om_backend']['feature']['viewInfoOnShift']    = 'ID´s anzeigen, bei gehaltener Shift-Taste';
$GLOBALS['TL_LANG']['om_backend']['feature']['showElementButtons'] = 'Show buttons to select content items';


/**
 * Error messages
 */
$GLOBALS['TL_LANG']['om_backend']['error_id_or_alias_not_found'] = 'The ID% or alias s could not be found.';
