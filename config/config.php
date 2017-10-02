<?php
$GLOBALS['m4cm_firstrun'] = 0;
$GLOBALS['m4cm_overwrite'] = true;

$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('srhinow\Meta4CoreModules\ClassMeta4CoreModules', 'm4cmParseTemplate');
$GLOBALS['TL_HOOKS']['generatePage'][] = array('srhinow\Meta4CoreModules\ClassMeta4CoreModules', 'm4cmGeneratePage');