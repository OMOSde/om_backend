<?php

/**
 * Contao module om_backend
 * 
 * @copyright OMOS.de 2015 <http://www.omos.de>
 * @author    René Fehrmann <rene.fehrmann@omos.de>
 * @package   om_backend
 * @link      http://www.omos.de
 * @license   LGPL
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_user']['palettes']['login'] .= ';{om_backend_legend},om_toolbar,om_small,om_flags,om_features';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['om_small'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_user']['om_small'],
    'default'                 => 0,
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50 clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_user']['fields']['om_toolbar'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_user']['om_toolbar'],
    'default'                 => 0,
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => array(0, 1, 2),
    'reference'               => &$GLOBALS['TL_LANG']['om_backend']['toolbar'],
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
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
$GLOBALS['TL_DCA']['tl_user']['fields']['om_features'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_user']['om_features'],
    'inputType'               => 'checkboxWizard',
    'options'                 => array('viewInfoOnShift', 'showElementButtons'),
    'reference'               => &$GLOBALS['TL_LANG']['om_backend']['feature'],
    'eval'                    => array('multiple' => true, 'tl_class' => 'clr'),
    'sql'                     => "text NULL"
);
