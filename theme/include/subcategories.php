<h2>Categories</h2>
<? 
	$subcats = get_categories(array(
		'orderby' => 'name', 
		'order' => 'ASC',
		'hide_empty' => 0,
		'child_of' => 4
	));
	
	$midpoint = sizeof($subcats) / 2;
	$col1 = array_slice($subcats, 0, $midpoint);
	$col2 = array_slice($subcats, $midpoint);
	
	$columns = array($col1,$col2);
	$col_count = 1;
?>
<? foreach($columns as $column_with_cats): ?>
	<? if($column_with_cats): ?>
		<ul class="column<?= $col_count; ?>">
			<? foreach($column_with_cats as $subcat): ?>
				<li><a href="<?= get_category_link($subcat->term_id); ?>"><?= $subcat->cat_name ?></a></li>
			<? endforeach; ?>
		</ul>
	<? endif; ?>
	<? $col_count = $col_count + 1; ?>
<? endforeach; ?>