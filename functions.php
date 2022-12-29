<?php
/* 	To edit the functions, see theme-functions folder in mixpress root directory
		Wordpress docs: https://developer.wordpress.org/themes/basics/theme-functions */

// Register theme scripts and stylesheets
require_once(get_template_directory().'/theme-functions/enqueue-scripts.php');

// Load theme support functions
require_once(get_template_directory().'/theme-functions/theme-support.php');

// Load theme menu functions
// Include tailwind walker class
require_once(get_template_directory().'/theme-functions/theme-menus.php');

// Register the tinyMCE buttons function
// Oude shortcode voor opdrachten (wordt niet meer gebruikt)
// require_once(get_template_directory().'/theme-functions/tinymce-buttons.php');

// WooCommerce functions
require_once(get_template_directory().'/theme-functions/woocommerce.php');

// Gravity Forms functions
require_once(get_template_directory().'/theme-functions/gravityforms.php');

// ****************************
// Edit excerpt output
// ****************************
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// ****************************
// Change login logo to Pyramide logo
// ****************************
function eigen_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login-logo.jpg);
          height:65px;
          width:320px;
          background-size: 320px 65px;
          background-repeat: no-repeat;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'eigen_login_logo' );

function wpb_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'wpb_login_logo_url' );

function wpb_login_logo_url_title() {
    return 'Stichting de Pyramide';
}
add_filter( 'login_headertitle', 'wpb_login_logo_url_title' );


// ****************************
// change user profile menu in focus mode header to naar Dashboard
// ****************************
add_action(
    'learndash-focus-header-user-menu-before',
    function( $course_id, $user_id ) {
        // May add any custom logic using $course_id, $user_id
        echo '<a href="'. get_permalink( woocommerce_get_page_id('myaccount')). '" class="text-primary text-xl"><i class="fas fa-user-circle"></i></a>';
        
    },
    10,
    2
);


add_action( 'pre_get_posts', 'my_change_sort_order'); 
    function my_change_sort_order($query){
        if(is_post_type_archive( 'sfwd-courses' )):
         //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
           //Set the order ASC or DESC
           $query->set( 'order', 'DESC' );
           //Set the orderby
           $query->set( 'orderby', 'date' );
        endif;    
    };



