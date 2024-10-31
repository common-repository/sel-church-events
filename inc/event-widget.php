<?php
/**
* Upcoming Events Widget Class
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
 * @since 1.0.1
 */

/**
 * Core class used to implement a Upcoming Events widget.
 */
class SelT_CE_Widget_Upcoming_Events extends WP_Widget {

	/**
	 * Sets up a new Upcoming Sermon widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_upcoming_event_entries',
			'description' => __( 'Your site&#8217;s upcoming events.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'upcoming-events', __( 'Selthemes :: Upcoming Events' ), $widget_ops );
		$this->alt_option_name = 'widget_upcoming_event_entries';
	}

	/**
	 * Outputs the content for the current Upcoming Sermon widget instance.
	 *
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Upcoming Events' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filters the arguments for the Upcoming Events widget.
		 *
		 */
		$r = new WP_Query( apply_filters( 'widget_events_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       	=> true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'selt_event',
			'meta_key' 		=> '_selthemes_events_end_date',
			'orderby' 		=> '_selthemes_events_end_date',
			'order'  		=> 'ASC',
			'meta_query' => array(
					array(
							'key' 		=> '_selthemes_events_end_date',
							'value' 	=> time(),
							'compare' 	=> '>=',
				),
			),
		) ) );

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="selthemes-widgets upcoming-events">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<div class="row">
					<?php if ( '' != get_the_post_thumbnail() ) : ?>
						<div class="col-3 event-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="col-9 event-content">
						<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>

						<?php if ( $show_date ) : ?>
              <?php $event_date = selthemes_get_events_start_date(); ?>
              <?php if ( $event_date ) : ?>
								<span class="event-date"><?php echo esc_html(date('l jS \of F Y', $event_date )); ?></span>
							<?php endif; ?>
						<?php endif; ?>
						
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php echo $args['after_widget']; ?>
		<?php

		wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Upcoming Events widget instance.
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Upcoming Events widget.
	 *
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Events to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display event date?' ); ?></label></p>
<?php
	}
}
