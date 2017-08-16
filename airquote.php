<?php
/*
Plugin Name: So-Called Air Quotes
Description: This plugin allows you to show "air quote" icons in your site.
Author: David MacDonald
Version: 0.1
Author URI: https://leftuseless.net
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
*/


// Add a span to style
function aq_quote_add_this($atts, $content=null) {
	extract(shortcode_atts(array(
		'style' => 'filled',
	), $atts));

	if ($content != null){
		$return_string = '<span class="airquote ' . $style . '">' . $content . '</span>';
	}

	return $return_string;

}

// register the shortcode
function aq_quote_register_shortcodes(){
	add_shortcode('aq','aq_quote_add_this');
}

// add shortcodes
add_action( 'init', 'aq_quote_register_shortcodes' );

// allow shortcodes in widgets, comments, and excerpts as well!
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'comment_text', 'do_shortcode' );
add_filter( 'the_excerpt', 'do_shortcode');

// Put the style in to do something with the special spans
function aq_quote_add_aq_styles() {
	wp_register_style( 'prefix-style', plugins_url('/assets/style.css', __FILE__) );
	wp_enqueue_style( 'prefix-style' );
}

add_action( 'wp_enqueue_scripts', 'aq_quote_add_aq_styles' );

?>
