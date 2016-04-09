<?php

/**
 * Contao module om_backend
 *
 * @copyright OMOS.de 2016 <http://www.omos.de>
 * @author    René Fehrmann <rene.fehrmann@omos.de>
 * @package   om_backend
 * @link      http://www.omos.de
 * @license   LGPL
 */

 
/**
 * CSS
 */
if (TL_MODE == 'BE' && $_GET['do'] == 'files')
{
    $GLOBALS['TL_JAVASCRIPT'][] = '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/om_backend/assets/js/jquery.getUrlParam.js';
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/om_backend/assets/js/filefilter.js';
} 
