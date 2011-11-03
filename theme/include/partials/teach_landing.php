<?= app()->partial('teach_search'); ?>

<div id="main-content">
		       		<div id="feature">
		       			<div id="left-feature">
		       				<a href="http://seekingmichigan.org/teach/programs/2011/09/22/general-tour">
		       				<img src="/images/teach-feature-program.jpg" alt="Programs" /></a>
						<div id="txt-left-feature">
							<h2><a href="http://seekingmichigan.org/teach/programs/2011/09/22/general-tour"> Time Traveler Tours<span class="white-arrow"></span></a></h2>
							<p><a href="http://seekingmichigan.org/teach/programs/2011/09/22/general-tour">These guided tours of the entire museum last approximately 90 minutes.</a></p>
						</div>
					</div>
					<div id="middle-feature">
						<a href="/teach/lessons/"><img src="/images/teach-feature-lesson.jpg"  alt="Lessons" /></a>
						<div id="txt-middle-feature">
						<?php $lesson_query = new WP_Query( array ('cat' => 1081, 'posts_per_page' => 1) ); ?>

						<?php while ($lesson_query->have_posts()) : $lesson_query->the_post(); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="white-arrow"></span></a></h2>
							<p><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></p>
						<?php endwhile; ?>

						</div>
					</div>
					<div id="right-feature">
						<a href="/teach/events/"><img src="/images/teach-feature-event.jpg" /></a>
						<div id="txt-right-feature">
						<?php $event_query = new WP_Query( array ('cat' => 1167, 'posts_per_page' => 1) ); ?>

						<?php while ($event_query->have_posts()) : $event_query->the_post(); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="white-arrow"></span></a></h2>
							<p><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></p>
						<?php endwhile; ?>
						</div>
					</div>
				</div>
				<div id="content">
					<div id="left-content">
						<div id="header-left-content">
							<a href="/teach/programs/"><img src="/images/teach-home-program-header.jpg" /></a>
						</div>
						<div id="list-left-content">
							<ul>
								<li>
									<a href="http://seekingmichigan.org/teach/programs/2011/09/22/the-big-history-lesson">
									<img src="/images/teach-home-icon-tour.jpg" alt="Big History Lesson" />
									<span class="subheader">Big History Lesson</span></a>
									<p>Students and teacher use the Michigan Historical Museum as their classroom for an 
									extended, in-depth study of Michigan history.</p>
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-prog.jpg" alt="History Excursions" />
									<span class="subheader">Museum Explorations</span></a>
									<p>Interested in more than the typical field trip for your group? 
									There is a fee for these specialized programs that range from 90 minutes to three 
									hours and incorporate hands-on elements. </p>							
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-school.jpg" alt="Home School" />
									<span class="subheader">Home Schoolers</span></a>
									<p>The Michigan Historical Museum now offers some of its most popular educational 
									group programs to home school students.</p>
								</li>
							</ul>
						</div>
					</div>
					<div id="middle-content">
						<div id="header-middle-content">
							<a href="/teach/lessons/"><img src="/images/teach-home-lesson-header.jpg" /></a>
						</div>
						<div id="list-middle-content">
							<ul>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-state.jpg" alt="Statehood" />
									<span class="subheader">Statehood</span></a>
									<p>Lesson plans from the Michigan Historical Center to explore Michigan's development
									as a state.</p>
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-travel.jpg" alt="Immigration" />
									<span class="subheader">Pioneer Life</span></a>
									<p>Lesson plans from the Michigan Historical Center to explore pioneer life within 
									Michigan.</p>							
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-cw.jpg" alt="Civil War" />
									<span class="subheader">Civil War</span></a>
									<p>Lesson plans from the Michigan Historical Center to explore Michigan's involvment
									in the Civil War.</p>
								</li>
							</ul>
						</div>
					</div>
					<div id="right-content">
						<div id="header-right-content">
							<a href="/teach/events/"><img src="/images/teach-home-event-header.jpg" /></a>
						</div>
						<div id="list-right-content">
							<ul>
							<?php $events_query = new WP_Query( array ('cat' => 1167, 'posts_per_page' => 3) ); ?>
							<?php while ($events_query->have_posts()) : $events_query->the_post(); ?>
								<li>
									<a href="<?php the_permalink(); ?>">
									<img src="/images/teach-home-icon-calendar.jpg" alt="Event" />
									<span class="subheader"><?php the_title(); ?></span></a>
									<p><?php the_excerpt(); ?></p>
								</li>
							<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
				<div id="boxes">
					<div id="box1wrap">
						<div id="box1">
							<div id="box1txt">
							<a href="http://www.loc.gov/teachers/usingprimarysources/">Using Primary Resources</a>
							</div>
						</div>
					</div>
					<div id="box2wrap">
						<div id="box2">
							<div id="box2txt">
							<a href="http://seekingmichigan.org/field-sites">Explore MI History</a>
							</div>
						</div>
					</div>
					<div id="box3wrap">
						<div id="box3">
							<div id="box3txt">
							<a href="http://seekingmichigan.org/plant-a-visit">Plan a Visit</a>
							</div>
						</div>
					</div>
					<div id="box4wrap">
						<div id="box4">
							<div id="box4txt">
							<a href="">Professional Development</a>
							</div>
						</div>
					</div>
					<div id="box5wrap">
						<div id="box5">
							<div id="box5txt">
							<a href="/teach/resources/">Teaching Resources</a>
							</div>
						</div>
					</div>
				</div>
				<div id="boxes-btm"></div>
							
		       <!-- ADD NEW STUFF HERE -->
		       
		       </div>

<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>
