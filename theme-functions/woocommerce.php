<?php
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Remove default styling WooCommerce
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Remove .woocommerce class from body to prevent flexbox styling issues
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// add_filter('body_class', 'remove_body_classes');
// function remove_body_classes( $classes ) {
//     $remove_classes = ['woocommerce'];
//     $classes = array_diff($classes, $remove_classes);
//     return $classes;
// }

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Redirect register (on login page) to Shop page (abonnementen)
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
add_action( 'login_form_register', 'rs_catch_register' );
// Redirects visitors from `wp-login.php?action=register`
function rs_catch_register() {
    wp_redirect( home_url( '/abonnementen' ) );
    exit(); // always call `exit()` after `wp_redirect`
}

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Empty Cart on add to cart so that only 1 product is possible
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
add_filter( 'woocommerce_add_cart_item_data', '_empty_cart' );    
function _empty_cart( $cart_item_data ) {        
    WC()->cart->empty_cart();        
    return $cart_item_data;    
}

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Simplify cehckout fields if product is virtual
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
add_filter( 'woocommerce_checkout_fields' , 'rs_simplify_checkout_virtual' );

function rs_simplify_checkout_virtual( $fields ) {

   $only_virtual = true;

   foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      // Check if there are non-virtual products
      if ( ! $cart_item['data']->is_virtual() ) $only_virtual = false;
   }

    if( $only_virtual ) {
       unset($fields['billing']['billing_company']);
			 // unset($fields['billing']['billing_last_name']);
       unset($fields['billing']['billing_address_1']);
       unset($fields['billing']['billing_address_2']);
       unset($fields['billing']['billing_city']);
       unset($fields['billing']['billing_postcode']);
       unset($fields['billing']['billing_country']);
       unset($fields['billing']['billing_state']);
       unset($fields['billing']['billing_phone']);
       add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
     }

     return $fields;
}

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Remove my-account links in Dashboard
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
add_filter ( 'woocommerce_account_menu_items', 'rs_remove_links' );
function rs_remove_links( $menu_links ){
  // $menu_links['dashboard'] = 'Modules'; // Change Dashboard to Modules
	unset( $menu_links['downloads'] ); // Disable Downloads
  unset( $menu_links['edit-address']); // Disable adress
  unset( $menu_links['orders']); // Disable adress
	unset( $menu_links['customer-logout'] ); // Remove Logout link
	return $menu_links;
}

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Merge tabs adresses and account details (WooCommerce Dashboard)
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// add_filter( 'woocommerce_account_menu_items', 'rs_remove_address_my_account', 999 );
// function rs_remove_address_my_account( $items ) {
//  unset($items['edit-address']);
//  return $items;
// }
// add_action( 'woocommerce_account_orders_endpoint', 'woocommerce_account_edit_address' );

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Simplify cehckout fields if product is virtual
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// add_filter( 'woocommerce_checkout_fields' , 'rs_simplify_checkout_virtual' );

// function rs_simplify_checkout_virtual( $fields ) {

//    $only_virtual = true;

//    foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
//       // Check if there are non-virtual products
//       if ( ! $cart_item['data']->is_virtual() ) $only_virtual = false;
//    }

//     if( $only_virtual ) {
//        unset($fields['billing']['billing_company']);
// 			 // unset($fields['billing']['billing_last_name']);
//        unset($fields['billing']['billing_address_1']);
//        unset($fields['billing']['billing_address_2']);
//        unset($fields['billing']['billing_city']);
//        unset($fields['billing']['billing_postcode']);
//        unset($fields['billing']['billing_country']);
//        unset($fields['billing']['billing_state']);
//        unset($fields['billing']['billing_phone']);
//        add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
//      }

//      return $fields;
// }

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Set placeholdertext for those checkoutfields remaining
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// add_filter( 'woocommerce_checkout_fields' , 'override_billing_checkout_fields', 20, 1 );
// function override_billing_checkout_fields( $fields ) {
//     $fields['billing']['billing_first_name']['placeholder'] = __('Voornaam', 'mixpress');
// 		$fields['billing']['billing_last_name']['placeholder'] = __('Achternaam', 'mixpress');
//     $fields['billing']['billing_email']['placeholder'] = __('Jouw e-mailadres', 'mixpress');
// 		$fields['account']['account_password']['placeholder'] = __('Kies een wachtwoord', 'mixpress');
//     return $fields;
// }


// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// ADD MY-ACCOUNT FIELDS: #DATE OF BIRTH, #SALUATION
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
function action_woocommerce_edit_account_form() {
  // Add date of birth field (my-account)
    woocommerce_form_field( 'birthday_field', array(
        'birthdayfield',
        'type'        => 'date',
        'label'       => __( 'Geboortedatum', 'mixpress' ),
        // 'placeholder' => __( 'dd-mm-jjjj', 'mixpress' ),
        'required'    => true,
    ), get_user_meta( get_current_user_id(), 'birthday_field', true ));
    // Add saluation field (my-account)
    woocommerce_form_field( 'saluation_field', array(
        'saluationfield',
        'type'        => 'select',
        'options'			=> array(
                            'Aanhef' 	=> __( 'Selecteer', 'mixpress' ),
                            'Dhr' 		=> __( 'Dhr.', 'mixpress' ),
                            'Mevr' 		=> __( 'Mevr.', 'mixpress' ),
                          ),
        'label'       => __( 'Aanhef', 'mixpress' ),
        // 'placeholder' => __( 'Aanhef', 'mixpress' ),
        'required'    => true,
    ), get_user_meta( get_current_user_id(), 'saluation_field', true ));
}
add_action( 'woocommerce_edit_account_form_start', 'action_woocommerce_edit_account_form' );


// Validate - date of birth (my account)
function action_woocommerce_save_account_details_errors( $args ){
    if ( isset($_POST['birthday_field']) && empty($_POST['birthday_field']) ) {
        $args->add( 'error', __( 'Vul a.u.b. een geboortedatum in', 'mixpress' ) );
    }
}
add_action( 'woocommerce_save_account_details_errors','action_woocommerce_save_account_details_errors', 10, 1 );


// Save - #date of birth, #saluation field (my account)
function action_woocommerce_save_account_details( $user_id ) {
    // Check and save date of birth field
    if( isset($_POST['birthday_field']) && ! empty($_POST['birthday_field']) ) {
        update_user_meta( $user_id, 'birthday_field', sanitize_text_field($_POST['birthday_field']) );
    }
    // Check and save saluation field
    if( isset($_POST['saluation_field']) && ! empty($_POST['saluation_field']) ) {
        update_user_meta( $user_id, 'saluation_field', sanitize_text_field($_POST['saluation_field']) );
    }
}

add_action( 'woocommerce_save_account_details', 'action_woocommerce_save_account_details', 10, 1 );

// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// ADD USER ADMIN FIELDS: #DATE OF BIRTH, #SALUATION
// •••••••••••••••••••••••••••••••••••••••••••••••••••••
// Add #date of birth, #saluation (admin)
function add_user_birtday_field( $user ) {
    ?>
        <h3><?php _e('Extra gebruikersinformatie','mixpress' ); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="birthday_field"><?php _e( 'Geboortedatum', 'mixpress' ); ?></label></th>
                <td><input type="date" name="birthday_field" value="<?php echo esc_attr( get_the_author_meta( 'birthday_field', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <!-- <tr>
                <th><label for="saluation_field"><?php //_e( 'Aanhef', 'mixpress' ); ?></label></th>
                <td><input type="select" name="saluation_field" value="<?php //echo esc_attr( get_the_author_meta( 'saluation_field', $user->ID )); ?>" class="regular-text" /></td>
            </tr> -->

            <tr>
                <th><label for="saluation_field"><?php _e( 'Aanhef', 'mixpress' ); ?></label></th>
                <td>
                    <select name="saluation_field" id="saluation_field" >
                        <option value="Dhr" <?php selected( 'Dhr', get_the_author_meta( 'saluation_field', $user->ID ) ); ?>>Dhr</option>
                        <option value="Mevr" <?php selected( 'Mevr', get_the_author_meta( 'saluation_field', $user->ID ) ); ?>>Mevr</option>
                    </select>
                </td>
            </tr>

        </table>
        <br />
    <?php
}
add_action( 'show_user_profile', 'add_user_birtday_field', 10, 1 );
add_action( 'edit_user_profile', 'add_user_birtday_field', 10, 1 );

// Save date of birth field (admin)
function save_user_birtday_field( $user_id ) {
    if( ! empty($_POST['birthday_field']) ) {
        update_user_meta( $user_id, 'birthday_field', sanitize_text_field( $_POST['birthday_field'] ) );
    }
    if( ! empty($_POST['saluation_field']) ) {
        update_user_meta( $user_id, 'saluation_field', sanitize_text_field( $_POST['saluation_field'] ) );
    }
}
add_action( 'personal_options_update', 'save_user_birtday_field', 10, 1 );
add_action( 'edit_user_profile_update', 'save_user_birtday_field', 10, 1 );

?>
