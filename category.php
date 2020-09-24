<?php
/**
 * 主模版文件
 * 
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

get_header();
?>

    <div class="main-container">
        <div class="left-sider">
            <!-- 文章列表 -->
            <div class="media-list">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="media-item">
                            <div class="media-title">
                                <a href="<?php the_permalink()?>" target="_blank"><?php the_title(); ?></a>
                            </div>
                            <div class="media-widget">
                                <div class="media-widget-left">
                                    <div class="media-author">
                                        <img src="<?php bloginfo('template_url'); ?>/assets/images/test.jpg">
                                        神奇小编 </div>
                                    <div class="media-description">
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </div>
                                <div class="media-widget-right">
                                    <!-- <img src="images/slider.jpg"> -->
                                    <?php if(has_post_thumbnail()){?>
                                            <?php the_post_thumbnail(); ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="media-info">
                                <span>阅读 <?php echo getPostViews(get_the_ID()); ?> </span>
                                <span>时间 <?php the_time('Y-m-d H:i');?> </span>
                            </div>
                        </div><!-- ./ media-item -->
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <!-- 分页 -->
            <?php
                the_posts_pagination(array(
                    'mid_size' => 3, 
                    'prev_text' => '<', 
                    'next_text' => '>',
                    'screen_reader_text' => ' ',
                    'aria_label' => "xxx",
                ));
            ?>
            <!-- 分页 -->
            <!-- <nav class="navigation pagination" role="navigation" aria-label="xxx">
                <h2 class="screen-reader-text"> </h2>
                <div class="nav-links"><span aria-current="page" class="page-numbers current">1</span>
                    <a class="page-numbers" href="#page/2">2</a>
                    <a class="next page-numbers" href="#page/2">></a></div>
            </nav> -->
        </div>

        <div class="right-sider">
            <?php get_template_part("sidebar" )?>
        </div><!-- .right-sider -->

    </div>


<?php
get_footer();
