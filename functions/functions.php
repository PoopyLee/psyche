<?php
/**
 * Created by LVWEI.
 * User: lilvwei
 * Date: 2022/6/18
 * Time: 11:12
 * Description:存放主题的一些功能函数
 */

require_once dirname(dirname(__FILE__)) . "/vendor/javion/image/src/Watermark.php";

// 自定义logo
add_theme_support(
    'custom-logo',
    array(
        'height'      => 100,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    )
);

// 注册菜单
register_nav_menus(
    array(
        'top'    => '顶部菜单',
    )
);


//自定义输出菜单Walker类
class description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes=$value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="nav-item '.$class_names.'"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a class="nav-link nav-link-1"' . $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}

/***
 * User: lilvwei
 * Date: 2022/6/17 22:25
 * Description:获取文章中的第一张图片
 * @return string
 */
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if(empty($first_img)) {
        $first_img = get_template_directory_uri()."/assets/img/hero.jpg";
    }
    return $first_img;
}

/***
 * User: lilvwei
 * Date: 2022/6/18 11:17
 * Description:添加设置区域的函数
 */
function add_post_desc_box (){
    add_meta_box('post_desc_box', '添加壁纸描述', 'post_desc_box','post','side','high',array('str1','str2'));
};
add_action('add_meta_boxes','add_post_desc_box');

/***
 * User: lilvwei
 * Date: 2022/6/18 11:17
 * Description:显示设置区域的回调函数
 * @param $post
 * @param $boxargs
 */
function post_desc_box($post,$boxargs){
    // 用于数据输入的实际字段
    // 使用 get_post_meta 从数据库中检索现有的值，并应用到表单中
    $value = get_post_meta( $post->ID, 'pic_desc', true );
    echo '<label for="pic_desc">';
    echo "<a style='color: #b1a1e6'>添加壁纸的描述-支持html代码</a>";
    echo '</label> ';
    echo '<textarea style="width: 100%;margin-top: 10px" id="pic_desc" name="pic_desc"  rows="15" >'.esc_attr($value).'</textarea>';
};

//Wordpress 5.0+ 禁用 Gutenberg 编辑器
//add_filter('use_block_editor_for_post', '__return_false');
//remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

/***
 * User: lilvwei
 * Date: 2022/6/18 11:17
 * Description:文章保存时，保存我们的自定义数据
 * @param $post_id
 */
function post_save_desc( $post_id )
{
    // 首先，我们需要检查当前用户是否被授权做这个动作。
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }
//    // 其次，我们需要检查，是否用户想改变这个值。
//    if (!isset($_POST['pic_desc']) || !wp_verify_nonce($_POST['pic_desc'], plugin_basename(__FILE__)))
//        return;
    // 第三，我们可以保存值到数据库中
    //如果保存在自定义的表，获取文章ID
    $post_ID = $_POST['post_ID'];
    //过滤用户输入
    $mydata = sanitize_text_field($_POST['pic_desc']);

    // 使用$mydata做些什么
    // 或者使用
    add_post_meta($post_ID, 'pic_desc', $mydata, true) or
    update_post_meta($post_ID, 'pic_desc', $mydata);
    // 或自定义表（见下面的进一步阅读的部分）
}
add_action("save_post","post_save_desc");




/***
 * User: lilvwei
 * Date: 2022/6/18 21:16
 * Description:主题的标题函数
 */
function add_site_title()
{
    //首页
    if(is_home())
    {
        if(psyche('is_open_seo'))
        {
            $title=$desc=$tags='';
            $desc=psyche('seo')['web_description'];
            $title=psyche('seo')['web_subtitle'];
            $tags=psyche('seo')['web_keywords'];
            echo '
            <title>'.$title.psyche('connector').$desc.'</title>
            <meta name="keywords" content="'.$tags.'" />
            <meta name="description" content="'.$desc.'" />
            ';
        }else{
            $desc=$tags='';
            foreach (wp_get_theme()->get('Tags') as $k=>$tag)
            {
                if($k!=count(wp_get_theme()->get('Tags'))-1)
                {
                    $tags.=$tag.',';
                }else{
                    $tags.=$tag;
                }
            }
            $desc=get_bloginfo('description');
            echo '
            <title>'.get_bloginfo('name').'-'.$desc.'</title>
            <meta name="keywords" content="'.$tags.'" />
            <meta name="description" content="'.$desc.'" />
            ';
        }
    }elseif (is_single()){  //文章页
        if(psyche('is_open_seo'))
        {
            $title=$desc=$tags='';
            $desc=get_post_meta(get_the_ID(),'img_desc',true);
            $title=get_the_title(); //文章标题
            foreach (get_the_tags() as $key=>$val)
            {
                if($key!=count(get_the_tags())-1)
                {
                    $tags.=$val->name.',';
                }else{
                    $tags.=$val->name;
                }
            }
            echo '
            <title>'.$title.psyche('connector').$desc.'</title>
            <meta name="keywords" content="'.$tags.'" />
            <meta name="description" content="'.$desc.'" />
            ';
        }else{
            $title=$desc=$tags='';
            foreach (wp_get_theme()->get('Tags') as $k=>$tag)
            {
                if($k!=count(wp_get_theme()->get('Tags'))-1)
                {
                    $tags.=$tag.',';
                }else{
                    $tags.=$tag;
                }
            }
            $title=get_the_title();
            $desc=get_bloginfo('description');
            echo '
            <title>'.$title.'-'.$desc.'</title>
            <meta name="keywords" content="'.$tags.'" />
            <meta name="description" content="'.$desc.'" />
            ';
        }
    }elseif (is_page()){
        if(psyche('is_open_seo'))
        {
            $title=$desc=$tags='';
            $desc=get_bloginfo('description');
            $title=get_page_by_title(); //文章标题
            foreach (wp_get_theme()->get('Tags') as $k=>$tag)
            {
                if($k!=count(wp_get_theme()->get('Tags'))-1)
                {
                    $tags.=$tag.',';
                }else{
                    $tags.=$tag;
                }
            }
            echo '
            <title>'.$title.psyche('connector').$desc.'</title>
            <meta name="keywords" content="'.$tags.'" />
            <meta name="description" content="'.$desc.'" />
            ';
        }else{
            $title=$desc=$tags='';
            foreach (wp_get_theme()->get('Tags') as $k=>$tag)
            {
                if($k!=count(wp_get_theme()->get('Tags'))-1)
                {
                    $tags.=$tag.',';
                }else{
                    $tags.=$tag;
                }
            }
            $title=get_the_title();
            $desc=get_bloginfo('description');
            echo '
            <title>'.$title.'-'.$desc.'</title>
            <meta name="keywords" content="'.$tags.'" />
            <meta name="description" content="'.$desc.'" />
            ';
        }
    }

}
add_action('wp_head','add_site_title');



/***
 * User: lilvwei
 * Date: 2022/6/18 11:39
 * Description:添加站点LOGO
 * @return string
 */
function add_site_log()
{
    if(!psyche('site_logo'))
    {
        return '<h1>'. get_bloginfo( 'name' ) .'</h1>';
    }else{
        return   '<img style="margin-left:-10px" src="' . psyche('site_logo') . '" alt="' . get_bloginfo( 'name' ) . '">';
    }
}

/***
 * User: lilvwei
 * Date: 2022/6/18 11:44
 * Description:如果后台设置了icon就使用
 */
function add_site_icon()
{
    if (psyche('site_icon'))
    {
        echo '<link id="favicon" href="'.psyche('site_icon').'" rel="icon" type="image/x-icon" />';
    }
}
add_action('wp_head','add_site_icon');



