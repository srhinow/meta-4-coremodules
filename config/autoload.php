<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'srhinow',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'srhinow\Meta4CoreModules\ClassMeta4CoreModules' => 'system/modules/meta4coremodules/classes/ClassMeta4CoreModules.php',
));
