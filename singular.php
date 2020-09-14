<?php
/**
 * The template for displaying single posts and pages.
 * 
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

get_header();
?>

<?php 
setPostViews(get_the_ID()); // 更新文章浏览次数
?> 


<div class="main-container">
        <div class="left-sider">
            <!-- 面包屑导航 -->
            <div class="breadcrumbs">
                <span>当前位置：</span>
                <?php get_breadcrumbs();?>
            </div>

            <div class="singular-article-container">
                <div class="article-title">
                    <?php the_title(); ?>
                </div>
                <div class="article-meta">
                    <span>阅读 <?php echo getPostViews(get_the_ID()); ?> </span>
                    <span>时间 <?php the_time('Y-m-d H:i');?> </span>
                </div>
                <div class="article-content">
                    <?php 
                    if ( have_posts() ) {

                        while ( have_posts() ) {
                            the_post();
                            the_content();
                            // get_template_part( 'template-parts/content', get_post_type() );
                        }
                    }
                    ?>
                </div>
            </div>

        </div>

        <div class="right-sider">
            <?php get_template_part("sidebar" )?>
        </div><!-- .right-sider -->

    </div>

<?php get_footer(); ?>
