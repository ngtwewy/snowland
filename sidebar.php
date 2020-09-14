<?php
/**
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */
?>


<div class="tag-container">
    <div class="right-sider-title">
        分类标签
    </div>
    <!-- <ul class="tag-list">
        <li class="tag-item active"><a href="#">全部</a></li>
        <li class="tag-item"><a href="#">测试标签</a></li>
    </ul> -->
    <?php 
    $nav_str = wp_nav_menu( array(  
        'theme_location'    => '', //[保留]用于在调用导航菜单时指定注册过的某一个导航菜单名，如果没有指定，则显示第一个  
        'menu'              => 'Menu1', //[可删]使用导航菜单的名称调用菜单，可以是 id, slug, name (按顺序匹配的) 。  
        'container'         => false, //[可删]最外层容器标签名  
        'container_class'   => '',//[可删]最外层容器class名  
        'container_id'      => '',//[可删]最外层容器id值  
        'menu_class'        => 'tag-list', //[可删]ul 节点的 class 属性值  
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
    ?>
</div><!-- .tag-container -->

<div class="article-container">
    <div class="right-sider-title">
        随机推荐
    </div>
    <div class="article-list">
        <?php
        $args = array( 'numberposts' => 8, 'orderby' => 'rand', 'post_status' => 'publish' );
        $rand_posts = get_posts( $args );
        foreach( $rand_posts as $post ) : ?>
            <div class="article-item">
                <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>