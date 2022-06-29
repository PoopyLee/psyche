<?php if (!defined('ABSPATH')) {die;} // Cannot access directly.


//
// Set a unique slug-like ID
//
$prefix = 'user_meta_main';

//个人资料设置
CSF::createProfileOptions($prefix, array(
    'data_type' => 'unserialize',
));
CSF::createSection($prefix, array(
    'fields' => array(
        array(
            'type'    => 'content',
            'content' => '<h3>更多资料</h3>此处内容建议在前台用户中心修改',
        ),
        array(
            'id'    => 'custom_avatar',
            'type'  => 'upload',
            'library'      => 'image',
            'title' => '自定义头像',
        ),
        array(
            'id'          => 'gender',
            'type'        => 'select',
            'title'       => '性别',
            'options'     => array(
                '保密'  => '保密',
                '男'  => '男',
                '女'  => '女',
            ),
            'default'     => '保密'
        ),
        array(
            'id'      => 'qq',
            'type'    => 'text',
            'title'   => 'QQ',
            'placeholder'   => '请输入QQ号',
        ),
        array(
            'id'      => 'weixin',
            'type'    => 'text',
            'title'   => '微信',
            'placeholder'   => '请输入微信号',
        ),
    )
));
