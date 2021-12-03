<?php
/**
 * This file adds the gForm page template to the Digital Pro Theme.
 *
 * @author Matt Ryan
 * @package Digital Pro Theme
 * @subpackage Customizations
 */

/*
Template Name: gForm
*/

//* Add gform body class to the head
add_filter( 'body_class', 'digital_add_body_class' );
function digital_add_body_class( $classes ) {

	$classes[] = 'digital-gform';
	return $classes;

}

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove site header elements
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//* Remove navigation
// remove_theme_support( 'genesis-menus' );

//* Remove breadcrumbs
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
// remove_theme_support( 'genesis-footer-widgets' );

//* Remove site footer elements
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Run the Genesis loop
genesis();
