<?php
/**
* Create church event custom metabox.
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


add_action( 'cmb2_admin_init', 'selt_ce_metabox' );

/**
 * Define the metabox and field configurations.
 */
function selt_ce_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_selthemes_events_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'selthemes_events',
		'title'         => esc_attr__( 'Event Date, Times and Location', 'selthemes' ),
		'object_types'  => array( 'selt_event', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );


    //Event Starting Date
    $cmb->add_field( array(
    	'name' => esc_attr__( 'Start Date', 'selthemes'),
        'desc' => esc_attr__( 'Event Start Date', 'selthemes' ),
    	'id'   => $prefix . 'start_date',
    	'type' => 'text_date_timestamp',
		'column' => array(
			'position' => 2,
			'name'     => 'Start Date',
		),
    ) );

    //Event End Date
    $cmb->add_field( array(
    	'name' => esc_attr__('End Date', 'selthemes'),
        'desc' => esc_attr__( 'Event End Date', 'selthemes' ),
    	'id'   => $prefix . 'end_date',
    	'type' => 'text_date_timestamp',
		'column' => array(
			'position' => 3,
			'name'     => 'End Date',
		),
    ) );

    // Event Start Time
    $cmb->add_field( array(
    	'name' => esc_attr__('Start Time', 'selthemes'),
        'desc' => esc_attr__( 'Event Start Time', 'selthemes' ),
    	'id'   => $prefix . 'start_time',
    	'type' => 'text_time',
		'column' => array(
			'position' => 4,
			'name'     => 'Start Time',
		),
    ) );

    // Event End Time
    $cmb->add_field( array(
    	'name'     => esc_attr__('End Time', 'selthemes'),
        'desc'     => esc_attr__( 'Event Start Time', 'selthemes' ),
    	'id'       => $prefix .'end_time',
    	'type'     => 'text_time',
		'column' => array(
			'position' => 5,
			'name'     => 'End Time',
		),
    ) );

    // Event Address
    $cmb->add_field( array(
    	'name'     => esc_attr__('Address', 'selthemes'),
    	'id'       => $prefix . 'addresses',
    	'type'     => 'textarea_small',
		'column' => array(
			'position' => 6,
			'name'     => 'Address',
		),
    ) );


    // Event Registration Url
    $cmb->add_field( array(
    	'name'    => esc_attr__('Registration URL', 'selthemes'),
    	'desc'    => esc_attr__('Link to a third-party registration page, EventBrite, etc.', 'selthemes'),
    	'id'      => $prefix . 'registration_url',
    	'type'    => 'text_url',
    ) );

}

?>
