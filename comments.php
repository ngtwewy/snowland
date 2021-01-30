<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
        die ('Please do not load this page directly. Thanks!');
    }
?>

<?php
function aurelius_comment($comment, $args, $depth){
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
        <div class="gravatar"> 
            <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
            <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <div class="comment_content" id="comment-<?php comment_ID(); ?>">
            <div class="clearfix">
                <?php printf(__('<div class="author_name">%s</div>'), get_comment_author_link()); ?>
                <?php edit_comment_link('修改'); ?>
            </div>
            <div class="comment_text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>你的评论正在审核，稍后会显示出来！</em><br />
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
            <div class="comment-meta commentmetadata">
                发表于：<?php echo get_comment_time('Y-m-d H:i'); ?>
            </div>
        </div>
    </li>
<?php } ?>

<ul class="comment-list">
    <?php
    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
    // if there's a password
    // and it doesn't match the cookie
    ?>
        <li class="decmt-box">
            <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
        </li>
    <?php
    } else if ( !comments_open() ) {
    ?>
        <li class="decmt-box">
            <p><a href="#addcomment">评论功能已经关闭!</a></p>
        </li>
    <?php
        } else if ( !have_comments() ) {
    ?>
        <li class="decmt-box">
            <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
        </li>
    <?php
        } else {
            wp_list_comments('type=comment&callback=aurelius_comment');
        }
    ?>
</ul>


<div class="hr clearfix"> </div>



<!-- Comment Form -->
<?php 
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) : 
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
<!-- Comment Form -->
<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
    <h3>发表评论</h3>
    <div class="hr dotted clearfix"> </div>
    <ul>
        <?php if ( !is_user_logged_in() ) : ?>
        <li class="clearfix">
            <label for="name">昵称<span>*</span></label>
            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="23" tabindex="1" />
        </li>
        <li class="clearfix">
            <label for="email">邮箱<span>*</span></label>
            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="23" tabindex="2" />
        </li>
        <li class="clearfix">
            <label for="email">网址</label>
            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="23" tabindex="3" />
        </li>
        <?php else : ?>
        <li class="clearfix">您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 »</a></li>
        <?php endif; ?>
        <li class="clearfix">
            <label for="message">评论</label>
            <textarea id="message comment" name="comment" tabindex="4" rows="3" cols="40"></textarea>
        </li>
        <li class="clearfix">
            <!-- Add Comment Button -->
            <a href="javascript:void(0);" onClick="Javascript:document.forms['commentform'].submit()" class="button medium black right">发表评论</a>
        </li>
    </ul>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>