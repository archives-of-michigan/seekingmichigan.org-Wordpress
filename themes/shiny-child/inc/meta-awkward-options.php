<?php global $wpalchemy_media_access; ?>
<div class="e404_meta_control">
	<p>These options are valid only for the Awkward Showcase slider.</p>
 
	<?php $mb->the_field('thumbnail'); ?>
	<?php $wpalchemy_media_access->setGroupName('thumbnail')->setInsertButtonLabel('Insert'); ?>
	<p>
		<strong>Slide Thumbnail</strong> (optional)
		<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'class' => 'meta-text', 'value' => $mb->get_the_value())); ?>
		<?php echo $wpalchemy_media_access->getButton(array('label' => 'Add Thumbnail')); ?>
	</p>
 
 	<h4>Tooltips</h4>
 
	<a style="float:right; margin:0 10px;" href="#" class="dodelete-tooltips button">Remove All</a>
 
	<?php while($mb->have_fields_and_multi('tooltips')): ?>
	<?php $mb->the_group_open(); ?>
		<hr />
			<label>Coordinates</label>
			<?php $mb->the_field('coords_x'); ?>
			<p>X: <input type="text" class="meta-coords" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	
			<?php $mb->the_field('coords_y'); ?>
			Y: <input type="text" class="meta-coords" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	
			<?php $mb->the_field('coords_button'); ?>
			<input type="button" name="<?php $mb->the_name(); ?>" alt="<?php echo get_bloginfo('template_url').'/inc/meta-tooltip-picker-view.php?width=1000&height=400&eid=0&id='; ?>" value="Set coords" title="Click to set tooltip coordinates" class="thickbox set_coords_button" />
			</p>

			<?php $mb->the_field('url'); ?>
			<p>Tooltip target URL (optional): <input type="text" class="meta-text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>

			<?php $mb->the_field('content'); ?>
			<label>Tooltip content:</label>
			<p><textarea style="width: 100%" name="<?php $mb->the_name(); ?>"><?php $mb->the_value(); ?></textarea></p>
			<p><a href="#" class="dodelete button">Remove Tooltip</a></p>

 	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>
 
	<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-tooltips button">Add Tooltip</a></p>

</div>