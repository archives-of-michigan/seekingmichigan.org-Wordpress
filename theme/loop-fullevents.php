<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php global $post; $custom = get_post_custom(); ?>

    <li>
	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<p class="description"><?php echo get_the_excerpt(); ?> &nbsp;&nbsp;
	<a href="<?php the_permalink(); ?>">read more &raquo;</a></p>
	<p class="date"><?php echo date("F jS", strtotime($custom["_event_start_date"][0]));
	echo date(" | g:i A", strtotime ($custom["_event_start_time"][0])); 
	echo " to "; 
	if ($custom["_event_start_date"][0] != $custom["_event_end_date"][0]) {
		echo date("F jS | ", strtotime($custom["_event_end_date"][0]));
	}
	echo date("g:i A", strtotime ($custom["_event_end_time"][0])); ?></p>
		<div class="details">
			<ul>
			<li class="location">
				<?php $qtext = "http://maps.google.com/maps?q=";  
				$qtext .= str_replace(" ", "+", $custom["_event_location"][0]); ?>
				<a href="<?php echo $qtext; ?>"><?php echo $custom["_event_location"][0]; ?></a>
			</li>
			<li class="share-link">
				<a class="addthis" title="" rel="" href="http://www.addthis.com/bookmark.php">Share This</a>
			</li>
			</ul>
		</div>
	</li>
    
    <?php endwhile; ?>
<?php endif; ?>
