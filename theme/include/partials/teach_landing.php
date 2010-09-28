<?= app()->partial('teach_search'); ?>

<div id="main-bars">
  <div id="bar-wide">
    <h2 class="schooltoursandprograms">School Tours and Programs</h2>
      <div id="bar-one">
        <div class="wrapper">
          <div class="michigan-map">
            <ul class="maploc">
              <li class="maploc1"><a href="/fort-wilkins" title="Fort Wilkins"> Fort Wilkins</a> <strong>Fort Wilkins</strong></li>
              <li class="maploc2"><a href="/iron-industry-museum" title="Iron Industry Museum"> Iron Industry Museum</a> <strong>Iron Industry Museum</strong></li>
              <li class="maploc3"><a href="/father-marquette-memorial" title="Father Marquette Memorial"> Father Marquette Memorial</a> <strong>Father Marquette Memorial</strong></li>
              <li class="maploc4"><a href="/fayette-historic-townsite" title="Fayette Historic Townsite"> Fayette Historic Townsite</a> <strong>Fayette Historic Townsite</strong></li>
              <li class="maploc5"><a href="/thunder-bay-national-marine-sanctuary" title="Thunder Bay National Marine Sanctuary"> Thunder Bay National Marine Sanctuary</a> <strong>Thunder Bay National Marine Sanctuary</strong></li>
              <li class="maploc6"><a href="/hartwick-pines-and-ccc-museum" title="Hartwick Pines and CCC Museum"> Hartwick Pines and CCC Museum</a> <strong>Hartwick Pines and CCC Museum</strong></li>
              <li class="maploc7"><a href="/tawas-point-historic-lighthouse" title="Tawas Point Historic Lighthouse"> Tawas Point Historic Lighthouse</a> <strong>Tawas Point Historic Lighthouse</strong></li>
              <li class="maploc8"><a href="/sanilac-petroglyphs" title="Sanilac Petroglyphs"> Sanilac Petroglyphs</a> <strong>Sanilac Petroglyphs</strong></li>
              <li class="maploc9"><a href="/michigan-historical-museum" title="Michigan Historical Museum"> Michigan Historical Museum</a> <strong>Michigan Historical Museum</strong></li>
              <li class="maploc10"><a href="/walker-tavern" title="Walker Tavern"> Walker Tavern</a> <strong>Walker Tavern</strong></li>
              <li class="maploc11"><a href="/mann-house" title="Mann House"> Mann House</a> <strong>Mann House</strong></li>
            </ul>
        </div>
        <h2 class="aroundthe"><a href="/event_manager/categories/Around the State">Around the State</a></h2>
        <?= app()->partial('event_list', array('category' => 'Around the State', 'limit' => 2)); ?>
    </div><!-- end wrapper -->
  </div><!-- end bar-one -->

  <div id="bar-two">
    <div class="wrapper">
      <h2 class="atthecenter"><a id="at-the-center">At the Center</a></h2>
      <?= app()->partial('link_list', array('category' => 'At the Center')); ?>

      <h2 class="specialprog"><a href="/event_manager/categories/Special Programs">Special Programs</a></h2>
      <?= app()->partial('event_list', array('category' => 'Special Programs', 'limit' => 2)); ?>
    </div><!-- end wrapper -->
  </div><!-- end bar-two -->
</div><!-- end bar-wide -->
  
<div id="bar-thin">
  <h2 class="justforteach">Just for Teachers</h2>
    <div id="bar-three">
      <div class="wrapper">
        <h2 class="classroom"><a id="classroom-content">Classroom Content</a></h2>
        <?= app()->partial('link_list', array('category' => 'Classroom Content')); ?>
	
        <h2 class="workshops"><a href="/event_manager/categories/Workshops">Workshops</a></h2>
        <?= app()->partial('event_list', array('category' => 'Workshops', 'limit' => 2)); ?>
      </div><!-- end wrapper -->
    </div><!-- end bar-three -->
  </div><!-- end bar-thin -->
</div><!-- end mainbars -->

<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>
