<?php
/**
 * functions and definitions
 *
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */


function p($var){
    echo "<pre>";
    print_r($var);
}



/**
 * 在dashboard 左侧外观下面，添加了“菜单”选项
 */
register_nav_menus(array('primary'=>'导航'));


function add_theme_support_all(){
	//文章编辑页，没有页面属性选择模板，添加注释 Template Name

	// 新的 WordPress 网页标题设置方法
	add_theme_support( 'title-tag' );

	/* Enable support for Post Thumbnails on posts and pages.
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );
	
}
add_action( 'after_setup_theme', 'add_theme_support_all' );



/**
 * 限制 the_excerpt() 函数生产字数
 * @param [type] $length
 * @return void
 * @author ngtwewy < 62006464@qq.com >
 * @since  2020-08-24
 */
function custom_excerpt_length( $length )
{  
    return 200;  
}  
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );




/**
 * breadcrumb 面包屑导航
 * @return void
 * @author ngtwewy < 62006464@qq.com >
 * @since  2020-08-24
 */
function get_breadcrumbs()
{
    global $wp_query;
    if (!is_home()) {
        // Start the UL
        echo '';
        // Add the Home link
        $url = get_bloginfo('siteurl');
        echo '<a href="'.$url.'">网站首页</a>';
        if (is_category()) {
            $catTitle = single_cat_title("", false);
            $cat = get_cat_ID($catTitle);
            echo " » " . get_category_parents($cat, TRUE, " » ") . "";
        } elseif (is_archive() && !is_category()) {
            echo " » Archives";
        } elseif (is_search()) {
            echo " » Search Results";
        } elseif (is_404()) {
            echo " » 404 Not Found";
        } elseif (is_single()) {
            $category = get_the_category();
			$category_id = get_cat_ID($category[0]->cat_name);
            echo ' » ' . get_category_parents($category_id, TRUE, " » ");
			// echo the_title('', '', FALSE) . "";
        } elseif (is_page()) {
            $post = $wp_query->get_queried_object();
            if ($post->post_parent == 0) {
                echo " » " . the_title('', '', FALSE) . "";
            } else {
                $title = the_title('', '', FALSE);
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                array_push($ancestors, $post->ID);
                foreach ($ancestors as $ancestor) {
                    if (
                        $ancestor != end($ancestors)
                    ) {
                        echo ' » ' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '';
                    } else {
                        echo ' » ' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '';
                    }
                }
            }
        }
        // End the UL
        echo "";
    }
}



/**
 * 获取父分菜单和父菜单的子菜单 【侧边栏使用】
 * 注意1：本函数要求所有文章只能属于一个菜单目录
 * 注意2：本函数要求顶级导航不得是文章
 * @param [type] $menuName 菜单名称
 * @param [type] $object_id 
 * @return void
 * @author ngtwewy < 62006464@qq.com >
 * @since  2020-06-13
 */
function get_menu_parent_by_id($menuName)
{
	$parentItem = '';
	// 获取菜单所有对象
	$items = wp_get_nav_menu_items($menuName);
	// p($items);die();
	// 获取当前 $object_id 的类型，是category page article
	$object_id = 0;
	$object_type = '';
	if (is_category()) { // 分类目录
		$object_id = get_queried_object_id();
		$object_type = "category";
		// echo "<br>xxxxx: 1";
	} elseif (is_archive() && !is_category()) {
		$category = get_the_category();
    	$object_id = $category[0]->cat_ID;
		$object_type = "post";
		// echo "<br>xxxxx: 2";
	} elseif (is_single() && !is_page()) { // 文章页
		$category = get_the_category();
    	$object_id = $category[0]->cat_ID;
		$object_type = "category";
		// echo "<br>xxxxx: 3";
	} elseif (is_page()) { // 页面
		$object_type = "page";
		$object_id = get_queried_object_id();
		// echo "<br>xxxxx: 4";
	}	

	// 获取 $object_id 对应的 menu_item
	$currentMenuItem = '';
	foreach ($items as $k => $v) {
		$v = (array)$v;
		if($object_id == $v['object_id'] && $object_type==$v['object']){
			$currentMenuItem = $v;
			break;
		}
	}
	if($currentMenuItem == ''){
		return "object_id 不属于菜单";
	}
	// 获取父级菜单
	if($currentMenuItem['menu_item_parent'] == 0){ // 自己本身就是父级
		$parentItem = (array)$currentMenuItem;
	}else{ // 获取父 menu_item
		$parentId = $currentMenuItem['menu_item_parent']; // 获取父 menu_item ID
		// echo "<br>获取父 menu_item: ".$parentId;
		foreach ($items as $k => $v) {
			$v = (array)$v;
			if($parentId == $v['ID']){
				$parentItem = (array)$v;
			}
		}
	}
	// 获取所有子菜单
	$parentItem['children'] = [];
	foreach ($items as $k => $v) {
		$v = (array)$v;
		if($parentItem['ID'] != 0 && $parentItem['ID'] == $v['menu_item_parent']){
			$v['my_current_object_id'] = $object_id;
			$parentItem['children'][] = $v;
		}
	}
	return $parentItem;
}


function maker_menu_classes($classes, $item, $args){
	// if($args->theme_location == "Menu1"){ // "Menu1" 是菜单ID
	// 	$classes[] = 'cxxxxxx';
	// 	echo "ssssssss: ssss";
	// }
	$classes[] = 'tag-item';
	return $classes;
}
add_filter('nav_menu_css_class', 'maker_menu_classes', 1, 3);

// add_filter('nav_menu_css_class', 'my_css_attributes_filter');
// add_filter('nav_menu_item_id', 'my_css_attributes_filter');
// add_filter('page_css_class', 'my_css_attributes_filter');
// function my_css_attributes_filter($var){
// 	return is_array($var) ? array_intersect( $var, array('current-menu-item', 'current-post-ancestor', 'current-menu-parent' )) : "";
// }



