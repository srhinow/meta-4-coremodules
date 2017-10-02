<?php
/**
 * Created by lohnexperte.de.
 * Developer: Sven Rhinow (sven@sr-tag.de)
 * Date: 02.10.17
 */

/**
 * System configuration
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{m4cm_legend:hide},m4cm_twitter_site,m4cm_twitter_creator';

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
