<?php
/*
Plugin Name: rc:custom_field_gui
Plugin URI: http://rhymedcode.net/projects/custom-field-gui
Description: Automatically adds form element(s) in Write Post panel, which act as a Post's custom field(s). Configuration is thru conf.ini. Instruction is on readme.txt.
Author: Joshua Sigar
Version: 1.5
Author URI: http://rhymedcode.net
*/ 

/*
rc:custom_field_gui
Licensed under the MIT License
Copyright (c)  2005 Joshua Sigar

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the
Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software,
and to permit persons to whom the Software is furnished to
do so, subject to the following conditions:

The above copyright notice and this permission notice shall
be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

include_once( 'rc-custom-field-gui.class.php' );

add_action( 'simple_edit_form', array( 'rc_custom_field_gui', 'insert_gui' ) );
add_action( 'edit_form_advanced', array( 'rc_custom_field_gui', 'insert_gui' ) );
add_action( 'edit_post', array( 'rc_custom_field_gui', 'edit_meta_value' ) );
add_action( 'save_post', array( 'rc_custom_field_gui', 'edit_meta_value' ) );
add_action( 'publish_post', array( 'rc_custom_field_gui', 'edit_meta_value' ) );

?>