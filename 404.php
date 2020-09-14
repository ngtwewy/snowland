<?php
/**
 * 404 模版
 * 
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

get_header();
?>

	<div class="page-no-found">
		<img src="<?php bloginfo('template_url'); ?>/assets/images/404.gif" alt="404 页面没找到">
		<p>404 页面没找到</p>
		<a href="<?php bloginfo('url'); ?>">返回首页</a>
	</div>


<?php
get_footer();
