<?php
/**
* Create Admin Column for featured image
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

add_filter('manage_selthemes_event_posts_columns', 'selt_ce_columns_head');
add_action('manage_selthemes_event_posts_custom_column', 'selt_ce_columns', 10, 2);

function selt_ce_columns_head($defaults){
    $defaults['event_featured_image_preview'] = esc_html__('Thumbnail', 'selthemes'); //name of the column
    return $defaults;
}

function selt_ce_columns( $column_id, $post_id ){
    if ($column_id === 'event_featured_image_preview'){
        echo the_post_thumbnail( array(50,50) ); //size of the thumbnail
    }
}

?>
