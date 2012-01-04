<?php 
/*
Template Name: Teach Page
*/

while (have_posts()) {
  the_post();
  $title = the_title('','',false);
  $content = get_the_content();
}

$js_includes = array('http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '/teach', $title => '');
define('BODY_CLASS','teach landing');

include('header.php');
?>
<div id="main-content">
	<div id="left-main-content">
		<div id="tours">
			<h2>Field Sites Around the State</h2>
				<div class="michigan-map">
					<ul class="maploc">
						<li class="maploc1"><a title="Fort Wilkins" href="/fort-wilkins"> Fort Wilkins</a> <strong>Fort Wilkins</strong></li>
						<li class="maploc2"><a title="Iron Industry Museum" href="/iron-industry-museum"> Iron Industry Museum</a> <strong>Iron Industry Museum</strong></li>
						<li class="maploc3"><a title="Father Marquette Memorial" href="/father-marquette-memorial"> Father Marquette Memorial</a> <strong>Father Marquette Memorial</strong></li>
						<li class="maploc4"><a title="Fayette Historic Townsite" href="/fayette-historic-townsite"> Fayette Historic Townsite</a> <strong>Fayette Historic Townsite</strong></li>
						<li class="maploc5"><a title="Thunder Bay National Marine Sanctuary" href="/thunder-bay-national-marine-sanctuary"> Thunder Bay National Marine Sanctuary</a> <strong>Thunder Bay National Marine Sanctuary</strong></li>
						<li class="maploc6"><a title="Hartwick Pines and CCC Museum" href="/hartwick-pines-and-ccc-museum"> Hartwick Pines and CCC Museum</a> <strong>Hartwick Pines and CCC Museum</strong></li>
						<li class="maploc7"><a title="Tawas Point Historic Lighthouse" href="/tawas-point-historic-lighthouse"> Tawas Point Historic Lighthouse</a> <strong>Tawas Point Historic Lighthouse</strong></li>
						<li class="maploc8"><a title="Sanilac Petroglyphs" href="/sanilac-petroglyphs"> Sanilac Petroglyphs</a> <strong>Sanilac Petroglyphs</strong></li>
						<li class="maploc9"><a title="Michigan Historical Museum" href="/michigan-historical-museum"> Michigan Historical Museum</a> <strong>Michigan Historical Museum</strong></li>
						<li class="maploc10"><a title="Walker Tavern" href="/walker-tavern"> Walker Tavern</a> <strong>Walker Tavern</strong></li>
						<li class="maploc11"><a title="Mann House" href="/mann-house"> Mann House</a> <strong>Mann House</strong></li>
					</ul>
				</div>
		</div>
		<div id="tour-desc">
			<h2><?= $title; ?></h2>
			<?= $content; ?>
		</div>
		<?= app()->partial('sidebar_teach_programs'); ?>
	</div>

<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<? include('footer.php'); ?>
