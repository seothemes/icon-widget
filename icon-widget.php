<?php
/**
 * Icon Widget
 *
 * Icon Widget creates a new WordPress widget that displays a Fontawesome icon,
 * title and description. Select the size, color and text-alignment with easy
 * to use dropdown options.
 *
 * @package   Icon_Widget
 * @author    SEO Themes <info@seothemes.com>
 * @license   GPL-2.0+
 * @link      https://seothemes.com
 * @copyright 2017 SEO Themes
 *
 * Plugin Name:       Icon Widget
 * Plugin URI:        https://seothemes.com
 * Description:       Displays a Fontawesome icon with a title and description
 * Version:           1.0.0
 * Author:            SEO Themes
 * Author URI:        https://seothemes.com
 * Text Domain:       icon-widget
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

// Prevent direct file access.
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 * Widget class.
 */
class Icon_Widget extends WP_Widget {

	/**
	 * Unique identifier for the widget.
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * widget file.
	 *
	 * @since 1.0.0
	 *
	 * @var   string
	 */
	protected $widget_slug = 'icon-widget';

	/**
	 * Constructor
	 *
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// Load plugin text domain.
		add_action( 'init', array(
			$this,
			'widget_textdomain',
		) );

		parent::__construct(
			$this->get_widget_slug(),
			__( 'Icon', 'icon-widget' ),
			array(
				'classname'   => 'icon_widget',
				'description' => __( 'Displays an icon with a title and description.', 'icon-widget' ),
			)
		);

		// Register admin styles and scripts.
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

	}

	/**
	 * Return the widget slug.
	 *
	 * @since  1.0.0
	 *
	 * @return Plugin slug variable.
	 */
	public function get_widget_slug() {

		return $this->widget_slug;

	}

	/*
	 |--------------------------------------------------------------------------
	 | Widget API Functions
	 |--------------------------------------------------------------------------
	 */

	/**
	 * Outputs the content of the widget.
	 *
	 * @param array $args  The array of form elements.
	 * @param array $instance The current instance of the widget.
	 */
	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}

		echo $args['before_widget'];

		printf( '<div class="icon-widget" style="text-align: %s">', esc_attr( $instance['align'] ) );

		printf( '<i class="fa %1$s fa-%2$s" style="color: %3$s"></i>', esc_attr( $instance['icon'] ), esc_attr( $instance['size'] ), esc_attr( $instance['color'] ) );

		echo apply_filters( 'icon_widget_line_break', true ) ? '<br>' : '';

		echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];

		echo apply_filters( 'icon_widget_wpautop', true ) ? wp_kses_post( wpautop( $instance['content'] ) ) : wp_kses_post( $instance['content'] );

		echo '</div>';

		echo $args['after_widget'];

	}

	/**
	 * Process the widget's options to be saved.
	 *
	 * @param array $new_instance The new instance of values to be generated via the update.
	 * @param array $old_instance The previous instance of values before the update.
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

		return $instance;

	}

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array $instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		// Define default values for your variables.
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'   => '',
				'content' => '',
				'icon'    => '\f000',
				'size'    => 'lg',
				'align'   => 'left',
				'color'   => '#333333',
			)
		);

		// Store the values of the widget in their own variable.
		$title   = $instance['title'];
		$content = $instance['content'];
		$icon    = $instance['icon'];
		$size    = $instance['size'];
		$align   = $instance['align'];
		$color   = $instance['color'];

		// Display the admin form.
		include( plugin_dir_path( __FILE__ ) . 'views/admin.php' );

	}

	/*
	 |--------------------------------------------------------------------------
	 | Public Functions
	 |--------------------------------------------------------------------------
	 */

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {

		load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'languages/' );

	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		// TODO define activation functionality here.
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate"action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		// TODO define deactivation functionality here.
	}

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

		wp_enqueue_style( $this->get_widget_slug() . '-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array( 'wp-color-picker' ) );

		wp_enqueue_style( 'font-awesome', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ), array( $this->get_widget_slug() . '-admin-styles' ) );

		wp_enqueue_style( 'bootstrap', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ), array( 'font-awesome' ) );

		wp_enqueue_style( 'bootstrap-select', plugins_url( 'assets/css/bootstrap-select.min.css', __FILE__ ), array( 'bootstrap' ) );

	}

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		wp_enqueue_script( $this->get_widget_slug() . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ) );

		wp_enqueue_script( 'bootstrap', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ), array( $this->get_widget_slug() . '-admin-script' ) );

		wp_enqueue_script( 'bootstrap-select', plugins_url( 'assets/js/bootstrap-select.min.js', __FILE__ ), array( 'bootstrap' ) );

	}

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {

		// wp_enqueue_style( $this->get_widget_slug() . '-widget-styles', plugins_url( 'assets/css/widget.css', __FILE__ ) );

		wp_enqueue_style( 'font-awesome', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ) );

	}

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {

		// wp_enqueue_script( $this->get_widget_slug() . '-script', plugins_url( 'assets/js/widget.js', __FILE__ ), array( 'jquery' ) );

	}

}

// Register widget.
add_action( 'widgets_init', create_function( '', 'register_widget("Icon_Widget");' ) );

// Hooks fired when the Widget is activated and deactivated.
register_activation_hook( __FILE__, array( 'Icon_Widget', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Icon_Widget', 'deactivate' ) );
