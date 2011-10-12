<?= app()->partial('teach_search'); ?>

<div id="main-content">
		       		<div id="feature">
		       			<div id="left-feature">
		       				<a href="/teach/programs/"><img src="/images/teach-home-program-feature-round.png" /></a>
						<div id="txt-left-feature">
						<?php
						  $args = array( 'numberposts' => 1, 'category' => 1080 ); // program category
						  $programposts = get_posts( $args );
						  foreach ($programposts as $post) : setup_postdata($post); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="white-arrow"></span></a></h2>
							<p><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></p>
						<?php endforeach; ?>
						</div>
					</div>
					<div id="middle-feature">
						<a href="/teach/lessons/"><img src="/images/teach-home-lesson-feature-round.png" /></a>
						<div id="txt-middle-feature">
						<?php
						  $args = array( 'numberposts' => 1, 'category' => 1081 ); // lessons category
						  $lessonposts = get_posts( $args );
						  foreach ($lessonposts as $post) : setup_postdata($post); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="white-arrow"></span></a></h2>
							<p><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></p>
						<?php endforeach; ?>
						</div>
					</div>
					<div id="right-feature">
						<a href="/teach/events/"><img src="/images/teach-home-event-feature-round.png" /></a>
						<div id="txt-right-feature">
						<?php
						  $args = array( 'numberposts' => 1, 'category' => 1167 ); // event category
						  $eventposts = get_posts( $args );
						  foreach ($eventposts as $post) : setup_postdata($post); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="white-arrow"></span></a></h2>
							<p><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></p>
						<?php endforeach; ?>
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
									<a href="">
									<img src="/images/teach-home-icon-school.jpg" alt="Home School" />
									<span class="subheader">For Home Schoolers</span>
									The Michigan Historical Museum now offers some of its most popular educational 
									group programs to home school students.  Programs are offered for a vareity of grade 
									levels and topics.</a>
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-prog.jpg" alt="History Excursions" />
									<span class="subheader">For History Excursions</span>
									Interested in more than the typical field trip for your group? 
									There is a fee for these specialized programs that range from 90 minutes to three 
									hours and incorporate hands-on elements. </a>							
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-tour.jpg" alt="Museum Tours" />
									<span class="subheader">For Museum Tours</span>
									These free, self-guided tours of the entire museum last approximately 90 minutes.</a>
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
									<span class="subheader">Statehood</span>
									Lesson plans from the Michigan Historical Center to explore Michigan's development
									as a state.</a>
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-travel.jpg" alt="Immigration" />
									<span class="subheader">Immigration</span>
									Lesson plans from the Michigan Historical Center to explore immigration within 
									Michigan.</a>							
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-cw.jpg" alt="Civil War" />
									<span class="subheader">Civil War</span>
									Lesson plans from the Michigan Historical Center to explore Michigan's involvment
									in the Civil War.</a>
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
							<?php
							$args = array( 'numberposts' => 3, 'category' => 592 ); // event category
							$eventposts = get_posts( $args );
							foreach ($eventposts as $post) : setup_postdata($post); ?>
								<li>
									<a href="<?php the_permalink(); ?>">
									<img src="/images/teach-home-icon-calendar.jpg" alt="Event" />
									<span class="subheader"><?php the_title(); ?></span>
									<?php the_excerpt(); ?></a>
								</li>
							<?php endforeach; ?>
								<!-- <li>
									<a href="">
									<img src="/images/teach-home-icon-calendar.jpg" alt="Event" />
									<span class="subheader">Event Title</span>
									Research official records of the Union and Confederate armies</a>							
								</li>
								<li>
									<a href="">
									<img src="/images/teach-home-icon-calendar.jpg" alt="Event" />
									<span class="subheader">Event Title</span>
									Find graves of Civil War soldiers</a>
								</li> -->
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
							<a href="">Tours around the State</a>
							</div>
						</div>
					</div>
					<div id="box3wrap">
						<div id="box3">
							<div id="box3txt">
							<a href="">Plan a Visit</a>
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
							<a href="">Teaching Resources</a>
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
