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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'om_backend',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Modules
    'om_backend\OmBackendHooks'    => 'system/modules/om_backend/modules/OmBackendHooks.php',
    'om_backend\OmBackendIdSearch' => 'system/modules/om_backend/modules/OmBackendIdSearch.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_om_backend_id_search' => 'system/modules/om_backend/templates',
));
