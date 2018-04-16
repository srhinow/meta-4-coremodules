<?php
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace(';{publish_legend}', ';{m4cm_meta_entries},m4cm_title,m4cm_keywords,m4cm_description,m4cm_moremetas;{publish_legend}',$GLOBALS['TL_DCA']['tl_news']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_news']['fields']['m4cm_title'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['m4cm_title'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'search'                  => true,
    'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255,'tl_class'=>'long clr'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_news']['fields']['m4cm_keywords'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['m4cm_keywords'],
    'exclude'                 => true,
    'inputType'               => 'textarea',
    'search'                  => true,
    'eval'                    => array('style'=>'height:60px', 'decodeEntities'=>true),
    'sql'                     => "text NULL"
);
$GLOBALS['TL_DCA']['tl_news']['fields']['m4cm_description'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['m4cm_description'],
    'exclude'                 => true,
    'inputType'               => 'textarea',
    'search'                  => true,
    'eval'                    => array('style'=>'height:60px', 'decodeEntities'=>true, 'maxlength'=>180,'tl_class'=>'clr'),
    'sql'                     => "varchar(325) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_news']['fields']['m4cm_moremetas'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['m4cm_moremetas'],
    'exclude'                 => true,
    'inputType'               => 'textarea',
    'search'                  => true,
    'eval'                    => array('style'=>'height:60px', 'allowHTML'=>true,'preserveTags'=>true, 'tl_class'=>'clr'),
    'sql'                     => "text NULL"
);