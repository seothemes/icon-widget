<?php
/**
 * Plugin Name: Icon Widget
 * Plugin URI:  https://wordpress.org/plugins/icon-widget/
 * Description: Displays an icon widget with a title and description.
 * Version:     1.3.0
 * Author:      SEO Themes
 * Author URI:  https://seothemes.com/
 * Text Domain: icon-widget
 * License:     GPL-2.0-or-later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
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

\call_user_func( function () {
	$icon_widget = Factory::get_instance();

	$icon_widget->register( Textdomain::class );
	$icon_widget->register( Shortcode::class );
	$icon_widget->register( Settings::class );
	$icon_widget->register( Enqueue::class );
	$icon_widget->register( Hooks::class );

	$icon_widget->run();
} );

