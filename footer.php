<?php
/**
 * footer 模版
 * 
 * Author: ngtwewy <62006464@qq.com>
 * Author URI: http://javascript.net.cn
 * Theme URI: https://github.com/ngtwewy/snowland
 * License: Apache Licence 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

?>

	<footer>
        <div class="footer-container">
            <div class="footer-info">
                <img src="<?php bloginfo('template_url'); ?>/assets/images/logo-white.png">
                <p>
                    <?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>
                </p>
            </div>
            <div class="footer-links">
                <h2>友情链接</h2>
                <a href="http://restfulapi.cn/" target="_blank">RESTfulAPI</a>
                <a href="https://www.shenqigushi.com/" target="_blank">神奇故事</a>
            </div>
            <div class="qrcode-container">
                <div class="qrcode">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/qrcode-wx.png" alt="">
                    <p>微信号 puzzle</p>
                </div>
            </div>
        </div>
        <!-- <div class="footer-container"> -->
        <div class="footer-bottom">
            <p class="copyright">
                &copy; Copyright
                <?php echo date("Y");?>
                <a href="<?php echo bloginfo('url')?>"><?php echo bloginfo('name')?></a>
                All Rights Reserved.
                <b>♥</b>
                Design by <a href="http://javascript.net.cn" target="_blank">进击的鱿船长</a>
            </p>
        </div>
        <!-- </div> -->

    </footer>

    <!-- 回到顶部 -->
    <a class="to-top" onclick="javascript:;" style="display: none;"></a>

	<script src="<?php bloginfo('template_url'); ?>/assets/js/main.js"></script>
	<?php wp_footer(); ?>
</body>

</html>
