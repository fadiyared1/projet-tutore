<?php
/*
Plugin Name: Personalized Support
Plugin URI: 
Description: The plugin allows a personalized support through feedback sliders.
Version: 1.0
Author: F & Q
Author URI: 
Text Domain: simple-spoiler
License: MIT
License URI: 
*/

if (!defined('WPINC')) {
	die;
}

add_action('wp_enqueue_scripts', 'personalized_support_head');
function personalized_support_head()
{
	wp_register_style('personalized_support_style', plugins_url('css/personalized-support.min.css', __FILE__), null, '1.2');
	wp_register_script('personalized_support_script', plugins_url('js/personalized-support.min.js', __FILE__), array('jquery'), '1.2', true);
	wp_enqueue_style('personalized_support_style');
	wp_enqueue_script('personalized_support_script');
}

require_once('admin-page.php');

function fieldset($title_legend, $content)
{
	return '<fieldset class="formSlider">
			<legend class="applicationForm__text">' . $title_legend . '</legend>
				' . $content . '
			</fieldset>';
}

add_shortcode('meta', 'metadata_shortcode');
function metadata_shortcode($atts, $content)
{
	$title = __('Identification', 'personalized-support');

	$content = '<div>
					Test
				</div>';

	return fieldset($title, $content);
}

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
	$title = __('Identification', 'personalized-support');

	$content = '<div>
					<form method="POST" action ="#">
						<label for="numero">Numero</label>
						<input type="text">
						<button type="submit">Login</button>
					</form>
				</div>';

	return fieldset($title, $content);
}

add_shortcode('feedback', 'feedback_shortcode');
function feedback_shortcode($atts, $content)
{
	if (!isset($atts['title'])) {
		$title = __('Feedback', 'personalized-support');
	} else {
		$title = $atts['title'];
	}

	$content = '<div class="__range __range-step">
					<input value="0" type="range" max="4" min="1" step="1" list="ticks1">
					<datalist id="ticks1">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</datalist>
				</div>';

	return fieldset($title, $content);
}
