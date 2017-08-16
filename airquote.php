<?php
/*
Plugin Name: So-Called Air Quotes
Plugin URI: http://davidmacdonaldmusic.com
Description: This plugin allows you to show "air quote" icons in your site. This uses embeded fonts to match your site's built-in styles as easily as possible; but, it may not work in some older browsers. To use, simply place text inside the aq shortcode like [aq]this[/aq]. You can add a special style attribute for [aq style=open]open air quote icons[/aq] like this.
Author: David MacDonald
Version: 0.1
Author URI: https://leftuseless.net
*/


// Add a span to style
function aq_quote_this($atts, $content=null) {
	extract(shortcode_atts(array(
		'style' => 'filled',
	), $atts));

	if ($content != null){
		$return_string = '<span class="airquote ' . $style . '">' . $content . '</span>';
	}

	return $return_string;

}

// register the shortcode
function register_shortcodes(){
	add_shortcode('aq','aq_quote_this');
}

// add shortcodes
add_action( 'init', 'register_shortcodes' );

// allow shortcodes in widgets, comments, and excerpts as well!
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'comment_text', 'do_shortcode' );
add_filter( 'the_excerpt', 'do_shortcode');

// Put the style in to do something with the special spans
function add_aq_styles() {
	wp_register_style( 'prefix-style', plugins_url('/assets/style.css', __FILE__) );
	wp_enqueue_style( 'prefix-style' );
}

add_action( 'wp_enqueue_scripts', 'add_aq_styles' );

?>
