<?php if (!defined('ABSPATH')) {die;} // Cannot access directly.

$icon=get_template_directory_uri().'/assets/img/favicon.ico';
$theme_name=wp_get_theme()->get('Name');

//$prefix_post_opts_style = 'style-postmeta-box';
//CSF::createMetabox($prefix_post_opts_style, array(
//    'title'     => '<span class="badge badge-radius badge-primary"><i class="fa fa-codiepie"></i> RIPRO</span> 文章内容布局',
//    'post_type' => 'post',
//    'data_type' => 'unserialize',
//    'context' => 'side',
//));
//CSF::createSection($prefix_post_opts_style, array(
//    'fields' => array(
//
//        array(
//            'id'      => 'post_style',
//            'type'    => 'radio',
//            'title'   => '',
//            'inline'  => true,
//            'options' => array(
//                'sidebar'    => '内容+侧边栏',
//                'no_sidebar' => '全宽',
//            ),
//            'default' => 'sidebar',
//        ),
//    ),
//));


//if (!_lotus('close_site_shop','0')) {
   $prefix_post_opts = '_psyche_post_options';
    CSF::createMetabox($prefix_post_opts, array(
        'title'     => '<span class="badge badge-radius badge-primary"><img style=" width: 20px;height: 20px; display: inline;float: left;" src="'.$icon.'" />'.$theme_name.'</span> 图片信息设置',
        'post_type' => 'post',
        'data_type' => 'unserialize',
        'priority'  => 'high',
    ));

 CSF::createSection($prefix_post_opts, array(
        'fields' => array(
            array(
                'id'    => 'img_size',
                'type'  => 'group',
                'title' => '图片的宽度和高度',
                'fields' => array(
                    array(
                        'id'      => 'width',
                        'type'    => 'number',
                        'title'   => '宽度',
                        'default' => '1920',
                    ),
                    array(
                        'id'      => 'height',
                        'type'    => 'number',
                        'title'   => '高度',
                        'default' => '1080',
                    ),
                ),
                'max'   => '1'
            ),
            array(
                'id'      => 'img_format',
                'type'    => 'text',
                'title'   => '图片的后缀名',
                'default' => 'jpg',
            ),
            array(
                'id'      => 'img_desc',
                'type'    => 'textarea',
                'title'   => '图片的描述信息',
                'default' => psyche('default_post_desc'),
            ),
            array(
                'id'          => 'img_tags',
                'type'        => 'select',
                'title'       => '选择图片标签',
                'chosen'      => true,
                'multiple'    => true,
                'placeholder' => '选择图片标签',
                'options'     => 'tags',
            ),
            array(
                'type'    => 'content',
                'content' => '<div style="text-align: center"><h2>更多内容正在开发中！！！</h2><img style="width: 50px;height: 50px;  display: inline;float: right;" src="'.$icon.'"><a target="_blank" style="margin-top:15px;display: inline;float: right;" href="https://www.ailee.club">查看更新进度！</as></div>',
            ),
        ),
    ));

