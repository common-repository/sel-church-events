<?php
/**
* Create Church Event Custom Post Type and Taxonomies.
*
* @since 1.0.0
* @package Selthemes
* @subpackage Church Events by Selthemes
*/

//Exit if accessed directly
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

/**
 * Function Prefix 'selt_ce'
 * @since 1.0.0
 */

if ( ! function_exists('selt_ce_post_type') ) {

// Register Custom Post Type
function selt_ce_post_type() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'selthemes' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'selthemes' ),
		'menu_name'             => __( 'Events', 'selthemes' ),
		'name_admin_bar'        => __( 'Event', 'selthemes' ),
		'archives'              => __( 'Event Archives', 'selthemes' ),
		'attributes'            => __( 'Event Attributes', 'selthemes' ),
		'parent_item_colon'     => __( 'Parent Event:', 'selthemes' ),
		'all_items'             => __( 'All Events', 'selthemes' ),
		'add_new_item'          => __( 'Add New Event', 'selthemes' ),
		'add_new'               => __( 'New Event', 'selthemes' ),
		'new_item'              => __( 'New Event', 'selthemes' ),
		'edit_item'             => __( 'Edit Event', 'selthemes' ),
		'update_item'           => __( 'Update Event', 'selthemes' ),
		'view_item'             => __( 'View Event', 'selthemes' ),
		'view_items'            => __( 'View Events', 'selthemes' ),
		'search_items'          => __( 'Search events', 'selthemes' ),
		'not_found'             => __( 'No events found', 'selthemes' ),
		'not_found_in_trash'    => __( 'No events found in Trash', 'selthemes' ),
		'featured_image'        => __( 'Event Featured Image', 'selthemes' ),
		'set_featured_image'    => __( 'Set event featured image', 'selthemes' ),
		'remove_featured_image' => __( 'Remove event featured image', 'selthemes' ),
		'use_featured_image'    => __( 'Use as event featured image', 'selthemes' ),
		'insert_into_item'      => __( 'Insert into event', 'selthemes' ),
		'uploaded_to_this_item' => __( 'Uploaded to this event', 'selthemes' ),
		'items_list'            => __( 'Events list', 'selthemes' ),
		'items_list_navigation' => __( 'Events list navigation', 'selthemes' ),
		'filter_items_list'     => __( 'Filter events list', 'selthemes' ),
	);
	$rewrite = array(
		'slug'                  => 'events',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Event', 'selthemes' ),
		'description'           => __( 'Simple Church Events Post Type', 'selthemes' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', ),
		'taxonomies'            => array( 'selthemes_event_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'selt_event', $args );

}
add_action( 'init', 'selt_ce_post_type', 0 );

}


//Event Taxonomies

if ( ! function_exists( 'selt_ce_category_taxonomy' ) ) {

// Register Custom Taxonomy
function selt_ce_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'selthemes' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'selthemes' ),
		'menu_name'                  => __( 'Category', 'selthemes' ),
		'all_items'                  => __( 'All Categories', 'selthemes' ),
		'parent_item'                => __( 'Parent Category', 'selthemes' ),
		'parent_item_colon'          => __( 'Parent Category:', 'selthemes' ),
		'new_item_name'              => __( 'New Category Name', 'selthemes' ),
		'add_new_item'               => __( 'Add New Category', 'selthemes' ),
		'edit_item'                  => __( 'Edit Category', 'selthemes' ),
		'update_item'                => __( 'Update Category', 'selthemes' ),
		'view_item'                  => __( 'View Category', 'selthemes' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'selthemes' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'selthemes' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'selthemes' ),
		'popular_items'              => __( 'Popular Categories', 'selthemes' ),
		'search_items'               => __( 'Search Categories', 'selthemes' ),
		'not_found'                  => __( 'Categories Not Found', 'selthemes' ),
		'no_terms'                   => __( 'No Categories', 'selthemes' ),
		'items_list'                 => __( 'Categories list', 'selthemes' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'selthemes' ),
	);
	$rewrite = array(
		'slug'                       => 'event-category',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'selt_event_category', array( 'selt_event' ), $args );

}
add_action( 'init', 'selt_ce_category_taxonomy', 0 );

}


 ?>
