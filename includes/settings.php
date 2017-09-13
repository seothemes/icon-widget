<?php
/**
 * This file adds the plugin settings.
 *
 * @package Icon_Widget
 */

// Register settings.
add_action( 'admin_menu', 'icon_widget_add_admin_menu' );
add_action( 'admin_init', 'icon_widget_settings_init' );

/**
 * Add settings menu item.
 *
 * @return void
 */
function icon_widget_add_admin_menu() {

	add_options_page( 'Icon Widget', 'Icon Widget', 'manage_options', 'icon_widget', 'icon_widget_options_page' );

}

/**
 * Initialize settings.
 *
 * @return void
 */
function icon_widget_settings_init() {

	register_setting( 'icon_widget_setting', 'icon_widget_settings' );

	add_settings_section(
		'icon_widget_section',
		__( 'Settings page for the Icon Widget plugin.', 'icon-widget' ),
		'icon_widget_settings_section_callback',
		'icon_widget_setting'
	);

	add_settings_field(
		'font',
		__( 'Icon font', 'icon-widget' ),
		'font_render',
		'icon_widget_setting',
		'icon_widget_section'
	);

	/*
	add_settings_field(
		'icon_widget_checkbox_field_0',
		__( 'Load CSS', 'icon-widget' ),
		'icon_widget_checkbox_field_0_render',
		'icon_widget_setting',
		'icon_widget_section'
	);

	add_settings_field(
		'icon_widget_radio_field_1',
		__( 'Icon position', 'icon-widget' ),
		'icon_widget_radio_field_1_render',
		'icon_widget_setting',
		'icon_widget_section'
	);

	add_settings_field(
		'icon_widget_text_field_3',
		__( 'Settings field description', 'icon-widget' ),
		'icon_widget_text_field_3_render',
		'icon_widget_setting',
		'icon_widget_section'
	);

	add_settings_field(
		'icon_widget_textarea_field_4',
		__( 'Settings field description', 'icon-widget' ),
		'icon_widget_textarea_field_4_render',
		'icon_widget_setting',
		'icon_widget_section'
	);
	*/

}

/**
 * Render checkbox.
 *
 * @return void
 */
function icon_widget_checkbox_field_0_render() {

	$options = get_option( 'icon_widget_settings' );
	?>
	<input type='checkbox' name='icon_widget_settings[icon_widget_checkbox_field_0]' <?php checked( $options['icon_widget_checkbox_field_0'], 1 ); ?> value='1'>
	<?php

}

/**
 * Render radio.
 *
 * @return void
 */
function icon_widget_radio_field_1_render() {

	$options = get_option( 'icon_widget_settings' );
	?>
	<input type='radio' name='icon_widget_settings[icon_widget_radio_field_1]' <?php checked( $options['icon_widget_radio_field_1'], 0 ); ?> value='0' id="false">
	<label for="false">Before title &nbsp;</label>
	<input type='radio' name='icon_widget_settings[icon_widget_radio_field_1]' <?php checked( $options['icon_widget_radio_field_1'], 1 ); ?> value='1' id="true">
	<label for="true">After title</label>
	<?php

}

/**
 * Render select dropdown.
 *
 * @return void
 */
function font_render() {

	$options  = get_option( 'icon_widget_settings' );
	$selected = $options['font'] ? $options['font'] : 'font-awesome';

	?>
	<select name='icon_widget_settings[font]'>
		<option value='font-awesome' <?php selected( $selected, 'font-awesome' ); ?>><?php esc_html_e( 'Font Awesome', 'icon-widget' ); ?></option>
		<option value='line-awesome' <?php selected( $selected, 'line-awesome' ); ?>><?php esc_html_e( 'Line Awesome', 'icon-widget' ); ?></option>
		<option value='ionicons' <?php selected( $selected, 'ionicons' ); ?>><?php esc_html_e( 'Ionicons', 'icon-widget' ); ?></option>
	</select>

<?php

}

/**
 * Render text field.
 *
 * @return void
 */
function icon_widget_text_field_3_render() {

	$options = get_option( 'icon_widget_settings' );
	?>
	<input type='text' name='icon_widget_settings[icon_widget_text_field_3]' value='<?php echo $options['icon_widget_text_field_3']; ?>'>
	<?php

}

/**
 * Render textarea.
 *
 * @return void
 */
function icon_widget_textarea_field_4_render() {

	$options = get_option( 'icon_widget_settings' );
	?>
	<textarea cols='40' rows='5' name='icon_widget_settings[icon_widget_textarea_field_4]'> 
		<?php echo $options['icon_widget_textarea_field_4']; ?>
 	</textarea>
	<?php

}

/**
 * Section description.
 *
 * @return void
 */
function icon_widget_settings_section_callback() {

	// Section description.
	echo __( '', 'icon-widget' );

}

/**
 * Display options page.
 *
 * @return void
 */
function icon_widget_options_page() {

	?>
	<div class="wrap">

	<h1>Icon Widget</h1>

	<form action='options.php' method='post'>

		<?php
		settings_fields( 'icon_widget_setting' );
		do_settings_sections( 'icon_widget_setting' );
		submit_button();
		?>

	</form>

	</div>

	<?php

}
