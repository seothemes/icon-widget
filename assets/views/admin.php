<?php
/**
 * This file is used to markup the administration form of the widget.
 *
 * @package Icon_widget
 */

?>

<div class="wrapper">

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
			<?php esc_html_e( 'Title:', 'icon-widget' ); ?>
		</label>
		<br/>
		<input type="text" class='widefat'
		       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
		       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
		       value="<?php echo esc_attr( $title ); ?>">
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>">
			<?php esc_html_e( 'Content:', 'icon-widget' ); ?>
		</label>
		<br/>
		<textarea class='widefat' rows="4"
		          id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"
		          value="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"><?php echo esc_textarea( $content ); ?></textarea>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>">
			<?php esc_html_e( 'Link:', 'icon-widget' ); ?>
		</label>
		<br/>
		<input type="url" class='widefat'
		       id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"
		       name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>"
		       value="<?php echo esc_attr( $link ); ?>">
	</p>

	<?php
	$settings = get_option( 'icon_widget_settings', [ 'font' => 'font-awesome-5' ] );
	$icons    = require $this->plugin->dir . 'config/' . $settings['font'] . '.php';
	?>

	<script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#widgets-right .select-picker').selectpicker({
                iconBase: 'fa',
                dropupAuto: false
            });
        });
	</script>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>">
			<?php esc_html_e( 'Icon:', 'icon-widget' ); ?>
		</label>
		<br/>
		<select class='select-picker widefat'
		        id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"
		        name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>"
		        data-live-search="true">

			<?php foreach ( $icons as $icon ) : ?>

				<option data-icon='<?php echo esc_attr( $icon ); ?>' value="<?php echo esc_attr( $icon ); ?>" <?php echo ( $instance['icon'] === $icon ) ? 'selected' : ''; ?>><?php echo esc_html( str_replace( [
						'-',
						'far ',
						'ion ',
					], [ ' ', '', '' ], $icon ) ); ?>
				</option>

			<?php endforeach; ?>

		</select>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'weight' ) ); ?>">
			<?php esc_html_e( 'Weight:', 'icon-widget' ); ?>
		</label>
		<br/>
		<select class='widefat'
		        id="<?php echo esc_attr( $this->get_field_id( 'weight' ) ); ?>"
		        name="<?php echo esc_attr( $this->get_field_name( 'weight' ) ); ?>"
		        type="text">

			<?php for ( $i = 1; $i < 10; $i++ ) : ?>

				<option value='<?php echo "{$i}00"; ?>' <?php echo ( "{$i}00" === $weight ) ? 'selected' : ''; ?>>
					<?php echo "{$i}00"; ?>
				</option>

			<?php endfor; ?>

			<option value='default' <?php echo ( 'default' === $weight ) ? 'selected' : ''; ?>>
				<?php esc_attr_e( 'Default', 'icon-widget' ); ?>
			</option>

		</select>
	</p>

	<?php
	$scales = [ 'xs', 'sm', 'lg', '2x', '3x', '5x', '7x', '10x' ];
	?>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">
			<?php esc_html_e( 'Size:', 'icon-widget' ); ?>
		</label>
		<br/>
		<select class='widefat'
		        id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"
		        name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>"
		        type="text">

			<?php foreach ( $scales as $scale ) : ?>

				<option value='<?php echo $scale; ?>' <?php echo ( $scale === $size ) ? 'selected' : ''; ?>>
					<?php echo $scale; ?>
				</option>

			<?php endforeach; ?>

		</select>
	</p>

	<?php $alignments = [ 'left', 'center', 'right' ]; ?>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'align' ) ); ?>">
			<?php esc_html_e( 'Align:', 'icon-widget' ); ?>
		</label>
		<br/>
		<select class='widefat'
		        id="<?php echo esc_attr( $this->get_field_id( 'align' ) ); ?>"
		        name="<?php echo esc_attr( $this->get_field_name( 'align' ) ); ?>"
		        type="text">

			<?php foreach ( $alignments as $alignment ) : ?>

				<option value='<?php echo $alignment; ?>' <?php echo ( $alignment === $align ) ? 'selected' : ''; ?>>
					<?php echo ucwords( $alignment ); ?>
				</option>

			<?php endforeach; ?>

		</select>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'padding' ) ); ?>">
			<?php esc_html_e( 'Padding (px):', 'icon-widget' ); ?>
		</label>
		<br/>
		<input type="number" class='widefat'
		       id="<?php echo esc_attr( $this->get_field_id( 'padding' ) ); ?>"
		       name="<?php echo esc_attr( $this->get_field_name( 'padding' ) ); ?>"
		       value="<?php echo esc_attr( $padding ); ?>">
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'radius' ) ); ?>">
			<?php esc_html_e( 'Border Radius (px):', 'icon-widget' ); ?>
		</label>
		<br/>
		<input type="number" class='widefat'
		       id="<?php echo esc_attr( $this->get_field_id( 'radius' ) ); ?>"
		       name="<?php echo esc_attr( $this->get_field_name( 'radius' ) ); ?>"
		       value="<?php echo esc_attr( $radius ); ?>">
	</p>

	<script type="text/javascript">
        (function ($) {
            function initColorPicker(widget) {
                widget.find('.color-picker').wpColorPicker({
                    change: _.throttle(function () { // For Customizer
                        $(this).trigger('change');
                    }, 3000)
                });
            }

            function onFormUpdate(event, widget) {
                initColorPicker(widget);
            }

            $(document).on('widget-added widget-updated', onFormUpdate);

            $(document).ready(function () {
                $('#widgets-right .widget:has(.color-picker)').each(function () {
                    initColorPicker($(this));
                });
            });
        }(jQuery));
	</script>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>">
			<?php esc_html_e( 'Icon Color:', 'icon-widget' ); ?>
		</label>
		<br/>
		<input class="color-picker" type="text"
		       id="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"
		       name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>"
		       value="<?php echo esc_attr( $color ); ?>"/>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'bg' ) ); ?>">
			<?php esc_html_e( 'Background Color:', 'icon-widget' ); ?>
		</label>
		<br/>
		<input class="color-picker" type="text"
		       id="<?php echo esc_attr( $this->get_field_id( 'bg' ) ); ?>"
		       name="<?php echo esc_attr( $this->get_field_name( 'bg' ) ); ?>"
		       value="<?php echo esc_attr( $bg ); ?>"/>
	</p>

</div>

