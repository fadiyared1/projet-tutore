<?php

if (!defined('WPINC')) {
	die;
}

add_action('admin_menu', 'personalized_support_menu');
function personalized_support_menu()
{
	add_menu_page(__('Plugin Personalized Support', 'personalized-support'), 'Personalized Support', 'manage_options', 'personalized-support', 'personalized_support_menu_output');
}

function field_separator()
{
	return ',';
}

function personalized_support_menu_output()
{
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="#" method="POST">
			<div>Numéros des étudiants à rentrer, séparateur de champ : <?php echo field_separator() ?></div>
			<input type="text" size="50">
			<button type="submit">Enregistrer les numéros</button>
		</form>
	</div>
<?php
}