rc:custom_field_gui

== INTRODUCTION ==

This plugin enables the automation of creation of form element user
interface for entering Post' custom field. User will specify the form
input type, the subject, and available options (when applicable). The
corresponding form elements will automatically show up in the Write Post
page.

== INSTALLATION ==

Unpack the file "rc-custom-field-gui.zip" and upload the folder 
"rc-custom-field-gui" to "wp-content/plugins/." Activate from WP's 
Plugin Management page.


== CONFIGURATION ==

This plugin supports the following types of form element: textfield, 
checkbox, radio, and select. To specify the custom fields, edit the file 
"conf.ini"

Each entry begins with the subject inside square brackets. The second 
line specifies its type. The third line, which only applies to type
"radio" and "select," enumerates the available options. Each option
has to be separated by a hash mark (#).

Ex.

[Plan]
type = textfield

[Favorite Post]
type = checkbox

[Miles Walked]
type = radio
value = 0-9 # 10-19 # 20+

[Temper Level]
type = select
value = High # Medium # Low

[Hidden Thought]
type = textarea
rows = 4
cols = 40


