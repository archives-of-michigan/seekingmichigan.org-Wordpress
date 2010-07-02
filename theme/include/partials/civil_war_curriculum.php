<?php
$curriculum_list = new CivilWarCurriculumList();
?>
<h2 class="curriculum"><a href="/civil-war-curriculum">Curriculum Support</a></h2>
<? if(count($curriculum_dates) > 0): ?>
  <? foreach($curriculum_dates as $date => $posts): ?>
    <h3><?= $date; ?></h3>
    <? foreach($posts as $post): ?>
      <? setup_postdata($post); ?>
      <li>
        <h4><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h4>
          <p><? the_excerpt(); ?></p>
      </li>
    <? endforeach; ?>
  <? endforeach; ?>
<? else: ?>
  <li>No entries posted yet</li>
<? endif; ?>
