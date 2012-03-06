<? $num_items = isset($num_items) ? $num_items : 8; ?>
<div class="flickr">
	<h3>
	  <a href="http://flickr.com/photos/<?= $friendly_user ?>/" title="View all of our photos on Yahoo's Flickr site">
	    <img src="/wp-content/themes/airbag/images/logo-flickr.gif" alt="image" width="92" height="28"/>
	    <span>Flickr</span>
	  </a>
	</h3>
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?= $num_items ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?= $account ?>"></script>
</div>
