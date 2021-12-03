<?php
/**
 * This file adds the Pricing Interior Wide page template to the Digital Pro Theme.
 *
 * @author Cap Web Solutions
 * @package Digital Pro Theme
 * @subpackage Customizations
 */

/*
Template Name: Pricing Wide
*/

//* Add interior wide body class to the head
add_filter( 'body_class', 'digital_add_body_class' );
function digital_add_body_class( $classes ) {

	$classes[] = 'digital-pricing-interior-wide';
	return $classes;

}

//* Run the Genesis loop
genesis();
