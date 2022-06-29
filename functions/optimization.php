<?php
/**
 * Created by LVWEI.
 * User: lilvwei
 * Date: 2022/6/15
 * Time: 12:55
 * Description:主题优化代码全放在这里
 */

add_filter('show_admin_bar', '__return_false');

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
if ( !function_exists( 'disable_embeds_init' ) ) :
    function disable_embeds_init(){
        global $wp;
        $wp->public_query_vars = array_diff($wp->public_query_vars, array('embed'));
        remove_action('rest_api_init', 'wp_oembed_register_route');
        add_filter('embed_oembed_discover', '__return_false');
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');
        add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
    }
    add_action('init', 'disable_embeds_init', 9999);
endif;

//WordPress 5.0+移除 block-library CSS
add_action( 'wp_enqueue_scripts', 'fanly_remove_block_library_css', 100 );
function fanly_remove_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
}

//禁用后台加载谷歌字体
function wp_remove_open_sans_from_wp_core()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans');
}

add_action('init', 'wp_remove_open_sans_from_wp_core');

//禁用wp5.8新版本小工具区块
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

//禁止在head泄露WordPress版本号
remove_action('wp_head', 'wp_generator');
//移除head中的rel="EditURI"
remove_action('wp_head', 'rsd_link');
//移除head中的rel="wlwmanifest"
remove_action('wp_head', 'wlwmanifest_link');

//禁止半角符号自动变全角
foreach (array('comment_text', 'the_content', 'the_excerpt', 'the_title') as $xx)
    remove_filter($xx, 'wptexturize');
//禁止自动把'WordPress'之类的变成'WordPress'
remove_filter('comment_text', 'capital_P_dangit', 31);
remove_filter('the_content', 'capital_P_dangit', 11);
remove_filter('the_title', 'capital_P_dangit', 11);

//移除谷歌 Open Sans 字体
function remove_open_sans()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}

add_action('init', 'remove_open_sans');

remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_footer', 'wp_print_footer_scripts');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_resource_hints', 2);

//移除 WordPress 头部多余.recentcomments 样式
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

if (!is_admin()) {
    function my_init_method()
    {
        wp_deregister_script('jquery');
    }

    add_action('init', 'my_init_method');
}
wp_deregister_script('l10n');


// wordpress上传文件重命名
function git_upload_filter($file)
{
    $time = date("YmdHis");
    $file['name'] = $time . "" . mt_rand(1, 100) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    return $file;
}

add_filter('wp_handle_upload_prefilter', 'git_upload_filter');

//添加后台左下角文字
function lotus_admin_footer_text($text)
{
    $text = '感谢使用<a target="_blank" href="https://www.ailee.club" >Lotus </a>进行创作';
    return $text;
}

add_filter('admin_footer_text', 'lotus_admin_footer_text');

//去除部分默认小工具
function unregister_d_widget()
{
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}


// WordPress 自动为文章添加已使用过的标签
function array2object($array)
{ // 数组转对象
    if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
    } else {
        $obj = $array;
    }
    return $obj;
}

function object2array($object)
{ // 对象转数组
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    } else {
        $array = $object;
    }
    return $array;
}

add_action('save_post', 'auto_add_tags');
function auto_add_tags()
{
    $tags = get_tags(array('hide_empty' => false));
    $post_id = get_the_ID();
    $post_content = get_post($post_id)->post_content;
    if ($tags) {
        $i = 0;
        $arrs = object2array($tags);
        shuffle($arrs);
        $tags = array2object($arrs);// 打乱顺序
        foreach ($tags as $tag) {
// 如果文章内容出现了已使用过的标签，自动添加这些标签
            if (strpos($post_content, $tag->name) !== false) {
                if ($i == 5) { // 控制输出数量
                    break;
                }
                wp_set_post_tags($post_id, $tag->name, true);
                $i++;
            }
        }
    }
}

/* 自动为文章内的标签添加内链 */
$match_num_from = 1;        //一篇文章中同一个标签少于几次不自动链接
$match_num_to = 1;      //一篇文章中同一个标签最多自动链接几次
function tag_sort($a, $b)
{
    if ($a->name == $b->name) return 0;
    return (strlen($a->name) > strlen($b->name)) ? -1 : 1;
}

function tag_link($content)
{
    global $match_num_from, $match_num_to;
    $posttags = get_the_tags();
    if ($posttags) {
        usort($posttags, "tag_sort");
        foreach ($posttags as $tag) {
            $link = get_tag_link($tag->term_id);
            $keyword = $tag->name;
            $cleankeyword = stripslashes($keyword);
            $url = "<a href=\"$link\" title=\"" . str_replace('%s', addcslashes($cleankeyword, '$'), __('【查看更多[%s]标签的文章】')) . "\"";
            $url .= ' target="_blank"';
            $url .= ">" . addcslashes($cleankeyword, '$') . "</a>";
            $limit = rand($match_num_from, $match_num_to);
            $content = preg_replace('|(<a[^>]+>)(.*)(' . $ex_word . ')(.*)(</a[^>]*>)|U' . $case, '$1$2%&&&&&%$4$5', $content);
            $content = preg_replace('|(<img)(.*?)(' . $ex_word . ')(.*?)(>)|U' . $case, '$1$2%&&&&&%$4$5', $content);
            $cleankeyword = preg_quote($cleankeyword, '\'');
            $regEx = '\'(?!((<.*?)|(<a.*?)))(' . $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
            $content = preg_replace($regEx, $url, $content, $limit);
            $content = str_replace('%&&&&&%', stripslashes($ex_word), $content);
        }
    }
    return $content;
}

add_filter('the_content', 'tag_link', 1);