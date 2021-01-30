<?php
     function getOptions() {
        $options = get_option('my_theme_options');
        if (!is_array($options)) {
            $options['meta_keywords'] = '';
            $options['meta_description'] = '';
            update_option('my_theme_options', $options);
        }
        return $options;
    }

    /* 初始化 */
    function init() {        
        if($_SERVER['REQUEST_METHOD']=="POST") {
            $options = getOptions();
            $options['meta_keywords'] = stripslashes($_POST['meta_keywords']);
            $options['meta_description'] = stripslashes($_POST['meta_description']);
            $options['site_logo'] = stripslashes($_POST['site_logo']);
            update_option('my_theme_options', $options);
        } else {
            getOptions();
        }
        add_theme_page("我的主题选项", "我的主题选项", 'edit_theme_options', "my_theme_panel_ss",  'display');
    }

    /* 界面 */
    function display() {
        $options = getOptions();
        ?>
        <form action="#" method="post" enctype="multipart/form-data" name="op_form" id="op_form">
            <div class="wrap">
                <h1>当前主题选项</h1>
                <p>相关描述</p>
                
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="meta_keywords">主题关键词</label></th>
                            <td><input name="meta_keywords" type="text" id="meta_keywords" value="<?php echo($options['meta_keywords']); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="meta_description">主题描述</label></th>
                            <td>
                                <input name="meta_description" type="text" value="<?php echo($options['meta_description']); ?>" class="regular-text">
                                <p class="description" id="tagline-description">用简洁的文字描述本站点。</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="site_logo">网站 Logo</label></th>
                            <td>
                                <input name="site_logo" type="text" value="<?php echo($options['site_logo']); ?>" class="regular-text">
                                <p class="description" id="tagline-description">填入网站 logo 的链接</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="submit" name="input_save" value="保存" />
            </div>
        </form>
        <?php
    }
    add_action('admin_menu', 'init');
 ?>

