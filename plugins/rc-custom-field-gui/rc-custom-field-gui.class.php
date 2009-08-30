<?php

class rc_custom_field_gui {

  function sanitize_name( $name ) {
    $name = sanitize_title( $name ); // taken from WP's wp-includes/functions-formatting.php
    $name = str_replace( '-', '_', $name );
    
    return $name;
  }
  
  function get_custom_fields() {
    $file = dirname( __FILE__ ) . '/conf.ini';
    if ( !file_exists( $file ) )
    	return null;
    	
    $custom_fields = parse_ini_file( $file, true );
    return $custom_fields;
  }
  
  function make_textfield( $name, $size = 25 ) {
    $title = $name;
    $name = 'rc_' . rc_custom_field_gui::sanitize_name( $name );
    
    if( isset( $_REQUEST[ 'post' ] ) ) {
      $value = get_post_meta( $_REQUEST[ 'post' ], $title );
      $value = $value[ 0 ];
    }
    
    $out = 
      '<tr>' .
      '<th scope="row">' . $title . ' </th>' .
      '<td> <input id="' . $name . '" name="' . $name . '" value="' . attribute_escape($value) . '" type="textfield" size="' . $size . '" /></td>' .
      '</tr>';
    return $out;
  }
  
  function make_checkbox( $name, $default ) {
    $title = $name;
    $name = 'rc_' . rc_custom_field_gui::sanitize_name( $name );
    
    if( isset( $_REQUEST[ 'post' ] ) ) {
      $checked = get_post_meta( $_REQUEST[ 'post' ], $title );
      $checked = $checked ? 'checked="checked"' : '';
    }
    else {
      if ( isset( $default ) && trim( $default ) == 'checked' ) {
        $checked = 'checked="checked"';
      }    
    }
    
    $out =
      '<tr>' .
      '<th scope="row" valign="top">' . $title. ' </th>' .
      '<td>';
      
    $out .=  
      '<input class="checkbox" name="' . $name . '" value="true" id="' . $name . '" "' . $checked . '" type="checkbox" />';
       
    $out .= '</td>';
    
    return $out;
  }
  
  function make_radio( $name, $values, $default ) {
    $title = $name;
    $name = 'rc_' . rc_custom_field_gui::sanitize_name( $name );
    
    if( isset( $_REQUEST[ 'post' ] ) ) {
      $selected = get_post_meta( $_REQUEST[ 'post' ], $title );
      $selected = $selected[ 0 ];
    }
    else {
      $selected = $default;
    }
  
    $out =
      '<tr>' .
      '<th scope="row" valign="top">' . $title . ' </th>' .
      '<td>';
    
    foreach( $values as $val ) {
      $id = $name . '_' . rc_custom_field_gui::sanitize_name( $val );
      
      $checked = ( trim( $val ) == trim( $selected ) ) ? 'checked="checked"' : '';
      
      $out .=  
        '<label for="' . $id . '" class="selectit"><input id="' . $id . '" name="' . $name . '" value="' . $val . '" "' . $checked . '" type="radio"> ' . $val . '</label><br>';
    }   
    $out .= '</td>';
    
    return $out;      
  }
  
  function make_select( $name, $values, $default ) {
    $title = $name;
    $name = 'rc_' . rc_custom_field_gui::sanitize_name( $name );
    
    if( isset( $_REQUEST[ 'post' ] ) ) {
      $selected = get_post_meta( $_REQUEST[ 'post' ], $title );
      $selected = $selected[ 0 ];
    }
    else {
      $selected = $default;
    }
    
    $out =
      '<tr>' .
      '<th scope="row">' . $title . ' </th>' .
      '<td>' .
      '<select name="' . $name . '">' .
      '<option value="" >Select</option>';
      
    foreach( $values as $val ) {
      $checked = ( trim( $val ) == trim( $selected ) ) ? 'selected="selected"' : '';
    
      $out .=
        '<option value="' . $val . '" ' . $checked . ' > ' . $val. '</option>'; 
    }
    $out .= '</select></td>';
    
    return $out;
  }
  
  function make_textarea( $name, $rows, $cols ) {
    $title = $name;
    $name = 'rc_' . rc_custom_field_gui::sanitize_name( $name );
    
    if( isset( $_REQUEST[ 'post' ] ) ) {
      $value = get_post_meta( $_REQUEST[ 'post' ], $title );
      $value = $value[ 0 ];
    }
    
    $out = 
      '<tr>' .
      '<th scope="row" valign="top">' . $title . ' </th>' .
      '<td> <textarea id="' . $name . '" name="' . $name . '" type="textfield" rows="' .$rows. '" cols="' .$cols. '">' .attribute_escape($value). '</textarea></td>' .
      '</tr>';
    return $out;
  }


  function insert_gui() {
    $fields = rc_custom_field_gui::get_custom_fields();
    
    if( $fields == null)
    	return;
    
    $out = '<input type="hidden" name="rc-custom-field-gui-verify-key" id="rc-custom-field-gui-verify-key"
			value="' . wp_create_nonce('rc-custom-field-gui') . '" />';
    $out .= '<table class="editform">';
    foreach( $fields as $title => $data ) {
      if( $data[ 'type' ] == 'textfield' ) {
        $out .= rc_custom_field_gui::make_textfield( $title, $data[ 'size' ] );
      }
      else if( $data[ 'type' ] == 'checkbox' ) {
        $out .= 
          rc_custom_field_gui::make_checkbox( $title, $data[ 'default' ] );
      }
      else if( $data[ 'type' ] == 'radio' ) {
        $out .= 
          rc_custom_field_gui::make_radio( 
            $title, explode( '#', $data[ 'value' ] ), $data[ 'default' ] );
      }
      else if( $data[ 'type' ] == 'select' ) {
        $out .= 
          rc_custom_field_gui::make_select( 
            $title, explode( '#', $data[ 'value' ] ), $data[ 'default' ] );
      }
      else if( $data[ 'type' ] == 'textarea' ) {
        $out .= 
          rc_custom_field_gui::make_textarea( $title, $data[ 'rows' ], $data[ 'cols' ] );
      }
    }
    
    $out .= '</table>';
    echo $out;
  }

  function edit_meta_value( $id ) {
    global $wpdb;
        
    if( !isset( $id ) )
      $id = $_REQUEST[ 'post_ID' ];
    
    
    if( !current_user_can('edit_post', $id) )
        return $id;
        
    if( !wp_verify_nonce($_REQUEST['rc-custom-field-gui-verify-key'], 'rc-custom-field-gui') )
        return $id;
    
    $fields = rc_custom_field_gui::get_custom_fields();
    
    if ( $fields == null )
    	return;
    
    foreach( $fields as $title  => $data) {
      $name = 'rc_' . rc_custom_field_gui::sanitize_name( $title );
      $title = $wpdb->escape(stripslashes(trim($title)));
      
      $meta_value = stripslashes(trim($_REQUEST[ "$name" ]));
      if( isset( $meta_value ) && !empty( $meta_value ) ) {
        delete_post_meta( $id, $title );
        
        if( $data[ 'type' ] == 'textfield' || 
            $data[ 'type' ] == 'radio'  ||
            $data[ 'type' ] == 'select' || 
            $data[ 'type' ] == 'textarea' ) {
          add_post_meta( $id, $title, $meta_value );
        }
        else if( $data[ 'type' ] == 'checkbox' )
          add_post_meta( $id, $title, 'true' );
      }
      else {
        delete_post_meta( $id, $title );
      }
    }
  }
  
}

?>