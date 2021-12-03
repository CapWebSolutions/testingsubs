<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'digital', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'digital' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once get_stylesheet_directory() . '/lib/customize.php';

//* Include Customizer CSS
require_once get_stylesheet_directory() . '/lib/output.php';

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Digital Pro' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/digital/' );
define( 'CHILD_THEME_VERSION', '1.0.20211122' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'digital_scripts_styles' );
function digital_scripts_styles() {
	// wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Neuton:300,400italic,700|Poppins:400,500,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700', array(), CHILD_THEME_VERSION );
	// wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION, 'all' );

	wp_enqueue_script( 'digital-fadeup-script', get_stylesheet_directory_uri() . '/js/fadeup.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'digital-site-header', get_stylesheet_directory_uri() . '/js/site-header.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'digital-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'digital' ),
		'subMenu'  => __( 'Menu', 'digital' ),
	);
	wp_localize_script( 'digital-responsive-menu', 'DigitalL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'search-form', 'skip-links' ) );

//* Add screen reader class to archive description
add_filter( 'genesis_attr_author-archive-description', 'genesis_attributes_screen_reader_class' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 140,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Rename primary and secondary navigation menus
add_theme_support ( 'genesis-menus' , array ( 'primary' => __( 'Header Menu', 'digital' ), 'secondary' => __( 'Footer Menu', 'digital' ) ) );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Remove navigation meta box
add_action( 'genesis_theme_settings_metaboxes', 'digital_remove_genesis_metaboxes' );
function digital_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {

    remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );

}

//* Remove header right widget area
unregister_sidebar( 'header-right' );

//* Add image sizes
add_image_size( 'front-page-featured', 1000, 700, TRUE );

//* Reposition post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 4 );

//* Reposition primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Reposition secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 12 );

//* Reduce secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'digital_secondary_menu_args' );
function digital_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

/** Show posts of 'portfolio' CPT only on front page */
add_action( 'pre_get_posts', 'mr_exclude_category_from_blog' );
function mr_exclude_category_from_blog( $query ) {
    if( $query->is_main_query() && $query->is_home() ) {
		$query->set( 'post_type', array ( 'portfolio' ) );
				        $query->set( 'posts_per_page', '3' );
				        $query->set( 'nopaging', false );
	}
    return $query;
}

//* Remove seondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Reposition entry meta in entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 8 );

//* Customize entry meta in the entry header.
//	Remove it completely for Portfolio CPT items.
add_filter( 'genesis_post_info', 'mr_digital_entry_meta_header' );
function mr_digital_entry_meta_header($post_info) {
	if ( 'portfolio'  == get_post_type() ) {
		$post_info = "";
	}else {
		$post_info = '[post_categories before=""] | [post_date] [post_edit]';
	}
	return $post_info;
}

//* Customize the content limit more markup
add_filter( 'get_the_content_limit', 'digital_content_limit_read_more_markup', 10, 3 );
function digital_content_limit_read_more_markup( $output, $content, $link ) {

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

//* Customize author box title
add_filter( 'genesis_author_box_title', 'digital_author_box_title' );
function digital_author_box_title() {

	return '<span itemprop="name">' . get_the_author() . '</span>';

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'digital_author_box_gravatar' );
function digital_author_box_gravatar( $size ) {

	return 160;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'digital_comments_gravatar' );
function digital_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;
	return $args;

}

//* Remove entry meta in the entry footer on front page
// add_action( 'genesis_before_entry', 'digital_remove_entry_footer' );
function digital_remove_entry_footer() {

	if ( is_front_page() || is_archive() || isc_search() || is_page_template( 'page_blog.php' ) ) {
	// if ( is_front_page()  ) {
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	}
}

//* Customize the entry meta in the entry footer for blog
// add_filter( 'genesis_post_meta', 'mr_post_meta_filter' );
function mr_post_meta_filter($post_meta) {
	if ( is_archive() || is_page_template( 'page_blog.php' ) ) {
		$post_meta = 'Category: [post_categories]<br>Tagged with: [post_tags]';
	}else {
		$post_meta = 'Posted on [post_date]   Category: [post_categories]<br>Tagged with: [post_tags]';
	}
	return $post_meta;
}

//* Setup widget counts
function digital_count_widgets( $id ) {
	global $sidebars_widgets;
	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}
}

//* Flexible widget classes
function digital_widget_area_class( $id ) {
	$count = digital_count_widgets( $id );
	$class = '';
	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves even';
	}
	return $class;

}

//* Flexible widget classes
function digital_halves_widget_area_class( $id ) {
	$count = digital_count_widgets( $id );
	$class = '';
	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 2 == 0 ) {
		$class .= ' widget-halves';
	} else {
		$class .= ' widget-halves uneven';
	}
	return $class;
}

//* Add support for 3-column footer widget
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'digital' ),
	'description' => __( 'This is the 1st section on the front page.', 'digital' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'digital' ),
	'description' => __( 'This is the 2nd section on the front page.', 'digital' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'digital' ),
	'description' => __( 'This is the 3rd section on the front page.', 'digital' ),
) );
function cws_extended_paypal_icon() {
        // picture of accepted credit card icons for PayPal payments
    return get_stylesheet_directory_uri() .'/images/PayPal-logo.png';
}
add_filter( 'woocommerce_paypal_icon', 'cws_extended_paypal_icon' );

/**
 * Set Gravity forms to always scroll to any confirmation message. 
 */
add_filter( 'gform_confirmation_anchor', '__return_true' );

/**
 * Remove css file added by DPS column extension
 */
add_filter( 'dps_columns_extension_include_css', '__return_false' );

/*	Run through all subscriptions and print out details */
// add_filter( 'woocommerce_loaded', 'capweb_look_at_subscriptions' );

/**
* @snippet       Remove "Default Sorting" Dropdown @ WooCommerce Shop & Archive Pages
* @how-to        Get CustomizeWoo.com FREE
* @author        Rodolfo Melogli
* @compatible    Woo 3.8
*/
  
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

