<div id="sidebar">
	<div class="wrapper">
    <a href="/category/look/feed/" title="RSS Feed" alt="RSS Feed for Look">
      <h2 class="rss">About Look</h2>
    </a>
		<p>"If you seek a pleasant peninsula, look about you." The Michigan state motto served as the 
		  inspiration for this blog. If you look, you will find stories, photos and more to connect 
		  you to this great state and its wonderful history.</p>
		
		<div class="featured">
			<?= featured_article('featured-look-item','Featured Item'); ?>
		</div>

		<? include('include/twitter.php'); ?>
		
		<? flickr('23925622@N02', 'archivesofmichigan'); ?>
		
		<? include('include/vimeo.php'); ?>
		
		<div class="recent-content">
			<? recent_articles(3,5); ?>
			<? recent_comments('look',3); ?>
		</div>
	</div>
	<p class="further">
    <a title="Look more" href="/archive">Look more</a>
  </p>
</div>