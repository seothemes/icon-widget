<?php

namespace SeoThemes\IconWidget;

/**
 * Class Shortcode
 *
 * @package SeoThemes\IconWidget
 */
class Shortcode extends Service {

	/**
	 * Runs class hooks.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function run() {
		add_shortcode( 'icon_widget', [ $this, 'add_shortcode' ] );
	}

	/**
	 * Add Shortcode.
	 *
	 * @since 1.2.0
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string
	 */
	public function add_shortcode( $atts ) {
		$atts = shortcode_atts(
			apply_filters( 'icon_widget_defaults', [
				'classes' => $this->plugin->handle,
				'title'   => $this->plugin->name,
				'content' => 'Add a short description.',
				'link'    => '',
				'icon'    => apply_filters( 'icon_widget_default_shortcode_icon', 'fa-star' ),
				'weight'  => '600',
				'size'    => apply_filters( 'icon_widget_default_size', '2x' ),
				'align'   => apply_filters( 'icon_widget_default_align', 'left' ),
				'color'   => apply_filters( 'icon_widget_default_color', '#333333' ),
				'heading' => 'h4',
				'break'   => '<br>',
				'bg'      => '',
				'padding' => '',
				'radius'  => '',
			] ),
			$atts,
			'icon_widget'
		);

		// Store variables.
		$classes = $atts['classes'];
		$title   = $atts['title'];
		$content = $atts['content'];
		$link    = $atts['link'];
		$icon    = $atts['icon'];
		$weight  = $atts['weight'];
		$size    = $atts['size'];
		$align   = $atts['align'];
		$color   = $atts['color'];
		$heading = $atts['heading'];
		$break   = $atts['break'];
		$bg      = $atts['bg'];
		$padding = $atts['padding'];
		$radius  = $atts['radius'];

		// Build HTML.
		$html = sprintf( '<div class="%s" style="text-align:%s">', $classes, $align );
		$html .= $link ? sprintf( '<a href="%s" %s>', $link, apply_filters( 'icon_widget_link_atts', '' ) ) : '';
		$html .= sprintf( '<i class="fa %s fa-%s" style="font-weight:%s;color:%s;background-color:%s;padding:%spx;border-radius:%spx"> </i>', $icon, $size, $weight, $color, $bg, $padding, $radius );
		$html .= $link ? '</a>' : '';
		$html .= apply_filters( 'icon_widget_line_break', $break );
		$html .= sprintf( '<%s class="widget-title">%s</%s>', $heading, $title, $heading );
		$html .= apply_filters( 'icon_widget_wpautop', true ) ? wp_kses_post( wpautop( $content ) ) : wp_kses_post( $content );
		$html .= '</div>';

		return apply_filters( 'icon_widget_html_output', $html );
	}
}
