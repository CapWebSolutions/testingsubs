<?php
/*
Plugin Name: Cap Web Solutions Checkout Fields
Plugin URI: http://example.com/
Description: Add fields to WPcare subscription checkout
Author: Cap Web Solutions
Version: 0.1
Author URI: https://capwebsolutions.com/
*/



/**
 * Modify the order notes label & add custom fields
 */
// add_filter( 'woocommerce_checkout_fields' , 'capweb_override_checkout_fields', 20 );
function capweb_override_checkout_fields( $fields ) {

	$fields['order']['target_website'] = array(
		'type' => 'text',
		'label' => __( 'Website Address', 'woocommerce' ),
		'required' => true,
		'placeholder' => 'https://example.com',
		'priority' => '160',
	);


 var_dump($fields);
	return $fields;

}


/**
 * Update the order meta with field value
 */
// add_action( 'woocommerce_checkout_update_order_meta', 'capweb_checkout_field_update_order_meta' );

function capweb_checkout_field_update_order_meta( $order_id ) {
	foreach( 
		array( 'target_website' ) as $_key ) {
		$key = 'order_' . $_key;

		if ( empty( $_POST[$key] ) )
			delete_post_meta( $order_id, $_key );
		else
			update_post_meta( $order_id, $_key , sanitize_text_field( $_POST[$key] ) );

	}
}

// function capweb_woo_custom_change_cart_string($translated_text, $text, $domain) {

// 	$translated_text = str_replace("cart", "registration options", $translated_text);
// 	$translated_text = str_replace("Cart", "Registration Options", $translated_text);
// 	$translated_text = str_replace("View Cart", "View Registration Options", $translated_text);

// return $translated_text;
// }

// add_filter('gettext', 'capweb_woo_custom_change_cart_string', 100, 3);
// add_filter('ngettext', 'capweb_woo_custom_change_cart_string', 100, 3);


// add_filter( 'woocommerce_product_add_to_cart_text', 'capweb_woo_custom_single_add_to_cart_text' );                // < 2.1
// add_filter( 'woocommerce_product_single_add_to_cart_text', 'capweb_woo_custom_single_add_to_cart_text' );  // 2.1 +

// function capweb_woo_custom_single_add_to_cart_text() {

// 	return __( 'Add to Registration Options', 'woocommerce' );

// }

// function capweb_woo_custom_change_checkout_string($translated_text, $text, $domain) {

// 	$translated_text = str_replace("checkout", "registration form", $translated_text);
// 	$translated_text = str_replace("Checkout", "Registration Form", $translated_text);
// 	$translated_text = str_replace("View Checkout", "View Registration Form", $translated_text);

// return $translated_text;
// }

// add_filter('gettext', 'capweb_woo_custom_change_checkout_string', 100, 3);
// add_filter('ngettext', 'capweb_woo_custom_change_checkout_string', 100, 3);

