<div id="sidebar">
	<div class="wrapper">
    <a href="/category/look/feed/" title="RSS Feed" alt="RSS Feed for Look">
      <h2 class="rss">About Look</h2>
    </a>
		<p>"If you seek a pleasant peninsula, look about you." The Michigan state motto served as the 
		  inspiration for this blog. If you look, you will find stories, photos and more to connect 
		  you to this great state and its wonderful history.</p>
		
		<div class="featured">
      <?= app()->partial('featured_article', array(
        'category' => 'featured-look-item',
        'title' => 'Featured Item')); ?>
		</div>

		<?= app()->partial('twitter'); ?>
		
    <?= app()->partial('flickr', array(
          'account' => '23925622@N02', 
          'friendly_user' => 'archivesofmichigan')); ?>
		
    <?= app()->partial('vimeo'); ?>
		
		<div class="recent-content">
			<?= app()->partial('recent_articles', array('category' => 3, 'num' => 5)); ?>
      <?= app()->partial('recent_comments', array('category' => 'look', 'num' => 3, 'wpdb' => $wpdb)); ?>
		</div>
	</div>
	<p class="further">
    <a title="Look more" href="/archive">Look more</a>
  </p>
</div>
