<?php
/**
 * Created by LVWEI.
 * User: lilvwei
 * Date: 2022/6/15
 * Time: 12:07
 * Description:主题前端页面的渲染
 */

//引入前端文件
if(!function_exists("add_assets")):
function add_assets()
{
    if (!is_admin()) {
        //<!-- 引入 CSS  -->
        //wp_enqueue_style('csf-fa', 'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css', array(), '4.7.0', 'all');
        wp_enqueue_style('fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all');
        wp_enqueue_style('fa5-v4-shims', 'https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css', array(), '5.13.0', 'all');
        wp_enqueue_style('bootstrap', NOWTHEMEPATH.'/assets/css/bootstrap.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('fontawesome', NOWTHEMEPATH.'/assets/fontawesome/css/all.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('templatemo', NOWTHEMEPATH.'/assets/css/templatemo-style.css', array(), '1.0.0', 'all');
    }
//    if(is_single()){
//        wp_enqueue_style('fancybox', NOWTHEMEPATH.'/assets/css/vendor/jquery.fancybox.css', array(), '1.0.0', 'all');
//    }
//    if(is_category()){
//        wp_enqueue_style('nice-select', NOWTHEMEPATH.'/assets/css/vendor/nice-select.css', array(), '4.1.3', 'all');
//    }
}
add_action('wp_enqueue_scripts', 'add_assets');
endif;