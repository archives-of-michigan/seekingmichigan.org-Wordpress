<?php
require_once(dirname(__FILE__).'/../../lib/civil_war_reveille_list.php');
$reveille_dates = CivilWarReveilleList::grouped_by_date(); 
?>

<h2 class="reveille"><a href="/reveille">Reveille!</a></h2>
<? if(count($reveille_dates) > 0): ?>
  <? foreach($reveille_dates as $date => $posts): ?>
    <h3><?= $date; ?></h3>
    <ul>
      <? foreach($posts as $post): ?>
        <? setup_postdata($post); ?>
        <li>
          <h4><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h4>
          <p><? the_excerpt(); ?></p>
        </li>
      <? endforeach; ?>
    </ul>
  <? endforeach; ?>
<? else: ?>
  <li>No entries posted yet</li>
<? endif; ?>
