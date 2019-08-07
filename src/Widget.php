<?php

namespace SeoThemes\IconWidget;

use WP_Widget;

/**
 * Class Widget
 *
 * @package SeoThemes\IconWidget
 */
class Widget extends WP_Widget {

	/**
	 * @var Plugin
	 */
	public $plugin;

	/**
	 * Widget constructor.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function __construct() {

		// Get plugin instance.
		$this->plugin = Factory::get_instance();

		parent::__construct(
			$this->plugin->handle,
			__( 'Icon', 'icon-widget' ),
			[
				'classname'   => 'icon_widget',
				'description' => __( 'Displays an icon with a title and description.', 'icon-widget' ),
			]
		);
	}

	/**
	 * Outputs the content of the widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     The array of form elements.
	 * @param array $instance The current instance of the widget.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		echo $args['before_widget'];

		printf( '<div class="icon-widget" style="text-align: %s">', esc_attr( $instance['align'] ) );

		printf( '<i class="fa %1$s fa-%2$s" style="color:%3$s;background-color:%4$s;padding:%5$spx;border-radius:%6$spx;"> </i>', esc_attr( $instance['icon'] ), esc_attr( $instance['size'] ), esc_attr( $instance['color'] ), esc_attr( $instance['bg'] ), esc_attr( $instance['padding'] ), esc_attr( $instance['radius'] ) );

		echo apply_filters( 'icon_widget_line_break', true ) ? '<br>' : '';

		echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];

		echo apply_filters( 'icon_widget_wpautop', true ) ? wp_kses_post( wpautop( $instance['content'] ) ) : wp_kses_post( $instance['content'] );

		echo '</div>';

		echo $args['after_widget'];
	}

	/**
	 * Process the widget's options to be saved.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance The new instance of values to be generated via the
	 *                            update.
	 * @param array $old_instance The previous instance of values before the update.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Update widget's old values with new incoming values.
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['content'] = wp_kses_post( $new_instance['content'] );
		$instance['icon']    = sanitize_html_class( $new_instance['icon'] );
		$instance['size']    = sanitize_html_class( $new_instance['size'] );
		$instance['align']   = sanitize_html_class( $new_instance['align'] );
		$instance['color']   = sanitize_hex_color( $new_instance['color'] );
		$instance['bg']      = sanitize_hex_color( $new_instance['bg'] );
		$instance['padding'] = intval( $new_instance['padding'] );
		$instance['radius']  = intval( $new_instance['radius'] );

		return $instance;
	}

	/**
	 * Generates the administration form for the widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance The array of keys and values for the widget.
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$defaults = apply_filters( 'icon_widget_defaults', [
			'title'   => '',
			'content' => '',
			// Keep sub filters for backwards compat.
			'icon'    => apply_filters( 'icon_widget_default_icon', '\f000' ),
			'size'    => apply_filters( 'icon_widget_default_size', '2x' ),
			'align'   => apply_filters( 'icon_widget_default_align', 'left' ),
			'color'   => apply_filters( 'icon_widget_default_color', '#333333' ),
			'bg'      => '',
			'padding' => '',
			'radius'  => '',
		] );

		// Define default values for your variables.
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Store the values of the widget in their own variable.
		$title   = $instance['title'];
		$content = $instance['content'];
		$icon    = $instance['icon'];
		$size    = $instance['size'];
		$align   = $instance['align'];
		$color   = $instance['color'];
		$bg      = $instance['bg'];
		$padding = $instance['padding'];
		$radius  = $instance['radius'];

		// Display the admin form.
		require $this->plugin->dir . 'assets/views/admin.php';
	}
}
