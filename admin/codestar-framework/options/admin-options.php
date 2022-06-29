<?php if (!defined('ABSPATH')) {die;} // Cannot access directly.

$prefix = 'psyche_theme_options';
//
// Create options
//
CSF::createOptions($prefix, array(
    'menu_title' => wp_get_theme()->get('Name'),
    'menu_slug'  => 'psyche',
    'footer_text'             => '坚贞不渝的化身:'.wp_get_theme()['Name'].' WordPress主题 V' . wp_get_theme()['Version'],
//    'footer_credit'           => '感谢您使用'.wp_get_theme()->get('Name').' <a href="'.wp_get_theme()->get('ThemeURI').'" target="_blank">Author : '.wp_get_theme()->get('Author').' </a>From <i class="fa fa-leaf"></i>',
    'footer_credit'           => '关于本主题:'.wp_get_theme()->get('Description'),
    'theme'  => 'light'
));

//
// 基本设置
//
CSF::createSection($prefix, array(
    'title'  => '基本设置',
    'icon'   => 'fa fa-sun-o',
    'fields' => array(
        array(
            'id'      => 'site_logo',
            'type'    => 'upload',
            'title'   => '网站LOGO',
            'default' => get_template_directory_uri() . '/assets/img/logo.jpg',
        ),
        array(
            'id'      => 'site_icon',
            'type'    => 'upload',
            'title'   => '网站icon图标',
            'default' => get_template_directory_uri() . '/assets/img/favicon.ico',
        ),

        array(
            'id'      => 'target_blank',
            'type'    => 'switcher',
            'title'   => '是否新窗口打开文章',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'is_search_word',
            'type'    => 'switcher',
            'title'   => '是否开启搜索框下面的热门关键字',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'         => 'site_search_words',
            'type'       => 'select',
            'title'      => '搜素关键词',
            'placeholder' => '选择展示的分类',
            'desc'       => '选择需要展示在搜索框下面的热门关键字',
            'attributes' => array(
                'style' => 'width: 100%;',
            ),
            'options'     => 'tags',
            'chosen'      => true,
            'multiple'    => true,
            'dependency' => array('is_search_word', '==', 'true'),
        ),




    ),
));

//
// SEO设置
//
CSF::createSection($prefix, array(
    'title'  => 'SEO设置',
    'icon'   => 'fa fa-wrench',
    'fields' => array(
        array(
            'id'      => 'is_open_seo',
            'type'    => 'switcher',
            'title'   => '禁用主题内置的SEO功能',
            'label'   => '有部分会员在用插件做SEO，可以在此关闭S主题自带SEO功能',
            'default' => false,
        ),
        array(
            'id'     => 'seo',
            'type'   => 'fieldset',
            'title'  => '首页SEO信息',
            'fields' => array(
                array(
                    'id'      => 'web_subtitle',
                    'type'    => 'textarea',
                    'title'   => '网站副标题',
                    'default' => 'Psyche Theme Wordpress主题',
                ),
                array(
                    'id'         => 'web_keywords',
                    'type'       => 'text',
                    'title'      => '网站关键词',
                    'desc'       => '3-5个关键词，用英文逗号隔开',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'default'    => 'wordpress,Psyche,wordpress免费主题',
                ),
                array(
                    'id'      => 'web_description',
                    'type'    => 'textarea',
                    'title'   => '网站描述',
                    'default' => 'Psyche Theme是一款免费的Wordpress图片主题，',
                ),

            ),
            'dependency' => array('is_open_seo', '==', 'true'),
        ),
        array(
            'id'      => 'connector',
            'type'    => 'text',
            'title'   => '全站链接符',
            'desc'    => '一经选择，切勿更改，对SEO不友好，一般为“-”或“_”',
            'default' => '-',
            'dependency' => array('is_open_seo', '==', 'true'),
        ),
        array(
            'id'      => 'no_categoty',
            'type'    => 'switcher',
            'title'   => '分类去除category/前缀',
            'label'   => '',
            'default' => true,
        ),

    ),
));

//
// 首页设置: 首页设置
//
CSF::createSection($prefix, array(
    'id'          => 'home_fields',
    'title'       => '首页设置',
    'icon'        => 'fa fa-home',
    'description' => '首页设置',
));

//首页特效设置
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => '首页设置',
    'icon'   => 'fa fa-television',
    'fields' => array(
        array(
            'id'    => 'img_other',
            'type'  => 'group',
            'title' => '图片的其他描述',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => '免责声明',
                ),
                array(
                    'id'      => 'value',
                    'type'    => 'textarea',
                    'title'   => '描述',
                    'default' => '该图片由本站网友上传，如有侵权，请联系站长删除！',
                ),
            ),
            'max'   => '6',
            'default' =>  array(
                array(
                    'title'      => '免责声明',
                    'value'    => '该图片由本站网友上传，如有侵权，请联系站长删除！',
                ),
            ),
        ),
        array(
            'type'    => 'heading',
            'content' => '首页 “特效设置”',
        ),
        array(
            'id'      => 'is_open_topshare',
            'type'    => 'switcher',
            'title'   => '顶部菜单旁边的三个分享按钮',
            'default' => true,
        ),
        array(
            'id'      => 'is_open_topscoll',
            'type'    => 'switcher',
            'title'   => '顶部显示进度条',
            'label'   => '这个进度条是用来显示整个页面的阅读长度',
            'default' => true,
        ),
        array(
            'id'      => 'is_open_pageloding',
            'type'    => 'switcher',
            'title'   => '页面加载样式',
            'label'   => '进入首页的加载样式。。。',
            'default' => true,
        ),
        array(
            'id'      => 'index_loading_img',
            'type'    => 'upload',
            'title'   => '加载样式图片',
            'default' => get_template_directory_uri() . '/assets/imgs/theme/favicon.ico',
            'dependency' => array('is_open_pageloding', '==', 'true'),
        ),
        array(
            'id'       => 'head_css',
            'type'     => 'code_editor',
            'title'    => '头部自定义css',
            'settings' => array(
                'mode'   => 'htmlmixed',
            ),
        ),
    ),
));

//首页特效设置
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => '首页右侧菜单设置',
    'icon'   => 'fa fa-list',
    'fields' => array(
        array(
            'type'    => 'heading',
            'content' => '首页右部 “热门话题”',
        ),
        array(
            'id'          => 'home_right_title',
            'type'        => 'text',
            'title'       => '推荐的推荐的分类（分类下必须有文章）',
            'default'    => '热门话题',
        ),
        array(
            'id'          => 'home_right_category',
            'type'        => 'select',
            'title'       => '推荐的推荐的分类（分类下必须有文章）',
            'placeholder' => '选择展示的分类',
            'options'     => 'categories',
            'chosen'      => true,
            'multiple'    => true,
        ),
        array(
            'type'    => 'heading',
            'content' => '首页右部“不要错过”',
        ),
        array(
            'id'          => 'home_right_title2',
            'type'        => 'text',
            'title'       => '推荐的推荐的分类（分类下必须有文章）',
            'default'    => '不要错过',
        ),
        array(
            'id'          => 'home_right_posts',
            'type'        => 'select',
            'title'       => '推荐的推荐的分类（分类下必须有文章）',
            'placeholder' => '选择展示的文章',
            'options'     => 'posts',
            'chosen'      => true,
//            'ajax'        => true,
            'multiple'    => true,
        ),
        array(
            'type'    => 'heading',
            'content' => '首页右部广告',
        ),
        array(
            'id'     => 'home_right',
            'type'   => 'fieldset',
            'title'  => '右侧广告设置',
            'fields' => array(
                array(
                    'id'    => '_title',
                    'type'  => 'text',
                    'title' => '标题',
                    'default'=>'加入我们'
                ),
                array(
                    'id'    => '_href',
                    'type'  => 'text',
                    'title' => '链接',
                    'default'=>'https://www.ailee.club',
                    'placeholder'=>'https://'
                ),
                array(
                    'id'      => '_ads',
                    'type'    => 'upload',
                    'title'   => '显示的广告',
                    'default' => get_template_directory_uri() . '/assets/imgs/ads/ads-1.jpg',
                ),
            ),
        ),

    ),
));

//页面布局设置
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => '首页布局设置',
    'icon'   => 'fa fa-th-large',
    'fields' => array(
        array(
            'type'    => 'heading',
            'content' => '首页布局',
        ),
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => '注意，这里模块如果是比较旧的版本升级最新版后不现实新的模块，请重置【当前分区】重新布局拖拽一下，然后再模块参数设置具体参数即可，千万别手贱点击全部重置。',
        ),
        array(
            'id'             => 'index_layout',
            'type'           => 'sorter',
            'title'          => '',
            'enabled_title'  => '显示的模块',
            'disabled_title' => '隐藏的模块',
            'default'        => array(
                'enabled'  => array(
                    'home-posts' => '首页文章',
                ),
                'disabled' => array(
                    'home-bottom-link' => '首页底部链接模块',
                    'home-featured-post' => '精选文章',
                    'home-slider' => 'Lotus默认幻灯片',
                    'home-slider-loop'  => 'Lotus循环幻灯片',
                    'home-slider-big'   => 'Lotus全屏幻灯片',
                ),
            ),
        ),

    ),
));

//文章设置
CSF::createSection($prefix, array(
    'title'  => '文章设置',
    'icon'   => 'fa fa-file-text-o',
    'fields' => array(
        array(
            'type'    => 'heading',
            'content' => '文章设置',
        ),
        array(
            'id'          => 'default_thumbail_src',
            'type'        => 'upload',
            'title'       => '默认的缩略图',
            'default'    => get_template_directory_uri()."/screenshot.jpg",
        ),
        array(
            'id'          => 'default_post_desc',
            'type'        => 'textarea',
            'title'       => '图片的默认描述信息',
            'default'    =>  wp_get_theme()->get('Description'),
        ),
        array(
            'id'      => 'is_open_copyright',
            'type'    => 'switcher',
            'title'   => '是否开启文章底部版权设置',
            'default' => true,
        ),
        array(
            'id'          => 'single_copyright',
            'type'        => 'textarea',
            'title'       => '文章底部版权设置',
            'default'    => '<h4>版权声明:</h4><br>
作者：{{user}}<br>
本文标题:{{title}}<br>
本文链接：{{link}}<br>
来源：{{site}}<br>
文章版权归作者所有，未经允许请勿转载。',
            'attributes' => array(
                'style' => 'height: 100%;',
            ),
            'desc'       =>'可用变量：<br> 1.作者：{{user}} <br> 2.文章标题：{{title}}<br> 3.文章链接：{{link}}<br> 4.网站名字：{{site}}',
            'dependency' => array('is_open_copyright', '==', 'true'),
        ),


    ),
));





//Lotus默认幻灯片
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => 'Lotus默认幻灯片设置',
    'icon'   => 'fa fa-film',
    'fields' => array(
        array(
            'id'          => 'default_slider_img',
            'type'        => 'upload',
            'title'       => '默认的缩略图',
            'desc'       =>'最佳大小为：460x360',
            'default'    => get_template_directory_uri()."/assets/imgs/theme/home.png",
        ),
        array(
            'id'          => 'default_slider_text',
            'type'        => 'textarea',
            'title'       => '特效字',
            'desc'       =>'以英文的 "" 双引号包裹，以英文的 , 逗号分割',
            'default'    => '"莲花Lotus做一股清凉","应孑然一身","也正气凌然"',
        ),
        array(
            'id'       => 'default_slider_html',
            'type'     => 'code_editor',
            'title'    => '幻灯片上显示的HTML代码',
            'settings' => array(
                'theme'  => 'mdn-like',
                'mode'   => 'htmlmixed',
            ),
            'default'  => '    <h2>欢迎使用<span>Lotus主题</span></h2>
    <h3 class="mb-20"> 这个世界我们没有太多的选择，但，至少您可以选择使用Lotus主题...</h3>
    <h5 class="text-muted">记住你的选择，努力的坚持下去，或许前方就是胜利....</h5>',
        ),
    )
));

//Lotus默认幻灯片
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => 'Lotus全屏幻灯片设置',
    'icon'   => 'fa fa-film',
    'fields' => array(
        array(
            'id'     => 'slider_big',
            'type'   => 'group',
            'title'  => '全屏幻灯片',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => 'Lotus希望你能像莲花一样出淤泥不染,濯清涟而不妖',
                ),
                array(
                    'id'         => 'img',
                    'type'       => 'upload',
                    'title'      => '幻灯片',
                    'desc'       => '3-5个关键词，用英文逗号隔开',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'default'    => get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                ),
                array(
                    'id'      => 'href',
                    'type'    => 'text',
                    'title'   => '链接',
                    'placeholder' => 'https://',
                    'default' => 'https://www.ailee.club',
                ),
            ),
            'max'       =>'8',
            'default'   =>array(
                array(
                    'title'      => 'Lotus希望你能像莲花一样出淤泥不染,濯清涟而不妖',
                    'img'    => get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                    'href'   => 'https://www.ailee.club',
                ),

            ),


        ),


    )

));

//Lotus循环幻灯片
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => 'Lotus循环幻灯片设置',
    'icon'   => 'fa fa-film',
    'fields' => array(
        array(
            'id'     => 'slider_loop',
            'type'   => 'group',
            'title'  => '循环幻灯片',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => 'Lotus希望你能像莲花一样出淤泥不染,濯清涟而不妖',
                ),
                array(
                    'id'         => 'img',
                    'type'       => 'upload',
                    'title'      => '幻灯片',
                    'desc'       => '3-5个关键词，用英文逗号隔开',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'default'    => get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                ),
                array(
                    'id'      => 'href',
                    'type'    => 'text',
                    'title'   => '链接',
                    'placeholder' => 'https://',
                    'default' => 'https://www.ailee.club',
                ),
            ),
            'max'       =>'8',
            'default'   =>array(
                array(
                    'title'      => 'Lotus希望你能像莲花一样出淤泥不染,濯清涟而不妖',
                    'img'    => get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                    'href'   => 'https://www.ailee.club',
                ),

            ),
        ),

    )
));


//精选文章模块
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'  => '精选文章设置',
    'icon'   => 'fa fa-bullseye',
    'fields' => array(
        array(
            'id'=>'is_open_tags',
            'type'=>'switcher',
            'title'  => '是否打开右上角的热门标签（请确保本站有标签）',
            'default'=>true,
        ),
        array(
            'id'     => 'featured_post',
            'type'   => 'group',
            'title'  => '精选文章的幻灯片',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => 'Lotus希望你能像莲花一样出淤泥不染,濯清涟而不妖',
                ),
                array(
                    'id'         => 'img',
                    'type'       => 'upload',
                    'title'      => '幻灯片',
                    'desc'       => '3-5个关键词，用英文逗号隔开',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'default'    => get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                ),
                array(
                    'id'      => 'href',
                    'type'    => 'text',
                    'title'   => '链接',
                    'placeholder' => 'https://',
                    'default' => 'https://www.ailee.club',
                ),
            ),
            'max'       =>'8',
            'default'   =>array(
                array(
                    'title'      => 'Lotus希望你能像莲花一样出淤泥不染,濯清涟而不妖',
                    'img'    => get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                    'href'   => 'https://www.ailee.club',
                ),

            ),
        ),

        array(
            'id'          => 'featured_post_id',
            'type'        => 'select',
            'title'       => '精选文章',
            'placeholder' => '选择展示的文章',
            'options'     => 'posts',
            'chosen'      => true,
            'ajax'        => true,
            'multiple'    => true,
        ),


    )
));

//网站底部设置
CSF::createSection($prefix, array(
    'title'  => '网站底部设置',
    'icon'   => 'fa fa-registered',
    'fields' => array(

        array(
            'type'    => 'heading',
            'content' => '底部菜单栏一',
        ),
        array(
            'id'     => 'footer_bar_one',
            'type'   => 'fieldset',
            'title'  => '底部菜单栏一',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => 'Lotus',
                ),
                array(
                    'id'         => 'desc',
                    'type'       => 'textarea',
                    'title'      => '更多内容',
                    'desc'       => '展示在标题下面',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'default'    => '水陆草木之花，可爱者甚蕃。晋陶渊明独爱菊。自李唐来，世人甚爱牡丹。予独爱莲之出淤泥而不染，濯清涟而不妖，中通外直，不蔓不枝，香远益清，亭亭净植，可远观而不可亵玩焉。',
                ),
            ),
        ),
        array(
            'type'    => 'heading',
            'content' => '底部菜单栏二',
        ),
        array(
            'id'     => 'footer_bar_two',
            'type'   => 'fieldset',
            'title'  => '底部菜单栏一',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => '快速链接',
                ),
                array(
                    'id'         => 'links',
                    'type'       => 'group',
                    'title'      => '更多内容',
                    'desc'       => '展示在标题下面',
                    'fields' => array(
                        array(
                            'id'      => 'url',
                            'type'    => 'text',
                            'title'   => '链接',
                            'default' => '<a href="https://www.ailee.club">关于我们</a>',
                            'attributes' => array(
                                'style' => 'width: 100%;',
                            ),
                        ),
                    ),
                    'default' =>array(
                        array(
                        'url'=>'<a href="https://www.ailee.club">关于我们</a>',
                        ),
                    ) ,

                ),
            ),
        ),

        array(
            'type'    => 'heading',
            'content' => '底部菜单栏三',
        ),
        array(
            'id'     => 'footer_bar_three',
            'type'   => 'fieldset',
            'title'  => '底部菜单栏三',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => '联系我们',
                ),
                array(
                    'id'         => 'img',
                    'type'       => 'group',
                    'title'      => '更多内容',
                    'desc'       => '展示在标题下面',
                    'fields' => array(
                        array(
                            'id'         => 'title',
                            'type'       => 'text',
                            'title'      => '图片标题',
                            'default'    =>'联系我们',
                        ),
                        array(
                            'id'         => 'src',
                            'type'       => 'upload',
                            'title'      => '底部图片链接',
                            'default'    =>get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
                        ),
                    ),
                ),
            ),
        ),

        array(
            'type'    => 'heading',
            'content' => '底部版权',
        ),
        array(
            'id'      => 'footer_copy',
            'type'    => 'textarea',
            'title'   => '底部版权',
            'default' => 'Copyright © 2021 · <a href="https://www.ailee.club">Lotus主题</a>·京ICP备123456789',
        ),

    )
));

//网站的第三方登录
CSF::createSection($prefix, array(
    'title'  => '第三方登录设置',
    'icon'   => 'fa fa-sign-in',
    'fields' => array(
        array(
            'id'=>'is_open_mail',
            'type'=>'switcher',
            'title'=>'是否开启本站的邮箱配置',
            'desc'=>'默认是开启的',
            'default'=>true
        ),

        array(
            'id'=>'fromnames',
            'type'=>'text',
            'title'=>'发件人',
            'default'=>"Lotus",
            'dependency' => array('is_open_mail', '==', 'true'),
        ),
        array(
            'id'=>'smtpusername',
            'type'=>'text',
            'title'=>'邮箱账户',
            'default'=>"123456789@qq.com",
            'desc'=>'你的邮箱账户',
            'dependency' => array('is_open_mail', '==', 'true'),
        ),
        array(
            'id'=>'smtppassword',
            'type'=>'text',
            'title'=>'邮箱密码',
            'default'=>"********",
            'desc'=>'输入你对应的邮箱密码，这里使用了*代替',
            'dependency' => array('is_open_mail', '==', 'true'),
        ),
        array(
            'id'=>'smtphost',
            'type'=>'text',
            'title'=>'SMTP服务器',
            'default'=>"smtp.qq.com",
            'dependency' => array('is_open_mail', '==', 'true'),
        ),
        array(
            'id'=>'smtpprot',
            'type'=>'text',
            'title'=>'SMTP服务器端口',
            'default'=>"465",
            'dependency' => array('is_open_mail', '==', 'true'),
        ),
        array(
            'id'=>'is_open_auth',
            'type'=>'switcher',
            'title'=>'是否开启SMTPAuth服务',
            'default'=>true,
            'dependency' => array('is_open_mail', '==', 'true'),
        ),
        array(
            'id'=>'smtpsecure',
            'type'=>'text',
            'title'=>'加密方式（SMTPSecure）',
            'default'=>"ssl",
            'desc'=>'tls or ssl （port=25留空，465为ssl）',
            'dependency' => array('is_open_mail', '==', 'true'),
        ),

        array(
            'id'=>'is_open_qq',
            'type'=>'switcher',
            'title'=>'是否开启本站QQ登录',
            'desc'=>'申请地址：<a target="_blank" href="https://connect.qq.com/">https://connect.qq.com</a>',
            'label'   => '默认是关闭的',
            'default'=>false
        ),
        array(
            'id'=>'qq_openid',
            'type'=>'text',
            'title'=>'QQ官网获取的OpenId',
            'default'=>"",
            'dependency' => array('is_open_qq', '==', 'true'),
        ),
        array(
            'id'=>'qq_openkey',
            'type'=>'text',
            'title'=>'QQ官网获取的OpenKey',
            'default'=>"",
            'desc'=>'你的邮箱账户',
            'dependency' => array('is_open_qq', '==', 'true'),
        ),
        array(
            'id'=>'qq_callback',
            'type'       => 'text',
            'title'      => '回调地址',
            'attributes' => array(
                'readonly' => 'readonly',
            ),
            'default'    => esc_url(home_url('/oauth/qq/callback')),
            'desc'    => '如果中途切换域名或者升级https，请备份appid参数，然后重置当前分区设置即可刷新为最新的网址',
            'after'=>"请填写一致，否则不成功！！",
            'dependency' => array('is_open_qq', '==', 'true'),
        ),

        array(
            'id'=>'is_open_weixin',
            'type'=>'switcher',
            'title'=>'是否开启本站微信登录',
            'desc'=>'申请地址：<a target="_blank" href="https://open.weixin.qq.com/">https://open.weixin.qq.com</a>',
            'label'   => '默认是关闭的',
            'default'=>false
        ),
        array(
            'id'=>'weixin_openid',
            'type'=>'text',
            'title'=>'QQ官网获取的OpenId',
            'default'=>"",
            'dependency' => array('is_open_weixin', '==', 'true'),
        ),
        array(
            'id'=>'weixin_openkey',
            'type'=>'text',
            'title'=>'QQ官网获取的OpenKey',
            'default'=>"",
            'desc'=>'你的邮箱账户',
            'dependency' => array('is_open_weixin', '==', 'true'),
        ),
        array(
            'id'=>'weixin_callback',
            'type'       => 'text',
            'title'      => '回调地址',
            'attributes' => array(
                'readonly' => 'readonly',
            ),
            'default'    => esc_url(home_url('/oauth/weixin/callback')),
            'desc'    => '如果中途切换域名或者升级https，请备份appid参数，然后重置当前分区设置即可刷新为最新的网址',
            'after'=>"请填写一致，否则不成功！！",
            'dependency' => array('is_open_weixin', '==', 'true'),
        ),


    )
));



//网站后台
CSF::createSection($prefix, array(
    'title'  => '网站后台设置',
    'icon'   => 'fa fa-sign-in',
    'fields' => array(
        array(
            'type'=>'heading',
            'title'=>'网站后台设置',
        ),
        array(
            'id'=>'admin_logo',
            'type'=>'upload',
            'title'=>'网站后台登录Logo',
            'default' => get_template_directory_uri() . '/assets/imgs/theme/favicon.ico',
        ),
        array(
            'id'=>'admin_color',
            'type'=>'color',
            'title'=>'网站后台的字体颜色',
            'default'=>"red"
        ),
        array(
            'id'=>'is_open_admin_bg',
            'type'=>'switcher',
            'title'=>'网站后台的背景图片调用bing',
            'default'=>true
        ),
        array(
            'id'=>'admin_background',
            'type'=>'upload',
            'title'=>'网站后台登录的默认背景',
            'default'=>get_template_directory_uri().'/assets/imgs/news/news-2.jpg',
            'dependency' => array('is_open_admin_bg', '==', 'false'),
        ),
    )
));


//关于本主题
CSF::createSection($prefix, array(
    'title'  => '关于本主题',
    'icon'   => 'fa fa-info-circle',
    'fields' => array(
        array(
            'title' =>  '系统环境',
            'type'    => 'heading',
            'content' => '
            <div style="margin-left:14px;font-size: 14px;color: #009999">
            <li><strong>操作系统</strong>： ' . PHP_OS . ' </li>
            <li><strong>运行环境</strong>： ' . $_SERVER["SERVER_SOFTWARE"] . ' </li>
            <li><strong>PHP版本</strong>： ' . PHP_VERSION . ' </li>
            <li><strong>WordPress版本</strong>： ' . get_bloginfo('version') . '</li>
            <li><strong>系统信息</strong>： ' . php_uname() . ' </li>
            <li><strong>服务器时间</strong>： ' . current_time('mysql') . '</li>
             <li><strong><a class="but c-yellow" href="' . admin_url('site-health.php?tab=debug') . '">查看更多系统信息</a></strong></li>
             </div>
           
            ',
        ),
        array(
            'title' =>  '本主题推荐使用环境',
            'type'    => 'heading',
            'content' => '
            <div style="margin-left:14px;font-size: 14px;color: #009999">
                <li><strong>WordPress</strong>：5.6+，推荐使用5.8.1</li>
                <li><strong>PHP</strong>：PHP5.6及以上，推荐使用7.0以上</li>
                <li><strong>服务器配置</strong>：无要求，最低配都行</li>
                <li><strong>操作系统</strong>：无要求，不推荐使用Windows系统</li>
            </div>
            ',
        ),

    )
));

//备份还原
CSF::createSection($prefix, array(
    'title'  => '备份还原',
    'icon'   => 'fa fa-random',
    'fields' => array(
        array(
            'type'    => 'submessage',
            'style'   => 'info ',
            'content' => '
                <h3 style="color:#488afd;"><i class="csf-tab-icon fa fa-fw fa-copy"></i> ' .wp_get_theme()->get('Name').'主题配置备份及导入</h3>
                <div style="margin:10px 14px;">
                <li>' .wp_get_theme()->get('Name').'主题当前版本'.wp_get_theme()->get('Version').'</li>
               
              ',
        ),
        array(
            'type' => 'backup',
        ),
    )
));

