<div id="sidebar">
	<div class="wrapper">
    <a href="/category/teach/feed/" title="RSS Feed" alt="RSS Feed for Look">
      <h2 class="rss">About Teach</h2>
    </a>
		<p>Thinking like a historian means using the materials historians use. Here you can find both selected materials (photographs, objects, stories, maps, buildings and documents like those below) and ideas to help your students use them. To get started, scroll though the skills ideas on the left. Or run down the Content Expectations below. Or, if you know what you’re looking for, search the Teach portion of Seeking Michigan by subject or content expectation, or search the whole site.</p>
    <p>Wherever you start, we want to hear from you. Share your thoughts on what works—and what doesn’t work. Tell us what you would like to see that isn’t here. And tell each other about your strategies for getting students engaged in Michigan history, geography, economics and civics.</p>
		
		<div class="featured">
      <?= app()->partial('featured_article', array(
        'category' => 'michigan-history-for-kids-magazine',
        'title' => 'Michigan History For Kids Magazine')); ?>
			<p>&raquo; <a href="http://www.michiganhistorymagazine.com/kids/kids_products.html">View Magazine Archives</a></p>
		</div>
		
		<div class="search mod">
			<form id="teach-search" action="<?= bloginfo('home'); ?>" method="get" >
				<input type="text" id="search-teach-text" name="s" class="search-teach-text" />
				<input type="image" id="search-teach-button" src="/images/search-button.png" value=" " />
			</form>
		</div>
		
		<?= app()->partial('twitter'); ?>
		
    <?= app()->partial('flickr', array(
          'account' => '34791591@N04', 
          'friendly_user' => 'teachingmi')); ?>
		
    <?= app()->partial('vimeo'); ?>
		
		<div class="recent-content">
			<? include('include/subcategories.php'); ?>
			<div style="margin-top: 1.5em;"><a href="/look">Look</a> for more teaching resources</div>
		</div>
	</div>
	<p class="further">
	  <a title="Teach more" href="/teach">Teach more</a>
	</p>
</div>
