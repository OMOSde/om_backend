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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_user']['palettes']['login'] .= ';{om_backend_legend},om_small,om_toolbar,om_flags';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['om_small'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_user']['om_small'],
  'default'                 => 0,
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_user']['fields']['om_toolbar'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_user']['om_toolbar'],
  'default'                 => 0,
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_user']['fields']['om_flags'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_user']['om_flags'],
  'default'                 => 0,
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);
