<?php
/*
Plugin Name: Cap Web Solutions Display Woocommerce Order Fields
Plugin URI: http://example.com/
Description: Show fields from WC subscription and associated orders
Author: Cap Web Solutions
Version: 0.1
Author URI: https://capwebsolutions.com/
*/

/**
 * Print list of subscriptions
 */
function capweb_have_order( $order ){

	// Have access to $order
	// Get Order ID and Key
$order->get_id();
$order->get_order_key();
 
// Get Order Totals $0.00
$order->get_formatted_order_total();
$order->get_cart_tax();
$order->get_currency();
$order->get_discount_tax();
$order->get_discount_to_display();
$order->get_discount_total();
$order->get_fees();
$order->get_formatted_line_subtotal();
$order->get_shipping_tax();
$order->get_shipping_total();
$order->get_subtotal();
$order->get_subtotal_to_display();
$order->get_tax_location();
$order->get_tax_totals();
$order->get_taxes();
$order->get_total();
$order->get_total_discount();
$order->get_total_tax();
$order->get_total_refunded();
$order->get_total_tax_refunded();
$order->get_total_shipping_refunded();
$order->get_item_count_refunded();
$order->get_total_qty_refunded();
$order->get_qty_refunded_for_item();
$order->get_total_refunded_for_item();
$order->get_tax_refunded_for_item();
$order->get_total_tax_refunded_by_rate_id();
$order->get_remaining_refund_amount();
  
// Get and Loop Over Order Items
foreach ( $order->get_items() as $item_id => $item ) {
   $product_id = $item->get_product_id();
   $variation_id = $item->get_variation_id();
   $product = $item->get_product();
   $name = $item->get_name();
   $quantity = $item->get_quantity();
   $subtotal = $item->get_subtotal();
   $total = $item->get_total();
   $tax = $item->get_subtotal_tax();
   $taxclass = $item->get_tax_class();
   $taxstat = $item->get_tax_status();
   $allmeta = $item->get_meta_data();
   $somemeta = $item->get_meta( '_whatever', true );
   $type = $item->get_type();
}
 
// Other Secondary Items Stuff
$order->get_items_key();
$order->get_items_tax_classes();
$order->get_item_count();
$order->get_item_total();
$order->get_downloadable_items();
  
// Get Order Lines
$order->get_line_subtotal();
$order->get_line_tax();
$order->get_line_total();
  
// Get Order Shipping
$order->get_shipping_method();
$order->get_shipping_methods();
$order->get_shipping_to_display();
  
// Get Order Dates
$order->get_date_created();
$order->get_date_modified();
$order->get_date_completed();
$order->get_date_paid();
  
// Get Order User, Billing & Shipping Addresses
$order->get_customer_id();
$order->get_user_id();
$order->get_user();
$order->get_customer_ip_address();
$order->get_customer_user_agent();
$order->get_created_via();
$order->get_customer_note();
$order->get_address_prop();
$order->get_billing_first_name();
$order->get_billing_last_name();
$order->get_billing_company();
$order->get_billing_address_1();
$order->get_billing_address_2();
$order->get_billing_city();
$order->get_billing_state();
$order->get_billing_postcode();
$order->get_billing_country();
$order->get_billing_email();
$order->get_billing_phone();
$order->get_shipping_first_name();
$order->get_shipping_last_name();
$order->get_shipping_company();
$order->get_shipping_address_1();
$order->get_shipping_address_2();
$order->get_shipping_city();
$order->get_shipping_state();
$order->get_shipping_postcode();
$order->get_shipping_country();
$order->get_address();
$order->get_shipping_address_map_url();
$order->get_formatted_billing_full_name();
$order->get_formatted_shipping_full_name();
$order->get_formatted_billing_address();
$order->get_formatted_shipping_address();
  
// Get Order Payment Details
$order->get_payment_method();
$order->get_payment_method_title();
$order->get_transaction_id();
  
// Get Order URLs
$order->get_checkout_payment_url();
$order->get_checkout_order_received_url();
$order->get_cancel_order_url();
$order->get_cancel_order_url_raw();
$order->get_cancel_endpoint();
$order->get_view_order_url();
$order->get_edit_order_url();
  
// Get Order Status
$order->get_status();
}


function capweb_have_order_id( $order_id ) {
	echo nl2br("\nEnter capweb_have_order_id\n");

	$order = wc_get_order( $order_id );
	
	// Now you have access to (see above)...
	
	if ( $order ) {
		$order->get_formatted_order_total( );
	// etc.
	// etc.
	}

}

function capweb_have_email_variable() {
	// Get $order object from $email
  
	$order = $email->object;
	
	// Now you have access to (see above)...
	
		if ( $order ) {
			$order->get_id();
			$order->get_formatted_order_total( );
			// etc.
			// etc.
		}
}

// add_action('woocommerce_subscriptions_related_orders_meta_box', 'capweb_dump_subs_information'); /* dumped once below all rows */
// add_action('woocommerce_subscriptions_related_orders_meta_box_rows', 'capweb_dump_subs_information'); /* dumped above order rows */
// add_action('wcs_subscription_schedule_after_billing_schedule', 'capweb_dump_subs_information'); /* no data dumped */
// add_action('woocommerce_subscription_details_after_subscription_related_orders_table', 'capweb_dump_subs_information'); /* no data dumped */
function capweb_dump_subs_information( $order_id ) {
	echo nl2br("Enter capweb_dump_subs_information\n");
	// printf("order_id is %s\n", $order_id );
	// var_dump($order_id);
	// capweb_have_order_id( $order_id);
	$order = wc_get_order( $order_id );
	// var_dump(get_post_meta( $order_id, '_target_website', true ));
	// Get the value of the post meta with name `_my_post_meta_name`
	$post_meta_value = get_post_meta( $order_id->ID, '_target_website', true );
	printf( 'Order: %s  The value of my post meta _target_website is %s', $order_id->ID, $post_meta_value );
	// if ( get_post_meta( $order_id, 'wpcare_website', true ) ) echo '<p><strong>WPCare Website:</strong> ' . get_post_meta( $order_id, 'wpcare_website', true ) . '</p>';
	// if ( get_post_meta( $order_id, '_target_website', true ) ) echo '<p><strong>_target_Website:</strong> ' . get_post_meta( $order_id, 'wpcare_website', true ) . '</p>';
}


// $orders = wc_get_orders( array( 'customvar' => 'somevalue' ) );

/**
 * Handle a custom 'customvar' query var to get orders with the 'customvar' meta.
 * @param array $query - Args for WP_Query.
 * @param array $query_vars - Query vars from WC_Order_Query.
 * @return array modified $query
 */
function handle_custom_query_var( $query, $query_vars ) {
	if ( ! empty( $query_vars['customvar'] ) ) {
		$query['meta_query'][] = array(
			'key' => 'customvar',
			'value' => esc_attr( $query_vars['customvar'] ),
		);
	}

	return $query;
}
// add_filter( 'woocommerce_order_data_store_cpt_get_orders_query', 'handle_custom_query_var', 10, 2 );




// add_action('woocommerce_init', 'capweb_dump_order_information'); 
// add_action('woocommerce_admin_order_data_after_billing_address', 'capweb_dump_order_information'); 

function capweb_dump_order_information( $order ) {
	global $pagenow;
	$is_order_or_subs = $_GET['post_type'];
	// if ( ( 'edit.php' == $pagenow ) && ( in_array( $is_order_or_subs, array('shop_order', 'shop_subscription') ) ) ) {
	
			echo nl2br("\n\rEnter capweb_dump_order_information\n");
			echo nl2br("\n\rLooking at " . $is_order_or_subs . " \n");
			/**
		 * Loop through orders
		 */
		// $order = wc_get_order( $order_id );
		// $post_meta_value = get_post_meta( $order_id->ID, '_target_website', true );
		// $orders = wc_get_orders( array(
		// 	'limit'        => -1, // Query all orders
		// 	'orderby'      => 'date',
		// 	'order'        => 'DESC',
		// 	'meta_key'     => '_target_website',
		// 	'meta_compare' => 'NOT EXISTS', 
		// ));

		// Try this
		// $query = new WC_Order_Query();
		// $query->set( 'customer', 'cbaskin@tmdmalvern.com' );
		// $orders = $query->get_orders();
//


// New test   https://pluginrepublic.com/querying-woocommerce-orders/
// 	$args = array(
// 		'limit' => -1,
// 		'return' => 'ids',
// 		'status' => 'completed'
// 	);
//    $query = new WC_Order_Query( $args );
//    $orders = $query->get_orders();
//    echo nl2br(" print_r\n");
//    var_dump($orders);
//    echo nl2br("print_r done\n");

//    foreach( $orders as $order_id ) {
// 	 $order = wc_get_orders( $order_id );
// 	 $customer_id = $order->get_user_id();
// 	 echo nl2br(" print_r customer_id \n");
// 	 print_r($customer_id);
// 	 echo nl2br("print_r customer_id done\n");
//    }

// End of new test


// Yet another test
// Get 10 most recent order ids in date descending order.
$query = new WC_Order_Query( array(
    'limit' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'return' => 'ids',
) );
$orders = $query->get_orders();
// end of yet another test





		echo nl2br(" print_r\n");
		print_r($orders);
		echo nl2br("print_r done\n");
		// Get orders from the customer with email 'woocommerce@woocommerce.com'.
		// $query = new WC_Order_Query();
		// $query->set( 'customer', 'cbaskin@tmdmalvern.com' );
		// $orders = $query->get_orders( $args );
		// $args = array(
		// 		'limit'        => -1, // Query all orders
		// 		'orderby'      => 'date',
		// 		'order'        => 'DESC',
		// 		// 'meta_key'     => array('_target_website', 'wpcare_website'), // The postmeta key field
		// 		// 'meta_compare' => 'NOT EXISTS', // The comparison argument
		// 	);

		// Get orders from the customer with email 'woocommerce@woocommerce.com'.


		// $orders = wc_get_orders( $args );

		foreach( $orders as $my_order ) {

// from woo tweaks
			$my_order_id = $my_order->get_id();
			if ( get_post_meta( $my_order_id, '_target_website', true ) ) {
				echo '<p><strong>Target Website:</strong> ' . get_post_meta( $order_id, '_target_website', true ) . '</p>';
			} Else {
				echo 'No _target_website on this order';
			}
			// end of from woo tweaks

			echo nl2br("var_dump my_order\n");
			var_dump($my_order);
			echo nl2br("var_dump my_order done\n");
			echo nl2br("print_r my_order\n");
			print_r($my_order);
			echo nl2br("print_r my_order done\n");
			$post_meta_value = get_post_meta( $my_order->ID, '_target_website', true );
			printf( 'Order: %s  The value of _target_website is %s\n\r', $my_order->ID, $post_meta_value );
		}
	// }



}

/**
 * @snippet       Update Order Meta After a Successful Order - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
// add_action( 'woocommerce_init', 'bbloomer_alter_checkout_fields_after_order' );
 
function bbloomer_alter_checkout_fields_after_order( $order_id ) {
   $order = wc_get_order( $order_id );
//    $phone = $order->get_billing_phone();
   $target_value = get_post_meta( $order_id, '_target_website', true );
   echo nl2br(" Value is " . $target_value . " Change? ");
//    $calling_code = WC()->countries->get_country_calling_code( $order->get_billing_country() );
//    $calling_code = is_array( $calling_code ) ? $calling_code[0] : $calling_code;
//    if ( $phone && $calling_code && ! str_starts_with( $phone, $calling_code ) ) {
      // str_starts_with() works on PHP 8+ only
	  $phone = $calling_code . $phone;
	  if ( $_POST['_target_website'] ) update_post_meta( $order_id, '_target_website', esc_attr( $_POST['_target_website'] ) );
//    }   
}