<?php
function e404_add_shortcodes_button_html() {
?>
    <script type="text/javascript">
        jQuery(window).load(function() {
            var button_html = ' <input type="button" alt="<?php echo get_bloginfo('template_url').'/inc/shortcode-manager-view.php?TB_iframe=1'; ?>" value="shortcodes" title="Shortcode Manager" class="thickbox ed_button" id="e404_shortcodes" />';
            jQuery("#ed_toolbar").append(button_html);
        });
    </script>
<?php
}
add_action('admin_footer', 'e404_add_shortcodes_button_html');

function e404_add_shortcodes_button_tinymce() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
        return;
    if (get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", 'e404_add_shortcode_manager_tinymce_plugin');
        add_filter('mce_buttons', 'e404_register_shortcode_manager_button');
    }
}
function e404_add_shortcode_manager_tinymce_plugin($plugin_array) {
    $plugin_array['e404ShortcodeManager'] = get_bloginfo('template_url').'/inc/shortcode-manager-plugin.php';
    return $plugin_array;
}
function e404_register_shortcode_manager_button($buttons) {
    array_push($buttons, "separator", "e404ShortcodeManager");
    return $buttons;
}
add_action('init', 'e404_add_shortcodes_button_tinymce');
?>