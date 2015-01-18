<?php
/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'load_frothy_widgets' );

/**
 * Register our widget.
 * 'Frothy_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function load_frothy_widgets() {
	register_widget( 'Geo_Widget' );
}




/**
 * Geo Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Geo_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Geo_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'geo_widget', 'description' => __('Simple geo location phone promo.', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'geo-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'geo-widget', __('Geo Widget', 'geo_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		?>
			
			<div class="geo-text-block">
				<div class="promo-large-text"><span>Looking for Help</div>
				<div class="phone-num"><?php echo do_shortcode('[frn_phone]'); ?></div>
			</div><!-- end text-block -->
			
			
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		
		$instance = wp_parse_args( (array) $instance); ?>


	<?php
	}
}
?>