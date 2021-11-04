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
	global $post;
	wp_register_style('personalized_support_style', plugins_url('css/personalized-support.min.css', __FILE__), null, '1.2');
	wp_register_script('personalized_support_script', plugins_url('js/personalized-support.min.js', __FILE__), array('jquery'), '1.2', true);
	wp_enqueue_style('personalized_support_style');
	wp_enqueue_script('personalized_support_script');
}


add_action('admin_menu', 'personalized_support_menu');
function personalized_support_menu()
{
	add_menu_page(__('Plugin Personalized Support', 'personalized-support'), 'Personalized Support', 'manage_options', 'personalized-support', 'personalized_support_menu_output');
}

function personalized_support_menu_output()
{
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="#" method="POST">
			<label for="numero">Numeros</label>
			<input type="text" size="50">
			<button type="submit">Enregistrer les numeros</button>
		</form>
	</div>
<?php
}

function authentication_shortcode($atts, $content)
{
	$title = __('Authentification', 'personalized-support');

	return
		'<fieldset class="formSlider">
			<legend class="applicationForm__text">' . $title . '</legend>
			<div>
				<form method="POST" action ="#">
					<label for="numero">Numero</label>
					<input type="text">
					<button type="submit">Login</button>
				</form>
			</div>
		</fieldset>';
}
add_shortcode('authentication', 'authentication_shortcode');

function feedback_shortcode($atts, $content)
{
	if (!isset($atts['title'])) {
		$title = __('Feedback', 'personalized-support');
	} else {
		$title = $atts['title'];
	}

	return
		'<fieldset class="formSlider">
			<legend class="applicationForm__text">' . $title . '</legend>
			<div class="__range __range-step">
				<input value="3" type="range" max="4" min="1" step="1" list="ticks1">
				<datalist id="ticks1">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
	  				<option value="4">4</option>
				</datalist>
			</div>
  		</fieldset>';
}
add_shortcode('feedback', 'feedback_shortcode');
