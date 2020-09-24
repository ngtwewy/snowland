<?php
/**
 * Header file 
 *
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <?php
        $keywords = "神奇故事,故事,历史,历史故事,讲故事,社会";
        $description = "是故事把人们汇集起来，是故事让人们得到其他，比故事更神奇的，是现实世界，神奇故事，一个神奇的网站";
        if (is_home()) {
            
        } elseif (is_category()) {
            $keywords = single_cat_title('', false);
            $description = category_description();
        } elseif (is_tag()) {
            $keywords = single_tag_title('', false);
            $description = tag_description();
        } elseif(is_single()){
            $description = get_the_excerpt();
        }
        $keywords = trim(strip_tags($keywords));
        $description = trim(strip_tags($description));
    ?>
    <meta name="keyword" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/swiper/swiper.css" />
    <script src="<?php bloginfo('template_url'); ?>/assets/swiper/swiper.min.js"></script>
	<style>
        .recentcomments a {
            display: inline !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
</head>

<body>
    <!-- <?php body_class(); ?> -->

	<?php
	wp_body_open();
	?>

    <header class="header">
        <a href="/" class="logo" title="" rel="home">
            <img src="<?php bloginfo('template_url'); ?>/assets/images/logo.png" alt="神奇故事">
        </a>

        <?php 
        $nav_str = wp_nav_menu( array(  
            'theme_location'    => '', //[保留]用于在调用导航菜单时指定注册过的某一个导航菜单名，如果没有指定，则显示第一个  
            'menu'              => 'top_menu', //[可删]使用导航菜单的名称调用菜单，可以是 id, slug, name (按顺序匹配的) 。  
            'container'         => false, //[可删]最外层容器标签名  
            'container_class'   => '',//[可删]最外层容器class名  
            'container_id'      => '',//[可删]最外层容器id值  
            'menu_class'        => 'nav-list', //[可删]ul 节点的 class 属性值  
            'menu_id'           => '', //[可删]ul 节点的 id 属性值  
            'echo'              => false, //[可删]确定直接显示导航菜单还是返回 HTML 片段，如果想将导航的代码作为赋值使用，可设置为false  
            'fallback_cb'       => 'wp_page_menu', //[可删]备用的导航菜单函数，用于没有在后台设置导航时调用  
            'before'            => '', //[可删]显示在导航a标签之前  
            'after'             => '', //[可删]显示在导航a标签之后    
            'link_before'       => '', //[可删]显示在导航链接名之前  
            'link_after'        => '', //[可删]显示在导航链接名之后  
            'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  //[可删]使用字符串替换修改ul的class  
            'depth'             => 0, //[可删]显示菜单的深度, 当数值为0时显示所有深度的菜单，-1所有菜单平级显示  
            'walker'            => '' //[可删]自定义的遍历对象，调用一个对象定义显示导航菜单      
        ));
        echo str_replace('sub-menu', 'select', $nav_str);
        /*
        <ul class="nav-list">
            <li><a href="/">首页</a></li>
            <li><a href="#">关于</a></li>
        </ul>
        */
        ?>

        <form method="get" class="search" action="<?php echo home_url( '/' ); ?>">
            <input class="text" type="text" name="s" value="<?php echo get_search_query(); ?>">
            <input class="button" value="搜索" type="submit">
        </form>

    </header>