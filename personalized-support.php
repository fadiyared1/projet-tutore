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

add_action( 'admin_menu', 'simple_spoiler_menu' );
function simple_spoiler_menu() {
	add_menu_page( __( 'Plugin Simple Spoiler', 'simple-spoiler' ), 'Simple Spoiler', 'manage_options', 'simple-spoiler', 'simple_spoiler_menu_output' );
}

function simple_spoiler_menu_output() {
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="options.php" method="POST">
			<?php
				settings_fields( 'option_group' );
				do_settings_sections( 'simple_spoiler_page' );
				submit_button();
			?>
		
		</form>
	</div>
	<?php
}

function sanitize_callback( $options ) { 
	foreach( $options as $name => & $val ) {
		if( $name == 'input' )
			$val = strip_tags( $val );
	}
	return $options;
}

function feedback_shortcode($atts, $content) {
	if ( ! isset($atts['title']) ) {
		$sp_name = __( 'Spoiler', 'simple-spoiler' );
	} else {
		$sp_name = $atts['title'];
	}
	return '<div class="spoiler-wrap">
				<div class="spoiler-head folded">'.$sp_name.'</div>
				<div class="spoiler-body">'.$content.'</div>
			</div>';
}
add_shortcode( 'feedback', 'feedback_shortcode' );

add_action( 'wp_enqueue_scripts', 'simple_spoiler_head' );
function simple_spoiler_head() {
	global $post;
	wp_register_style( 'simple_spoiler_style', plugins_url( 'css/simple-spoiler.min.css', __FILE__ ), null, '1.2' );
	wp_register_script( 'simple_spoiler_script', plugins_url( 'js/simple-spoiler.min.js', __FILE__ ), array( 'jquery' ), '1.2', true );
		wp_enqueue_style( 'simple_spoiler_style' );
		wp_enqueue_script( 'simple_spoiler_script' );
}