<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Om_backend
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
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
	'om_backend\OmBackendIdSearch' => 'system/modules/om_backend/modules/OmBackendIdSearch.php',
	'om_backend\OmBackendHooks'    => 'system/modules/om_backend/modules/OmBackendHooks.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_om_backend_id_search' => 'system/modules/om_backend/templates',
));
