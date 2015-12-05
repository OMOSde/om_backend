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
 * CSS & Javascripts
 */
if (TL_MODE == 'BE')
{
    $GLOBALS['TL_CSS'][] = 'system/modules/om_backend/assets/css/om_backend.css';
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/om_backend/assets/js/om_backend.js';
}


/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['om_backend']['id_search'] = array (
    'callback'   => 'OmBackendIdSearch',
    'icon'       => 'system/modules/om_backend/assets/icons/find.png'
);
$GLOBALS['BE_MOD']['om_backend']['be_links'] = array (
    'tables'     => array('tl_om_backend_links'),
    'icon'       => 'system/modules/om_backend/assets/icons/be_links.png'
);
$GLOBALS['BE_MOD']['om_backend']['sysinfo'] = array (
    'tables'     => array('tl_om_backend_sysinfo'),
    'icon'       => 'system/modules/om_backend/assets/icons/sysinfo.png'
);


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getContentElement'][]     = array('OmBackendHooks', 'myGetContentElement');
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array('OmBackendHooks', 'myOutputBackendTemplate');
