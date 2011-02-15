<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php global $post; $custom = get_post_custom(); ?>
	
      <li class="event_item">
      <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
	<?php the_title(); ?><br />
	<?php echo date("d/m/Y", strtotime($custom["_event_start_date"][0])); ?><span class="yellow-arrow"></span><a/><!-- <?php echo $custom["_event_start_date"][0]; ?> -->
    </li>
    <?php endwhile; ?>
<?php endif; ?>
