<?php if (!defined('ABSPATH')) {die;}
/**
 * Created by DownKit.
 * User: xiaowu
 * Date: 2021/9/3
 * Time: 16:10
 * Description:
 */

// 用户信息小工具
CSF::createWidget('author_sidebar', array(
    'title'       => 'Lotus用户信息展示',
    'classname'   => 'widget-userinfo',
    'description' => 'Lotus主题的小工具',
    'fields'      => array(
        array(
            'id'         => '_name',
            'type'       => 'text',
            'title'      => '名称',
            'default'    => '用户中心',
        ),
        array(
            'id'         => '_avatar_url',
            'type'       => 'upload',
            'title'      => '未登录用户的默认头像',
            'default'    => get_template_directory_uri().'/assets/imgs/authors/author.jpg',
        ),
        array(
            'id'         => '_desc',
            'type'       => 'text',
            'title'      => '未登录用户描述',
            'default'    => '出淤泥而不染，濯清涟而不妖',
        ),
    ),
));
if (!function_exists('author_sidebar')) {
    function author_sidebar($args, $instance)
    {
        global $current_user;
        $name=$instance['_name'];
        if(is_user_logged_in()){
            $author_url=get_author_posts_url($current_user->ID);
            $dispalyname=$current_user->display_name;
            $des=$current_user->description;
            $avatar_url=lot_get_avatar_url($current_user->ID);
            $login='<a class="btn btn-radius bg-primary text-white ml-15 font-small box-shadow" href="'.wp_logout_url(get_bloginfo('url')).'">退出登录</a>';
        }else{
            $author_url="/";
            $dispalyname="请登录！";
            $des=$instance['_desc'];;
            $avatar_url=$instance['_avatar_url'];
            $login=' <a class="btn btn-radius bg-primary text-white ml-15 font-small box-shadow" href="'.lotus_get_page_link('login').'">登录/注册</a>';
        }
      echo '
        <div class="widget-header-1 position-relative mb-30">
            <h5 class="mt-5 mb-30">'.$name.'</h5>
        </div>
        <div class="sidebar-widget widget-about mb-50 pt-30 pr-30 pb-30 pl-30 bg-white border-radius-5 has-border  wow fadeInUp animated">
            <div style=" display: block; margin: 0 auto;text-align: center;">
                <a  href="'.$author_url.'"><img  class="avatar" height="96" width="96" style="border-radius:50%;" src="'.$avatar_url.'"></a>
            </div>
             <div class="widget-header-1 position-relative mb-30"></div>
             <p style="text-align: center">个人中心</p>
            <h5 class="mb-20" style="border-top: 1px solid var(--mutted-border-color);">'.$dispalyname.'</h5>
            <p class="font-medium text-muted">'.$des.'</p>
          
              <div style=" display: block; margin: 0 auto;text-align: center;">
                    '.$login.'
               </div>
     
        </div>';


    }
}


// 热门文章
CSF::createWidget('popular_posts', array(
    'title'       => 'Lotus热门文章',
    'classname'   => 'widget-popular-posts',
    'description' => 'Lotus主题的小工具',
    'fields'      => array(
        array(
            'id'         => '_name',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '热门文章',
        ),

        array(
            'id'         => '_category',
            'type'       => 'select',
            'title'      => '选择分类',
            'placeholder' => '选择展示的分类下的文章',
            'options'     => 'category',
            'chosen'      => true,
//            'ajax'        => true,
            'multiple'    => true,
        ),
        array(
            'id'         => '_category_posts_num',
            'type'       => 'text',
            'title'      => '选择展示该分类下文章的数量',
            'default'    =>'5',
            'dependency' => array('_post_id', '==', 'false'),
        ),

    ),
));
if (!function_exists('popular_posts')) {
    function popular_posts($args, $instance)
    {
        $post_num = $instance['_category_posts_num'];//展示的数量

            $args = array(
                'post_status' => 'publish',
                'orderby' => 'comment_count',
                'posts_per_page' => $post_num,
                'cat'=>$instance['_category'],
            );

            query_posts($args);
        echo '
                    <div class="sidebar-widget widget-latest-posts mb-50 wow fadeInUp animated">
                        <div class="widget-header-1 position-relative mb-30">
                            <h5 class="mt-5 mb-30">'.$instance['_name'].'</h5>
                        </div>
                        <div class="post-block-list post-module-1">
                            <ul class="list-post">
              ';
         if(have_posts()):
            while( have_posts() ):the_post();
        echo '  
                                <li class="mb-30 wow fadeInUp animated">
                                    <div class="d-flex bg-white has-border p-25 hover-up transition-normal border-radius-5">
                                        <div class="post-content media-body">
                                            <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
                                            <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                                <span class="post-on">'.timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))).'</span>
                                                <span class="post-by has-dot">'.getPostViews(get_the_ID()).'&nbsp;<i class="fa fa-eye"></i></span>
                                            </div>
                                        </div>
                                        <div class="post-thumb post-thumb-80 d-flex ml-15 border-radius-5 img-hover-scale overflow-hidden">
                                            <a class="color-white" href="'.get_the_permalink().'">
                                                <img src="'.get_thumbail_src(get_the_ID()).'" alt="'.get_the_title().'">
                                            </a>
                                        </div>
                                    </div>
                                </li>
        ';
        endwhile;
        else:
             echo '暂无更多！';
        endif;
        echo '
                            </ul>
                        </div>
                    </div>
        ';
        wp_reset_query();
    }
}

// 最新评论
CSF::createWidget('last_comment', array(
    'title'       => 'Lotus最新评论展示',
    'classname'   => 'widget-last-comment',
    'description' => 'Lotus主题的小工具',
    'fields'      => array(
        array(
            'id'         => '_name',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '最新评论',
        ),
        array(
            'id'         => '_num',
            'type'       => 'text',
            'title'      => '展示多少条评论',
            'default'    => '5',
        ),
    ),
));
if (!function_exists('last_comment')) {
    function last_comment($args, $instance)
    {
        $comments = get_comments('status=approve&number='.$instance['_num'].'&order=comment_data');
        echo '
                  <div class="sidebar-widget widget-latest-posts mb-50 wow fadeInUp animated">
                        <div class="widget-header-1 position-relative mb-30">
                            <h5 class="mt-5 mb-30">'.$instance['_name'].'</h5>
                        </div>
                        <div class="post-block-list post-module-2">
                            <ul class="list-post">
                            ';

        foreach ($comments as $com)
        echo '
                                <li class="mb-30 wow fadeInUp animated">
                                    <div class="d-flex bg-white has-border p-25 hover-up transition-normal border-radius-5">
                                        <div class="post-thumb post-thumb-64 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                            <a class="color-white" href="'.get_author_posts_url($com->user_id).'">
                                                <img  src="'.lot_get_avatar_url($com->user_id).'" alt="'.get_comment_author().'">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <p class="mb-10"><a href="'.get_author_posts_url($com->user_id).'"><strong>'.$com->comment_author.'</strong></a>
                                            </p>
                                            <p class="text-muted font-small">'.$com->comment_content.'</p>
                                        </div>
                                    </div>
                                </li>
                   ';
        echo '         
                            </ul>
                        </div>
                    </div>
        
        ';
    }
}


// 新加入的用户
CSF::createWidget('last_user', array(
    'title'       => 'Lotus最新注册用户',
    'classname'   => 'widget-last-user',
    'description' => 'Lotus主题的小工具',
    'fields'      => array(
        array(
            'id'         => '_name',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '最新用户',
        ),
        array(
            'id'         => '_num',
            'type'       => 'text',
            'title'      => '展示多少新用户',
            'default'    => '5',
        ),
    ),
));
if (!function_exists('last_user')) {
    function last_user($args, $instance)
    {
        global $wpdb;
        $user = $wpdb->get_results("SELECT ID,user_nicename, user_url, user_email FROM $wpdb->users ORDER BY ID DESC LIMIT 5");
        echo '
                  <div class="sidebar-widget widget_instagram wow fadeInUp animated">
                        <div class="widget-header-1 position-relative mb-30">
                            <h5 class="mt-5 mb-30">'.$instance['_name'].'</h5>
                        </div>
                        <div class="instagram-gellay">
                            <ul class="insta-feed" style="padding-bottom: 10px;">
            ';
        if(!empty($user)){
        foreach ($user as $item)
        echo '
                <li style="padding-bottom: 10px;text-align: center;">
                    <a href="'.get_author_posts_url($item->ID).'"  data-animate="zoomIn" data-duration="1.5s" data-delay="0.1s"><img class="border-radius-5" src="'.lot_get_avatar_url($item->ID).'" alt="'.$item->user_nicename.'"></a>
                    <a href="'.get_author_posts_url($item->ID).'"  data-animate="zoomIn" data-duration="1.5s" data-delay="0.1s">'.$item->user_nicename.'</a>
                </li>
            ';

        }else
        echo '他们正在赶来的路上！';
        echo '
                            </ul>
                        </div>
                    </div>
        ';
    }
}