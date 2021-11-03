<?php
/*
Plugin Name: Personalized Support
Plugin URI: https://webliberty.ru/simple-spoiler/
Description: The plugin allows to create simple spoilers with shortcode.
Version: 1.0
Author: Webliberty
Author URI: https://webliberty.ru/
Text Domain: simple-spoiler
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}



function vector($atts, $content) {
	if ( ! isset($atts['title']) ) {
		$sp_name = __( 'Feedback', 'simple-spoiler' );
	} else {
		$sp_name = $atts['title'];
	}
	return '    <fieldset class="formSlider">
	<legend class="applicationForm__text">Feedback</legend>
	<div class="__range __range-step">
	<input value="3" type="range" max="4" min="1" step="1" list="ticks1">
	<datalist id="ticks1">
	  <option value="1">pas assimilé</option>
	  <option value="2">réussite ou compréhension fragile</option>
	  <option value="3">bien compris mais besoin</option>
	  <option value="4">complètement maitrisé</option>
	</datalist>
</div>
  </fieldset>';
}
add_shortcode( 'vector', 'vector' );

add_action( 'wp_enqueue_scripts', 'simple_spoiler_head' );
function simple_spoiler_head() {
	global $post;
	wp_register_style( 'simple_spoiler_style', plugins_url( 'css/simple-spoiler.min.css', __FILE__ ), null, '1.2' );
	wp_register_script( 'simple_spoiler_script', plugins_url( 'js/simple-spoiler.min.js', __FILE__ ), array( 'jquery' ), '1.2', true );
		wp_enqueue_style( 'simple_spoiler_style' );
		wp_enqueue_script( 'simple_spoiler_script' );
}