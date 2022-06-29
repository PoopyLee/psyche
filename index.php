<?php
/**
 * Created by LVWEI.
 * User: lilvwei
 * Date: 2022/6/15
 * Time: 11:54
 * Description:
 */
get_header();
?>
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                最新图片
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
                </form>
            </div>
        </div>
        <div class="row tm-mb-90 tm-gallery">
            <?php
			if ( have_posts() ) :
                // Start the Loop.
                while ( have_posts() ) :the_post();
			        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                                <figure class="effect-ming tm-video-item">
                                    <img style="height: 200px;display: initial" src="<?php echo catch_that_image();?>" alt="<?php the_title();?>" class="img-fluid">
                                    <figcaption class="d-flex align-items-center justify-content-center">
                                        <h2><?php the_title();?></h2>
                                        <a target="_blank" href="<?php the_permalink()?>">View more</a>
                                    </figcaption>
                                </figure>
                                <div class="d-flex justify-content-between tm-text-gray">
                                    <span class="tm-text-gray-light"><?php the_title();?></span>
                                    <span class="tm-text-gray-light"><?php the_time('Y年n月d日 H:i:s'); ?></span>
<!--                                    <span>9,906 views</span>-->
                                </div>
                            </div>
                    <?php
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that
                     * will be used instead.
                     */
//                    get_template_part( 'template-parts/post/content', get_post_format() );
                endwhile;
            endif;?>
        </div> <!-- row -->
        <div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                <a href="javascript:void(0);" class="btn btn-small btn-primary tm-btn-prev mb-2 disabled">上一页</a>
                <div class="tm-paging d-flex">
                    <a href="javascript:void(0);" class="active tm-paging-link">1</a>
                    <a href="javascript:void(0);" class="tm-paging-link">2</a>
                    <a href="javascript:void(0);" class="tm-paging-link">3</a>
                    <a href="javascript:void(0);" class="tm-paging-link">4</a>
                </div>
                <a href="javascript:void(0);" class="btn  btn-primary tm-btn-next">下一页</a>
            </div>
        </div>
    </div> <!-- container-fluid, tm-container-content -->
<?php
get_footer();