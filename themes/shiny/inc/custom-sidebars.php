<?php
$e404_custom_sidebars = get_option('e404_custom_sidebars');
if(!$e404_custom_sidebars) {
    // add default sidebar
    $e404_custom_sidebars = array('(default)');
    update_option('e404_custom_sidebars', $e404_custom_sidebars);
}

// custom sidebars registration
foreach($e404_custom_sidebars as $sidebar) {
    if($sidebar != '(default)') {
        register_sidebar(array(	'name' => $sidebar.' (custom)',
                                'before_widget' => '<div id="%1$s" class="widgets %2$s">',
                                'after_widget' => "</div>\n",
                                'before_title' => '<h3>',
                                'after_title' => "</h3>\n"));
    }
}

// get the custom sidebar name
function e404_get_sidebar_name($section) {
    global $wp_query, $e404_custom_sidebars;

    $sections = array('blog', 'gallery', 'page', 'portfolio');
    if(!in_array($section, $sections))
        return;
    
    if(is_category()) {
        $category = $wp_query->query_vars['cat'];
        $sidebar = get_option('e404_category_'.$category.'_sidebar');
        if($sidebar && $sidebar != '(default)')
            return $sidebar.' (custom)';
        else
            return 'e404_'.$section.'_sidebar';
    }
    else {
        if(isset($wp_query->queried_object->ID))
            $sidebar = get_post_meta($wp_query->queried_object->ID, 'e404_custom_sidebar', true);
        else
            $sidebar = false;
        if($sidebar && $sidebar != '(default)')
            return $sidebar.' (custom)';
        else
            return 'e404_'.$section.'_sidebar';
    }
}

// sidebars options page
function e404_add_options_panel() {
//    add_submenu_page('themes.php', __('Manage Sidebars', 'shiny'), __('Sidebars', 'shiny'), 'level_8', 'custom_sidebars', 'e404_sidebars_options_page');
    add_theme_page(__('Manage Sidebars', 'shiny'), __('Sidebars', 'shiny'), 'level_8', 'custom_sidebars', 'e404_sidebars_options_page');
}
add_action('admin_menu', 'e404_add_options_panel');

function e404_sidebars_options_page() {
    global $e404_custom_sidebars;
    
    echo '<div class="wrap"><h2>'.__('Manage Sidebars', 'shiny').'</h2>';

    if(isset($_POST['add_sidebar'])) {
        $sidebar_name = trim(strip_tags($_POST['new_sidebar_name']));
        if(!empty($sidebar_name)) {
            $index = array_search($sidebar_name, $e404_custom_sidebars);
            if($index === false) {
                $e404_custom_sidebars[] = $sidebar_name;
                sort($e404_custom_sidebars);
                update_option('e404_custom_sidebars', $e404_custom_sidebars);
                echo '<div id="message" class="updated below-h2"><p>'.__('New sidebar added.', 'shiny').'</p></div>';
            }
        }
    }
    
    if(isset($_GET['sidebar_id']) && $_GET['action'] == 'delete') {
        $sidebar_name = trim(strip_tags(urldecode($_GET['sidebar_id'])));
        if(!empty($sidebar_name) && $sidebar_name != '(default)') {
            $new_array = array();
            foreach($e404_custom_sidebars as $sidebar) {
                if($sidebar != $sidebar_name)
                    $new_array[] = $sidebar;
            }
            $e404_custom_sidebars = $new_array;
            sort($e404_custom_sidebars);
            update_option('e404_custom_sidebars', $e404_custom_sidebars);
            echo '<div id="message" class="updated below-h2"><p>'.__('Sidebar removed.', 'shiny').'</p></div>';
        }
    }
    
    echo '<table class="widefat page fixed" cellspacing="0">';
    echo '<thead><tr><th>'.__('Sidebar Name', 'shiny').'</th><th>'.__('Action', 'shiny').'</th></tr></thead>';
    echo '<tfoot><tr><th>'.__('Sidebar Name', 'shiny').'</th><th>'.__('Action', 'shiny').'</th></tr></tfoot><tbody>';
    foreach($e404_custom_sidebars as $sidebar) {
        echo '<tr><td>'.$sidebar.'</td><td>';
        if($sidebar != '(default)')
            echo '<a href="themes.php?page=custom_sidebars&action=delete&sidebar_id='.$sidebar.'">Delete</a>';
        else
            _e('The default sidebar can\'t be removed', 'shiny');
        echo '</td></tr>';
    }
    echo '</tbody></table>';
    echo '<form method="post" action=""><div class="form-field"><label for="new_sidebar_name">'.__('Add new sidebar', 'shiny').'</label> <input style="width: 200px" id="new_sidebar_name" name="new_sidebar_name" />';
    echo '<input type="submit" name="add_sidebar" id="add_sidebar" value="Add" style="width: auto" class="button-secondary action" />';
    echo '</div></form>';
    
    echo '</div>';
}

// saving category sidebar changes
add_action('created_term', 'e404_save_category_sidebar');
add_action('edit_term', 'e404_save_category_sidebar');
add_action('delete_term', 'e404_delete_category_sidebar');

// sidebar selection for categories
add_action('category_add_form_fields', 'e404_add_category_sidebar_box');
add_action('category_edit_form', 'e404_add_category_sidebar_box');

function e404_add_category_sidebar_box($tag) {
    global $e404_custom_sidebars;

    if(is_object($tag)) {
        $tag_ID = $tag->term_id;
        $category_sidebar = get_option('e404_category_'.$tag_ID.'_sidebar');
        echo '<table class="form-table"><tbody>';
        echo '<tr class="form-field"><th><label for="e404_category_sidebar">'.__('Sidebar', 'shiny').'</label></th><td><select name="e404_category_sidebar" class="postform" id="e404_category_sidebar">';
    }
    else {
        echo '<div class="form-field"><label for="e404_category_sidebar">'.__('Sidebar', 'shiny').'</label><select name="e404_category_sidebar" class="postform" id="e404_category_sidebar">';
    }
    foreach($e404_custom_sidebars as $sidebar) {
        if($category_sidebar == $sidebar)
            $selected = ' selected';
        else
            $selected = '';
        echo '<option value="'.$sidebar.'"'.$selected.'>'.$sidebar.'</option>';
    }
    if($tag_ID) {
        echo '</select><br /><span class="description">'.__('Select a custom sidebar for this category or pick "default" for default blog sidebar.', 'shiny').'</span></td></tr></tbody></table>';
    }
    else {
        echo '</select><p>'.__('Select a custom sidebar for this category or pick "default" for default blog sidebar.', 'shiny').'</p></div>';
    }
}

function e404_save_category_sidebar($id) {
    if(isset($_POST['e404_category_sidebar']))
        update_option('e404_category_'.$id.'_sidebar', $_POST['e404_category_sidebar']);
}

function e404_delete_category_sidebar($id) {
    delete_option('e404_category_'.$id.'_sidebar');
}

?>