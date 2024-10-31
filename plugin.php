<?php

/**
 * Plugin Name:       Sel Church Events
 * Plugin URI:        https://selthemes.com/plugins/sel-church-events
 * Description:       This plugin created for official church themes from Selthemes.com. This plugin registers a custom post type for event items, taxonomy, widgets and metabox (cmb2).
 * Version:           1.0.1
 * Author:            Selthemes
 * Author URI:        http://selthemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       selthemes
 */

//Exit if accessed directly
if ( ! defined ( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include Post Type
 *
 * @since 1.0.0
 */
require_once ( plugin_dir_path(__FILE__) . '/inc/tgmpa/required-plugin.php');
require_once ( plugin_dir_path(__FILE__) . '/inc/event-post-type.php');
require_once ( plugin_dir_path(__FILE__) . '/inc/event-meta.php');
require_once ( plugin_dir_path(__FILE__) . '/inc/event-columns.php');
require_once ( plugin_dir_path(__FILE__) . '/inc/event-widget.php');


/**
 * Flush the permalinks
 * Load CPTs and Taxonomies
 *
 * @since 1.0.0
 *
 *
 * Function Prefix 'selt_ce'
 * @since 1.0.0
 */
function selt_ce_activate() {
	selt_ce_post_type();
  selt_ce_category_taxonomy();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'selt_ce_activate' );



/**
 * Register Upcoming Event Widget.
 *
 * @since 1.0.0
 */
add_action( 'widgets_init', function(){
    register_widget( 'SelT_CE_Widget_Upcoming_Events' );
} );
