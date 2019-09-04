<?php
/**
 * Icon Widget
 *
 * Icon Widget creates a new WordPress widget that displays an icon,
 * title and description. Select the size, color, text-alignment,
 * padding, radius and more with easy to use dropdown options.
 *
 * @package   SeoThemes\IconWidget
 * @author    SEO Themes <info@seothemes.com>
 * @license   GPL-3.0-or-later
 * @link      https://seothemes.com/
 * @copyright 2019 SEO Themes
 *
 * Plugin Name:       Icon Widget
 * Plugin URI:        https://wordpress.org/plugins/icon-widget/
 * Description:       Displays an icon widget with a title and description.
 * Version:           1.2.6
 * Author:            SEO Themes
 * Author URI:        https://seothemes.com/
 * Text Domain:       icon-widget
 * License:           GPL-3.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/seothemes/icon-widget/
 */

namespace SeoThemes\IconWidget;

// Prevent direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Autoload classes.
spl_autoload_register( function ( $class ) {
	$file = __DIR__ . '/src/' . substr( strrchr( $class, '\\' ), 1 ) . '.php';

	if ( is_readable( $file ) ) {
		require_once $file;
	}
} );

// Initialize container.
$icon_widget = Factory::get_instance();

// Inject dependencies.
$icon_widget->register( Textdomain::class );
$icon_widget->register( Shortcode::class );
$icon_widget->register( Settings::class );
$icon_widget->register( Enqueue::class );
$icon_widget->register( Hooks::class );

// Run services.
$icon_widget->run();
