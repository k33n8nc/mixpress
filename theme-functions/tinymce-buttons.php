<?php
// hooks functions into the correct filters
function wdm_add_mce_button() {
  // check user permissions
  if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
       return;
     }
  // check if WYSIWYG is enabled
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
     add_filter( 'mce_external_plugins', 'wdm_add_tinymce_plugin' );
     add_filter( 'mce_buttons', 'wdm_register_mce_button' );
     }
}
add_action('admin_head', 'wdm_add_mce_button');

// register new button in the editor
function wdm_register_mce_button( $buttons ) {
  array_push( $buttons, 'opdracht_button' );
  return $buttons;
}

// Insert the shortcode on the click event
function wdm_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['opdracht_button'] = get_stylesheet_directory_uri() .'/resources/js/button-shortcode.js';
  return $plugin_array;
}

// Opdrachten shortcode met tailwind styles
function opdracht_function( $atts, $content = null ) {
    return
    '
    <div class="bg-gray-200 rounded p-6 relative mt-12">
      <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
      <div class="flex items-center justify-center mb-2 w-10 h-10 rounded-full bg-white border border-gray-200">
        <i class="text-primary fas fa-book-reader"></i>
      </div>
      </div>
      '. $content .'
    </div>
    ';
}

add_shortcode('opdracht', 'opdracht_function');
