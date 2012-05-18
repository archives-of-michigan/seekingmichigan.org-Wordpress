<?php
$wp_load = "../wp-load.php";
$i = 0;
while(!file_exists($wp_load) && $i++ < 10) {
	$wp_load = "../".$wp_load;
}
require($wp_load);

require('shortcode-manager-config.php');
$e404_options = get_option('of_options');
$shortcodes_preview = ($e404_options['e404_shortcodes_preview'] == 'true') ? '' : ' display: none;';
unset($e404_options);

if(!is_user_logged_in() || !current_user_can('edit_posts'))
	wp_die(__("You are not allowed to be here"));

if(isset($_GET['mce']) && $_GET['mce'] == 'true')
    $mce = 'true';
else
    $mce = 'false';

echo "<script type='text/javascript' src='".site_url()."/wp-includes/js/jquery/jquery.js'></script>";
if($mce == 'true') {
    echo "<script type='text/javascript' src='".site_url()."/wp-includes/js/tinymce/tiny_mce_popup.js'></script>";
    echo "<script type='text/javascript' src='".site_url()."/wp-includes/js/tinymce/utils/mctabs.js'></script>";
    echo "<script type='text/javascript' src='".site_url()."/wp-includes/js/tinymce/utils/form_utils.js'></script>";
}
$template_dir = get_bloginfo('template_directory');
echo "<script type='text/javascript' src='".$template_dir."/admin/js/colorpicker.js'></script>";
echo "<link rel='stylesheet' href='".$template_dir."/admin/css/colorpicker.css' type='text/css' media='all' />";
echo "<script type='text/javascript' src='".$template_dir."/js/jquery.dd.js'></script>";
echo "<link rel='stylesheet' href='".$template_dir."/css/dd.css' type='text/css' media='all' />";
echo "<link rel='stylesheet' href='".$template_dir."/admin/css/shortcodesmng.css' type='text/css' media='all' />";

?>
<script type="text/javascript">
    var is_mce = <?php echo $mce; ?>;
    jQuery(document).ready(function() {
        sc_init();
    });
</script>

<script type="text/javascript">
    function insertShortcode() {
        refreshCode();
        if(is_mce) {
            insertShortcodeMCE();
        }
        else {
            insertShortcodeHTML();
        }
    }
    
    function insertShortcodeMCE() {
        var tag = jQuery("#shortcodetag").val();
        tag = tag.replace(/\n/g, "<br />");
		window.tinyMCE.execInstanceCommand('content', 'mceReplaceContent', false, tag);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
    }
    
    function insertShortcodeHTML() {
        var tag = jQuery("#shortcodetag").val();
        var content = window.parent.document.getElementById("content");
        var startPos = content.selectionStart, endPos = content.selectionEnd, cursorPos = endPos, scrollTop = content.scrollTop;
        content.value = content.value.substring(0, startPos) + tag + content.value.substring(endPos, content.value.length);
        cursorPos = startPos + tag.length;
        content.focus();
        content.selectionStart = cursorPos;
        content.selectionEnd = cursorPos;
        content.scrollTop = scrollTop;
        window.parent.tb_remove();
    }

    function changeTab(id) {
		jQuery(".sc_options").each(function(index) {
			jQuery(this).css('display', 'none');
		});
		jQuery("#sc_"+id).css('display', 'block');
        refreshCode();
    }
    
    function refreshCode() {
		var sc_id = jQuery("#shortcode").val();
		if(sc_id == 0)
			return;
		var code = jQuery("#sc_" + sc_id + "_code").val();
		if(code == '') {
	        var tag = jQuery("#sc_" + sc_id + "_tag").val();
			var content = jQuery("#sc_" + sc_id + "_content").val();
			var content_value = jQuery("#sc_" + sc_id + "_content_value").val();
			var content_placeholder = jQuery("#sc_" + sc_id + "_content_placeholder").val();
			var empty_lines_before = jQuery("#sc_" + sc_id + "_empty_lines_before").val();
			var empty_lines_after = jQuery("#sc_" + sc_id + "_empty_lines_after").val();

			code = '[' + tag;
			jQuery("[id^=" + sc_id + "_]").each(function(index) {
				if((jQuery(this).attr('value') != '' && jQuery(this).attr('type') != 'checkbox') || (jQuery(this).attr('type') == 'checkbox' && jQuery(this).attr('checked'))) {
					code += ' ' + jQuery(this).attr('name') + '="' + jQuery(this).attr('value') + '"';
				}
			});
			code += ']';
			if(content == 1) {
				for(var i = 0; i < empty_lines_before; i++) {
					code += "\n";
				}
				if(content_value != '') {
					code += content_value;
				}
				else if(content_placeholder != '') {
					code += content_placeholder;
				}
				for(var i = 0; i < empty_lines_after; i++) {
					code += "\n";
				}
				code += '[/' + tag + ']';
			}
		}
		jQuery("#shortcodetag").val(code);
    }
    
    function sc_init() {
        if(is_mce) {
            var selection = tinyMCE.activeEditor.selection.getContent({format : 'raw'});
        }
        else {
            var content = window.parent.document.getElementById("content");
            var startPos = content.selectionStart, endPos = content.selectionEnd;
            var selection = content.value.substring(startPos, endPos);
        }
		jQuery("input[name=content_value]").each(function(index) {
			jQuery(this).attr('value', selection);
		});
        refreshCode();
    }

	function ddChangeValue(value, element) {
		if(value == '--')
			value = '';
		jQuery("#"+element).val(value);
		refreshCode();
	}
</script>
    
<?php
echo '<div id="sc_code">';
echo '<h3>Shortcodes:</h3>';
echo '<div id="shortcodes_select"><select name="shortcode" id="shortcode" onChange="changeTab(this.value)">';
echo '<option value="0">Pick a shortcode</option>';
$id = 0;
foreach($e404_shortcodes as $shortcode) {
	if(isset($shortcode['disabled']) && $shortcode['disabled']) {
		$disabled = ' disabled style="font-weight: bold;"';
		$option_id = 0;
	}
	else {
	    $id++;
		$disabled = '';
		$option_id = $id;
	}
    echo '<option value="'.$option_id.'"'.$disabled.'>'.$shortcode['title'].'</option>';
}
echo '</select></div>';

echo '<div id="shortcode_code"><textarea style="width: 100%;'.$shortcodes_preview.'" rows="5" id="shortcodetag" disabled name="shortcodetag"></textarea></div>';
echo '<div id="shordcode_insert"><input type="button" name="send" class="button" onclick="insertShortcode();" value="Insert shortcode" /></div>';

echo '</div>';

function e404_sc_add_colorpicker($id) {
	return "
    jQuery('#".$id."').ColorPicker({
        color: '',
        onShow: function (colpkr) {
            jQuery(colpkr).fadeIn(500);
            return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
        },
		onChange: function (hsb, hex, rgb) {
            jQuery('#".$id."').children('div').css('backgroundColor', '#' + hex);
			jQuery('#".$id."').next('input').attr('value','#' + hex);
            refreshCode();
		}
    });
	";
}

function e404_sc_add_msdropdown($id, $height) {
	if(empty($height))
		$height = 16;
	$visiblerows = floor(250 / $height);
	return "
    jQuery('#".$id."').msDropDown({ visibleRows:".$visiblerows.", rowHeight:".$height." });
	jQuery('#".$id."_title').css('height', ".$height.");
	jQuery('#".$id."_child').css('height', 250);
	";
}

$id = 0;
$e404_shortcode_manager_js_code = '';
foreach($e404_shortcodes as $shortcode) {
	if(!isset($shortcode['disabled']) || !$shortcode['disabled']) {
		$id++;
		$hidden = 'style="position: absolute;';
		if($id != 1)
			$hidden .= ' display: none;';
		if(count($shortcode['options']) == 0)
			$hidden .= ' visibility: hidden;';
		$hidden .= '"';
		echo '<div class="sc_options" id="sc_'.$id.'"'.$hidden.'>';
		if(isset($shortcode['content'])) {
			if($shortcode['content'] === true) {
				$content = 1;
				$content_description = "";
			}
			elseif(!empty($shortcode['content'])) {
				$content = 1;
				$content_description = $shortcode['content'];
			}
			else
				$content = 0;
		}
		$empty_lines_before = (isset($shortcode['empty_lines_before'])) ? $shortcode['empty_lines_before'] : 0;
		$empty_lines_after = (isset($shortcode['empty_lines_after'])) ? $shortcode['empty_lines_after'] : 0;
		if(count($shortcode['options']) > 0) {
			echo '<h3>Options:</h3>';
			echo '<table>';
		}
		echo '<input type="hidden" name="tag" id="sc_'.$id.'_tag" value="'.$shortcode['tag'].'" />';
		$code = (isset($shortcode['code'])) ? $shortcode['code'] : '';
		echo '<input type="hidden" name="code" id="sc_'.$id.'_code" value="'.$code.'" />';
		echo '<input type="hidden" name="content" id="sc_'.$id.'_content" value="'.$content.'" />';
		$content_placeholder = (isset($shortcode['content_placeholder'])) ? $shortcode['content_placeholder'] : '';
		echo '<input type="hidden" name="content_placeholder" id="sc_'.$id.'_content_placeholder" value="'.$content_placeholder.'" />';
		echo '<input type="hidden" name="empty_lines_before" id="sc_'.$id.'_empty_lines_before" value="'.$empty_lines_before.'" />';
		echo '<input type="hidden" name="empty_lines_after" id="sc_'.$id.'_empty_lines_after" value="'.$empty_lines_after.'" />';
		if($content == 1 && !empty($content_description))
			echo '<tr><td class="label"><label for="sc_'.$id.'_content_value">'.$content_description,'</label></td><td class="field"><input type="text" name="content_value" id="sc_'.$id.'_content_value" class="sc_option" onKeyUp="refreshCode();" onChange="refreshCode();" /></td></tr>';
		else
			echo '<input type="hidden" name="content_value" id="sc_'.$id.'_content_value" />';
		$colorpicker_instance = $msdropdown_instance = 0;
		foreach($shortcode['options'] as $option => $options) {
			$default = (isset($options['default'])) ? $options['default'] : '';
			echo '<tr>';
			switch ($options['type']) {
				case 'switch':
					echo '<td class="label"><label for="'.$id.'_'.$option.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><select id="'.$id.'_'.$option.'" class="sc_option" name="'.$option.'" onChange="refreshCode();">';
					echo '<option value="true">Yes</option>';
					echo '<option value="false">No</option>';
					echo '</select></td>';
					break;
				case 'select':
					echo '<td class="label"><label for="'.$id.'_'.$option.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><select id="'.$id.'_'.$option.'" class="sc_option" name="'.$option.'" onChange="refreshCode();">';
					foreach($options['values'] as $value => $description) {
						$selected = ($value == $default) ? ' selected' : '';
						echo '<option value="'.$value.'"'.$selected.'>'.$description.'</option>';
					}
					echo '</select></td>';
					break;
				case 'select2':
					echo '<td class="label"><label for="'.$id.'_'.$option.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><select id="'.$id.'_'.$option.'"class="sc_option" name="'.$option.'" onChange="refreshCode();">';
					foreach($options['values'] as $value) {
						$title = (empty($value)) ? '(default)' : $value;
						$selected = ($value == $default) ? ' selected' : '';
						echo '<option value="'.$value.'"'.$selected.'>'.$title.'</option>';
					}
					echo '</select></td>';
					break;
				case 'icons':
					$msdropdown_instance++;
					$msd_height = (isset($options['height'])) ? $options['height'] : 0;
					echo '<td class="label"><label for="msdropdown_'.$id.'_'.$msdropdown_instance.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><input type="hidden" class="sc_option" name="'.$option.'" id="'.$id.'_'.$option.'" value="" />';
					echo '<select style="width: 200px;" id="msdropdown_'.$id.'_'.$msdropdown_instance.'" name="'.$option.'_dd" onChange="ddChangeValue(jQuery(this).val(), \''.$id.'_'.$option.'\');">';
					$icons_dir = (isset($options['icons_dir'])) ? $options['icons_dir'] : '';
					foreach($options['values'] as $value) {
						if(!empty($value))
							$ddimage = $icons_dir.'/'.$value.'.png';
						else {
							$ddimage = '';
							$value = '--';
						}
						echo '<option value="'.$value.'" title="'.$ddimage.'">'.$value.'</option>';
					}
					echo '</select></td>';
					$e404_shortcode_manager_js_code .= e404_sc_add_msdropdown('msdropdown_'.$id.'_'.$msdropdown_instance, $msd_height);
					break;
				case 'text':
					echo '<td class="label"><label for="'.$id.'_'.$option.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><input type="text" id="'.$id.'_'.$option.'" class="sc_option" name="'.$option.'" value="'.$default.'" onKeyUp="refreshCode();" onChange="refreshCode();" /></td>';
					break;
				case 'number':
					echo '<td class="label"><label for="'.$id.'_'.$option.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><input type="text" id="'.$id.'_'.$option.'" class="sc_option" name="'.$option.'" value="'.$default.'" onKeyUp="refreshCode();" onChange="refreshCode();" /></td>';
					break;
				case 'checkbox':
					echo '<td class="label"><label for="'.$id.'_'.$option.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><input type="checkbox" id="'.$id.'_'.$option.'" class="sc_option" name="'.$option.'" value="true" onClick="refreshCode();" /></td>';
					break;
				case 'color':
					$colorpicker_instance++;
					echo '<td class="label"><label for="colorPicker_'.$id.'_'.$colorpicker_instance.'">'.$options['title'].'</label></td>';
					echo '<td class="field"><div class="colorSelector" id="colorPicker_'.$id.'_'.$colorpicker_instance.'"><div></div></div><input type="text" id="'.$id.'_'.$option.'" class="sc_option sc_color" name="'.$option.'" onKeyUp="refreshCode();" onChange="refreshCode();" /></td>';
					$e404_shortcode_manager_js_code .= e404_sc_add_colorpicker('colorPicker_'.$id.'_'.$colorpicker_instance);
					break;
			}
			echo '</tr>';
		}
		if(count($shortcode['options']) > 0) {
			echo '</table>';
		}
		echo '</div>';
	}
}

?>

<script type='text/javascript'>
jQuery(document).ready(function(){
<?php echo $e404_shortcode_manager_js_code; ?>
});
</script>
