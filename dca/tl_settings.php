<?php
/**
 * Created by lohnexperte.de.
 * Developer: Sven Rhinow (sven@sr-tag.de)
 * Date: 02.10.17
 */

/**
 * System configuration
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'] = array('set_twitter_meta');
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{m4cm_legend:hide},set_opengraph_meta,set_google_meta,set_twitter_meta';
// Subpalettes
$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['set_twitter_meta'] = 'm4cm_twitter_site,m4cm_twitter_creator';


$GLOBALS['TL_DCA']['tl_settings']['fields']['m4cm_twitter_site'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['m4cm_twitter_site'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'w50'),
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['m4cm_twitter_creator'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['m4cm_twitter_creator'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'w50'),
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['set_opengraph_meta'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['set_opengraph_meta'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50 clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['set_google_meta'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['set_google_meta'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50 clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['set_twitter_meta'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['set_twitter_meta'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true,'tl_class'=>'w50 clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);
