<script type="text/javascript">
    jQuery(document).ready(function() {
		jQuery('.meta-radio').change(function() {
			if(jQuery(this).val() == 'video') {
				jQuery('#video-url').show();
			}
			else {
				jQuery('#video-url').hide();
			}
		});
		if(jQuery('input[name="e404_portfolio_preview_options[preview_type]"]:checked').val() == 'image')
			jQuery('#video-url').hide();
	});
</script>
<div class="e404_meta_control">
	<h4>Preview Type</h4>
	<?php $mb->the_field('preview_type'); ?>
	<?php $checked = $metabox->get_the_value(); if(empty($checked)) $checked = 'image'; ?>
	<p><input type="radio" name="<?php $mb->the_name(); ?>" class="meta-radio" value="image"<?php if($checked == 'image') echo ' checked="checked"'; ?>/> Featured Image</p>
	<p><input type="radio" name="<?php $mb->the_name(); ?>" class="meta-radio" value="video"<?php if($checked == 'video') echo ' checked="checked"'; ?>/> Video</p>
	<?php $mb->the_field('preview_video'); ?>
	<p id="video-url"><label>Video URL (YouTube or Vimeo)</label> <input type="text" class="meta-text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" /></p>
</div>