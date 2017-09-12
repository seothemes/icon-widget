<?php
/**
 * This file is used to markup the public-facing widget.
 *
 * @package Icon_Widget
 */

?>

<div class="icon-widget" style="text-align: <?php echo esc_attr( $instance['align'] ); ?>">

	<i class="fa <?php echo esc_attr( $instance['icon'] ); ?> fa-<?php echo esc_attr( $instance['size'] ); ?>" style="color: <?php echo esc_attr( $instance['color'] ); ?>"></i>

	<br>&nbsp;

	<h4><?php echo esc_html( apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) ); ?></h4>

	<p><?php echo esc_textarea( $instance['content'] ); ?></p>

</div>
