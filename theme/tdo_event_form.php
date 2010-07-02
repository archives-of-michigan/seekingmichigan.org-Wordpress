<!-- Form 2 start -->
<style>
#eventDetails h4,
  #EventBriteDetailDiv h4 {
  text-transform: uppercase;
  border-bottom: 1px solid #e5e5e5;
  padding-bottom: 6px;
}

.eventForm td {
  padding-bottom: 10px !important;
  padding-top: 0 !important;
}

.eventForm .snp_sectionheader {
  padding-bottom: 5px !important;
}

#snp_thanks {
  float: left;
  width: 200px;
  margin: 5px 0 0 0;
}

.snp_brand {
  font-weight: normal;
  margin: 8px 0;
  font-family: Georgia !important;
  font-size: 17px !important;
}

.eventForm p {
  margin: 0 0 10px 0!important;
}

#eventDetails small,
  #EventBriteDetailDiv small {
  color: #a3a3a3;
  font-size: 10px;
}

#eventBriteTicketing,
  #mainDonateRow {
  background: url(http://seekingmichigan.org/wp-content/plugins/the-events-calendar/resources/images/bg_fade.png) repeat-x top left;
  background-color: #fff;
  padding: 10px 15px;
  border: 1px solid #e2e2e2;
  -moz-border-radius: 3px;
  -khtml-border-radius: 3px;
  -webkit-border-radius: 3px;
  -moz-border-radius-topleft: 0;
  -moz-border-radius-topright: 0;
  -webkit-border-top-left-radius: 0;
  -webkit-border-top-right-radius: 0;
  border-radius: 3px;
  margin: -11px 6px 0;
}

#eventBriteTicketing h2 {
  background: url(http://seekingmichigan.org/wp-content/plugins/the-events-calendar/resources/images/logo_eventbrite.png) no-repeat top right;
  height: 57px;
  margin: 0;
}

.eventForm {
  margin-top: -20px;
}

.eventForm .description_input {
  border: 1px solid #dfdfdf;
  width: 95%;
  height: 45px;
}

#EventInfo,
  table.eventForm {
  width: 100%;
}

td.snp_message {
  padding-bottom: 10px !important;
}
</style>
<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function(){
    // toggle time input
    jQuery('#allDayCheckbox').click(function(){
      jQuery(".timeofdayoptions").toggle();
      jQuery("#EventTimeFormatDiv").toggle();
    });
    if( jQuery('#allDayCheckbox').attr('checked') == true ) {
      jQuery(".timeofdayoptions").addClass("hide")
      jQuery("#EventTimeFormatDiv").addClass("hide");
    }
    // Set the initial state of the event detail and EB ticketing div
    jQuery("input[name='isEvent']").each(function(){
      if( jQuery(this).val() == 'no' && jQuery(this).attr('checked') == true ) {
        jQuery('#eventDetails, #eventBriteTicketing').hide();
      } else if( jQuery(this).val() == 'yes' && jQuery(this).attr('checked') == true ) {
        jQuery('#eventDetails, #eventBriteTicketing').show();
      }
    });
    
    //show state/province input based on first option in countries list, or based on user input of country
    function spShowHideCorrectStateProvinceInput(country) {
      if (country == 'US') {
        jQuery("#USA").removeClass("hide");
        jQuery("#International").addClass("hide");
      }
      else {
        jQuery("#International").removeClass("hide");
        jQuery("#USA").addClass("hide");				
      }
    }
    
    spShowHideCorrectStateProvinceInput(jQuery("#EventCountry > option:first").attr('label'));
    
    jQuery("#EventCountry").change(function() {
      var t = jQuery(this);
      var value = t.val();
      if( t.find('option[label="US"]').val() == value ) spShowHideCorrectStateProvinceInput('US');
      else spShowHideCorrectStateProvinceInput(null);
    });
    
    var spDaysPerMonth = [29,31,28,31,30,31,30,31,31,30,31,30,31];
    
    // start and end date select sections
    var spStartDays = [ jQuery('#28StartDays'), jQuery('#29StartDays'), jQuery('#30StartDays'), jQuery('#31StartDays') ];
    var spEndDays = [ jQuery('#28EndDays'), jQuery('#29EndDays'), jQuery('#30EndDays'), jQuery('#31EndDays') ];
        
    jQuery("select[name='EventStartMonth'], select[name='EventEndMonth']").change(function() {
      var startEnd = jQuery(this).attr("name");
      // get changed select field
      if( startEnd == 'EventStartMonth' ) startEnd = 'Start';
      else startEnd = 'End';
      // show/hide date lists according to month
      var chosenMonth = jQuery(this).attr("value");
      if( chosenMonth.charAt(0) == '0' ) chosenMonth = chosenMonth.replace('0', '');
      else chosenMonth = chosenMonth;
      // leap year
      var remainder = jQuery("select[name='Event" + startEnd + "Year']").attr("value") % 4;
      if( chosenMonth == 2 && remainder == 0 ) chosenMonth = 0;
      // preserve selected option
      var currentDateField = jQuery("select[name='Event" + startEnd + "Day']");

      jQuery('.event' + startEnd + 'DateField').remove();
      if( startEnd == "Start") {
        var selectObject = spStartDays[ spDaysPerMonth[ chosenMonth ] - 28 ];
        selectObject.val( currentDateField.val() );
        jQuery("select[name='EventStartMonth']").after( selectObject );
      } else {
        var selectObject = spEndDays[ spDaysPerMonth[ chosenMonth ] - 28 ];
        selectObject.val( currentDateField.val() );
        jQuery('select[name="EventEndMonth"]').after( selectObject );
      }
    });
    
    jQuery("select[name='EventStartMonth'], select[name='EventEndMonth']").change();
    
    jQuery("select[name='EventStartYear']").change(function() {
      jQuery("select[name='EventStartMonth']").change();
    });
    
    jQuery("select[name='EventEndYear']").change(function() {
      jQuery("select[name='EventEndMonth']").change();
    });
        
  });
</script>

%%FORMMESSAGE%%
<!-- form start -->
<form method="post" action="http://seekingmichigan.org/wp-content/plugins/tdo-mini-forms/tdomf-form-post.php" id='tdomf_form%%FORMID%%' name='tdomf_form%%FORMID%%' class='tdomf_form' >
	%%FORMKEY%%
	<div><input type='hidden' id='tdomf_form_id' name='tdomf_form_id' value='%%FORMID%%' /></div>
	<div><input type='hidden' id='redirect' name='redirect' value='%%FORMURL%%' /></div>
	<!-- widgets start -->
	<!-- who-am-i start -->
	<fieldset>
		<legend>Who Am I</legend>
		<?php if(is_user_logged_in()) { ?>
			<p>You are currently logged in as %%USERNAME%%.
			<?php if(current_user_can('manage_options')) { ?>
				<a href='http://seekingmichigan.org/wp-admin/admin.php?page=tdo-mini-forms'>You can configure this form &raquo;</a>
			<?php } ?></p>
		<?php } else { ?>
			<p>We do not know who you are. Please supply your name and email address. Alternatively you can <a href="http://seekingmichigan.org/wp-login.php?redirect_to=%%FORMURL%%">log in</a> if you have a user account or <a href="http://seekingmichigan.org/wp-register.php?redirect_to=%%FORMURL%%">register</a> for a user account if you do not have one.</p>
			<?php if(!isset($whoami_name) && isset($_COOKIE['tdomf_whoami_widget_name'])) {
				$whoami_name = $_COOKIE['tdomf_whoami_widget_name'];
			} ?>
			<label for='whoami_name' class="required" >Name:
				<br/>
				<input type="text" value="<?php echo htmlentities($whoami_name,ENT_QUOTES,get_bloginfo('charset')); ?>" name="whoami_name" id="whoami_name" /> (Required)
			</label>
			<br/>
			<br/>
			<?php if(!isset($whoami_email) && isset($_COOKIE['tdomf_whoami_widget_name'])) {
				$whoami_email = $_COOKIE['tdomf_whoami_widget_email'];
			} ?>
			<label for='whoami_email' class="required" >Email:
				<br/>
				<input type="text" value="<?php echo htmlentities($whoami_email,ENT_QUOTES,get_bloginfo('charset')); ?>" name="whoami_email" id="whoami_email" /> (Required)
			</label>
			<br/>
			<br/>
			<?php if(!isset($whoami_webpage) && isset($_COOKIE['tdomf_whoami_widget_name'])) {
				$whoami_webpage = $_COOKIE['tdomf_whoami_widget_webpage'];
			}
			if(!isset($whoami_webpage) || empty($whoami_webpage)){ $whoami_webpage = "http://"; } ?>
			<label for='whoami_webpage'>Webpage:
				<br/>
				<input type="text" value="<?php echo htmlentities($whoami_webpage,ENT_QUOTES,get_bloginfo('charset')); ?>" name="whoami_webpage" id="whoami_webpage" />
			</label>
			<br/>
			<br/>
		<?php } ?>
	</fieldset>
	<!-- who-am-i end -->
	<!-- content start -->
	<fieldset>
		<legend>Content</legend>
		<?php if(isset($post_args["content-title-tf"])) {
			$temp_text = $post_args["content-title-tf"];
		} else { 
			$temp_text = "";
		} ?>
		<label for="content-title-tf">Event Title:
			<br/>
		</label>
		<input type="text" title="Post Title" name="content-title-tf" id="content-title-tf" size="30" value="<?php echo htmlentities($temp_text,ENT_QUOTES,get_bloginfo('charset')); ?>"/>
		<br/><br/>

		<label for="content-text-ta" class="required">Post Text (Required):</label>
		<br/>
    <textarea title="Post Text" rows="10" cols="40" name="content-text-ta" id="content-text-ta">
      <? if(isset($post_args["content-text-ta"])) ?><?= $post_args["content-text-ta"]; ?><?php endif ?>
		</textarea>
	</fieldset>
	<!-- content end -->
	<?php if(tdomf_get_option_form(TDOMF_OPTION_MODERATION,$tdomf_form_id) && !current_user_can('publish_posts') && !tdomf_current_user_default_author() && !tdomf_current_user_trusted()) { ?>
		<fieldset>
			<label for='notifyme'><input type='checkbox' name='notifyme' id='notifyme'<?php if(isset($notifyme)) { ?> checked <?php } ?> /> Do you wish to be notified when your event is approved (or rejected)?</label>
		<?php if(tdomf_widget_notifyme_show_email_input(%%FORMID%%)) { ?>
			<?php if(isset($_COOKIE['tdomf_notify_widget_email'])) { $notifyme_email = $_COOKIE['tdomf_notify_widget_email']; } ?>
				<br/>
				<label for='notifyme_email'>Email for notification: <input type="text" value="<?php echo htmlentities($notifyme_email,ENT_QUOTES); ?>" name="notifyme_email" id="notifyme_email" size="40" /></label>
		<?php } ?>
	</fieldset>
	<?php } ?>
	</fieldset>



<input type="hidden" name="isEvent" value='yes' />

<div id='eventDetails' class="inside eventForm">
  <table cellspacing="0" cellpadding="0" id="EventInfo">
  <tr>
    <td colspan="2" class="snp_sectionheader"><h4 class="event-time">Event Time &amp; Date</h4></td>
  </tr>
		<tr>
			<td>All day event?</td>
			<td><input  type='checkbox' id='allDayCheckbox' name='EventAllDay' value='yes'  /></td>
		</tr>
		<tr>
			<td style="width:125px;">Start Date / Time:</td>
			<td>
				<select  name='EventStartMonth'>
					<option value='01' >January</option>
<option value='02' >February</option>
<option value='03' >March</option>
<option value='04' >April</option>
<option value='05' >May</option>
<option value='06' >June</option>
<option value='07' >July</option>
<option value='08' >August</option>
<option value='09' >September</option>
<option value='10' >October</option>
<option value='11' >November</option>
<option value='12' >December</option>
				</select>
									<select id="31StartDays" class="eventStartDateField"  name='EventStartDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
<option value='29' >29</option>
<option value='30' >30</option>
<option value='31' >31</option>
					</select>
									<select id="30StartDays" class="eventStartDateField"  name='EventStartDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
<option value='29' >29</option>
<option value='30' >30</option>
					</select>
									<select id="29StartDays" class="eventStartDateField"  name='EventStartDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
<option value='29' >29</option>
					</select>
									<select id="28StartDays" class="eventStartDateField"  name='EventStartDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
					</select>
								<select  name='EventStartYear'>
<option value='2010' >2010</option>
<option value='2011' >2011</option>
<option value='2012' >2012</option>
<option value='2013' >2013</option>
<option value='2014' >2014</option>
<option value='2015' >2015</option>
				</select>
				<span class='timeofdayoptions'>
					@					<select  name='EventStartHour'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
					</select>
					<select  name='EventStartMinute'>
						<option value='00' selected="selected">00</option>
<option value='05' >05</option>
<option value='10' >10</option>
<option value='15' >15</option>
<option value='20' >20</option>
<option value='25' >25</option>
<option value='30' >30</option>
<option value='35' >35</option>
<option value='40' >40</option>
<option value='45' >45</option>
<option value='50' >50</option>
<option value='55' >55</option>
					</select>
											<select  name='EventStartMeridian'>
							<option value='am'>am</option>
<option value='pm' selected="selected">pm</option>
						</select>
									</span>
			</td>
		</tr>
		<tr>
			<td>End Date / Time:</td>
			<td>
				<select  name='EventEndMonth'>
					<option value='01' >January</option>
<option value='02' >February</option>
<option value='03' >March</option>
<option value='04' >April</option>
<option value='05' >May</option>
<option value='06' >June</option>
<option value='07' >July</option>
<option value='08' >August</option>
<option value='09' >September</option>
<option value='10' >October</option>
<option value='11' >November</option>
<option value='12' >December</option>
				</select>
									<select id="31EndDays" class="eventEndDateField"  name='EventEndDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
<option value='29' >29</option>
<option value='30' >30</option>
<option value='31' >31</option>
					</select>
									<select id="30EndDays" class="eventEndDateField"  name='EventEndDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
<option value='29' >29</option>
<option value='30' >30</option>
					</select>
									<select id="29EndDays" class="eventEndDateField"  name='EventEndDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
<option value='29' >29</option>
					</select>
									<select id="28EndDays" class="eventEndDateField"  name='EventEndDay'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
<option value='13' >13</option>
<option value='14' >14</option>
<option value='15' >15</option>
<option value='16' >16</option>
<option value='17' >17</option>
<option value='18' >18</option>
<option value='19' >19</option>
<option value='20' >20</option>
<option value='21' >21</option>
<option value='22' >22</option>
<option value='23' >23</option>
<option value='24' >24</option>
<option value='25' >25</option>
<option value='26' >26</option>
<option value='27' >27</option>
<option value='28' >28</option>
					</select>
								<select  name='EventEndYear'>
<option value='2010' >2010</option>
<option value='2011' >2011</option>
<option value='2012' >2012</option>
<option value='2013' >2013</option>
<option value='2014' >2014</option>
<option value='2015' >2015</option>
				</select>
				<span class='timeofdayoptions'>
					@					<select class="spEventsInput" name='EventEndHour'>
						<option value='01' >01</option>
<option value='02' >02</option>
<option value='03' >03</option>
<option value='04' >04</option>
<option value='05' >05</option>
<option value='06' >06</option>
<option value='07' >07</option>
<option value='08' >08</option>
<option value='09' >09</option>
<option value='10' >10</option>
<option value='11' >11</option>
<option value='12' >12</option>
					</select>
					<select  name='EventEndMinute'>
						<option value='00' selected="selected">00</option>
<option value='05' >05</option>
<option value='10' >10</option>
<option value='15' >15</option>
<option value='20' >20</option>
<option value='25' >25</option>
<option value='30' >30</option>
<option value='35' >35</option>
<option value='40' >40</option>
<option value='45' >45</option>
<option value='50' >50</option>
<option value='55' >55</option>
					</select>
											<select  name='EventEndMeridian'>
							<option value='am'>am</option>
<option value='pm'>pm</option>
						</select>
									</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="snp_sectionheader"><h4>Event Location Details</h4></td>
		</tr>
		<tr>
			<td>Venue:</td>
			<td>
				<input  type='text' name='EventVenue' size='25'  value='' />
			</td>
		</tr>
    <input type="hidden" name="EventCountry" value="United States">
		<tr>
			<td>Address:</td>
			<td><input  type='text' name='EventAddress' size='25' value='' /></td>
		</tr>
		<tr>
			<td>City:</td>
			<td><input  type='text' name='EventCity' size='25' value='' /></td>
		</tr>
		<tr id="USA" class="hide">
			<td>State:</td>
			<td>
				<select  name="EventState">
				    <option value="">Select a State:</option> 
					<option value="AL" >Alabama</option>
<option value="AK" >Alaska</option>
<option value="AZ" >Arizona</option>
<option value="AR" >Arkansas</option>
<option value="CA" >California</option>
<option value="CO" >Colorado</option>
<option value="CT" >Connecticut</option>
<option value="DE" >Delaware</option>
<option value="DC" >District of Columbia</option>
<option value="FL" >Florida</option>
<option value="GA" >Georgia</option>
<option value="HI" >Hawaii</option>
<option value="ID" >Idaho</option>
<option value="IL" >Illinois</option>
<option value="IN" >Indiana</option>
<option value="IA" >Iowa</option>
<option value="KS" >Kansas</option>
<option value="KY" >Kentucky</option>
<option value="LA" >Louisiana</option>
<option value="ME" >Maine</option>
<option value="MD" >Maryland</option>
<option value="MA" >Massachusetts</option>
<option value="MI" >Michigan</option>
<option value="MN" >Minnesota</option>
<option value="MS" >Mississippi</option>
<option value="MO" >Missouri</option>
<option value="MT" >Montana</option>
<option value="NE" >Nebraska</option>
<option value="NV" >Nevada</option>
<option value="NH" >New Hampshire</option>
<option value="NJ" >New Jersey</option>
<option value="NM" >New Mexico</option>
<option value="NY" >New York</option>
<option value="NC" >North Carolina</option>
<option value="ND" >North Dakota</option>
<option value="OH" >Ohio</option>
<option value="OK" >Oklahoma</option>
<option value="OR" >Oregon</option>
<option value="PA" >Pennsylvania</option>
<option value="RI" >Rhode Island</option>
<option value="SC" >South Carolina</option>
<option value="SD" >South Dakota</option>
<option value="TN" >Tennessee</option>
<option value="TX" >Texas</option>
<option value="UT" >Utah</option>
<option value="VT" >Vermont</option>
<option value="VA" >Virginia</option>
<option value="WA" >Washington</option>
<option value="WV" >West Virginia</option>
<option value="WI" >Wisconsin</option>
<option value="WY" >Wyoming</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Postal Code:</td>
			<td><input  type='text' name='EventZip' size='6' value='' /></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><input  type='text' name='EventPhone' size='14' value='' /></td>
		</tr>
    <tr>
			<td colspan="2" class="snp_sectionheader"><h4>Event Cost</h4></td>
		</tr>
		<tr>
			<td>Cost:</td>
			<td><input  type='text' name='EventCost' size='6' value='' /></td>
		</tr>
		<tr>
			<td></td>
			<td><small>Leave blank to hide the field. Enter a 0 for events that are free.</small></td>
		</tr>
	</table>
  <table class='tdomf_buttons'><tr>
    <td><input type="submit" value="Send" name="tdomf_form%%FORMID%%_send" id="tdomf_form%%FORMID%%_send"/></td>
  </tr></table>
  </form>
</div>
</div><!--//eventDetails-->
