<?php
/**
 * Created by LVWEI.
 * User: lilvwei
 * Date: 2022/6/15
 * Time: 11:58
 * Description:
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<!-- Page Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>
<?php the_custom_header_markup(); ?>
<!--标题栏--->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
            <a class="navbar-brand" href="<?php  echo site_url() ?>">
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if ( has_custom_logo() ) {
                    echo '<img style="margin-left:-10px" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                } else {
                    echo add_site_log();
                }
                ?>
            </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <?php
        wp_nav_menu( array(
            'theme_location'  => 'top',//导航别名
            'container'  => 'div',  //容器标签
            'container_class' => 'collapse navbar-collapse',//ul父节点class值
            'container_id'  => 'navbarSupportedContent',  //ul父节点id值
            'menu_class'   => 'navbar-nav ml-auto mb-2 mb-lg-0',   //ul节点class值
            'walker' => new description_walker()  //自定义walker
        ) );
        ?>
    </div>
</nav>

<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="<?php echo NOWTHEMEPATH;?>/assets/img/hero.jpg">
    <form class="d-flex tm-search-form">
        <input class="form-control tm-search-input" type="search" placeholder="搜索更多有趣的内容......" aria-label="Search">
        <button class="btn btn-outline-success tm-search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>


