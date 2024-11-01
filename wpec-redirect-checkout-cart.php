<?php
/*
Plugin Name: WP eCommerce Checkout Redirect
Plugin URI: www.devsource.co
Description: After adding a product to the cart the visitor is redirected to the Shopping Cart page automatically.
Version: 1.0.2
Author: Mihai Alexandru Joldis
Author URI: http://www.devsource.co
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_filter( 'wpsc_add_to_cart_json_response', 'devco_redirect_checkout_cart', 10, 1 );

function devco_redirect_checkout_cart( $json_response ) {
	$json_response['fancy_notification'] = str_replace( array( "\n", "\r" ), array( '\n', '\r' ), devco_fancy_notification_text( $json_response['cart_messages'] ) );
	
	return $json_response;
}

/*
 * copied from WPeC at version 3.8.14.1
 */
function devco_fancy_notification_text( $cart_messages ) {
	
	$siteurl = get_option( 'siteurl' );
	$output = '';
	foreach ( (array)$cart_messages as $cart_message ) {
		$output .= "<span>" . $cart_message . "</span><br />";
	}

	//wpsc_cart_item_count();
	$output .= "<script>window.location = '".get_option( 'shopping_cart_url' )."';</script>";
	return $output;
}