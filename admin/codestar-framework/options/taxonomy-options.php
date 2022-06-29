<?php if (!defined('ABSPATH')) {die;} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = '_lot_taxonomy_options';

//
// Create taxonomy options
//
CSF::createTaxonomyOptions($prefix, array(
    'taxonomy'  => array('post_tag', 'category'),
    'data_type' => 'unserialize', // The type of the database save options. `serialize` or `unserialize`
));

$fields_arr = array(
    array(
        'id'      => 'the_style',
        'type'    => 'radio',
        'title'   => '文章布局风格',
        'options' => array(
            'big'=>'大型卡片布局',
            'grid' => '卡片布局',
            'list' => '列表布局',
            'masonry'=>'紧凑卡片布局'
        ),
        'default' => 'grid',
    ),

    array(
        'id'      => 'category_icon',
        'type'    => 'icon',
        'title'   => '分类右上角展示的图标',
        'default' => 'fa fa-heart'
    ),
    array(
        'id'    => 'category_bgcolor',
        'type'  => 'color',
        'title' => '图标的背景颜色（注意是背景颜色！！！）',
    ),



);



//
// Create a section
//
CSF::createSection($prefix, array(
    'fields' => $fields_arr,
));


