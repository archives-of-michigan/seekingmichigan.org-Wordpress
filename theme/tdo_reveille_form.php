<?php
if(isset($post_args["content-title-tf"])) {
  $title = htmlentities($post_args["content-title-tf"],ENT_QUOTES,get_bloginfo('charset'));
} else { 
  $title = "";
}
$text = isset($post_args["content-text-ta"]) ? $post_args["content-text-ta"] : '';
$excerpt = isset($post_args["excerpt-ta"]) ? $post_args["excerpt-ta"] : '';
?>
<?= apply_filters('mce_css', ''); ?>
<style type="text/css">
legend { display: none; }
label { margin-bottom: 5px; }
input {
  font-size: 13px;
  padding: 3px 9px;
}
</style>
<!-- TinyMCE -->
<script type="text/javascript" src="/wp-content/themes/airbag/javascripts/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
  mode : "textareas",
  theme : "advanced"
});
</script>

<!-- /TinyMCE -->

%%FORMMESSAGE%%
<form method="post" action="http://seekingmichigan.org/wp-content/plugins/tdo-mini-forms/tdomf-form-post.php" id='tdomf_form%%FORMID%%' name='tdomf_form%%FORMID%%' class='tdomf_form' >
	%%FORMKEY%%
	<div><input type='hidden' id='tdomf_form_id' name='tdomf_form_id' value='%%FORMID%%' /></div>
	<div><input type='hidden' id='redirect' name='redirect' value='%%FORMURL%%' /></div>
	<fieldset>
		<legend>Content</legend>
    <p>
      <label for="content-title-tf">Post Title:</label>
      <input type="text" title="Post Title" name="content-title-tf" id="content-title-tf" size="40" value="<?= $title; ?>"/>
    </p>
    <p>
      <label for="content-text-ta" class="required">Post Text (Required):</label>
      <textarea rows="10" cols="60" name="content-text-ta" id="content-text-ta" class="mce-editor">
        <?= $text; ?>
      </textarea>
    </p>
	</fieldset>
	<fieldset>
		<legend>Excerpt</legend>
		<label for="excerpt-ta" class="required">Excerpt Text (Required):</label>
		<textarea title="Excerpt Text" rows="10" cols="60" name="excerpt-ta" class="mce-editor">
      <?= $excerpt; ?>
    </textarea>
	</fieldset>
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
	<table class='tdomf_buttons'><tr>
		<td><input type="submit" value="Preview" name="tdomf_form%%FORMID%%_preview" id="tdomf_form%%FORMID%%_preview"/></td>
		<td><input type="submit" value="Send" name="tdomf_form%%FORMID%%_send" id="tdomf_form%%FORMID%%_send"/></td>
	</tr></table>
</form>
