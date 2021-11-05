<?php

class Feedback
{
	const item = "item";

	static $table_name = "";

	static function init()
	{
		global $wpdb;
		Feedback::$table_name = $wpdb->prefix . 'ps_feedbacks';

		Feedback::maybe_create_table();
	}

	static function maybe_create_table()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$table_name = Feedback::$table_name;
		$activite = Metadata::activite;
		$cours = Metadata::cours;
		$item = Feedback::item;

		$create_feedbacks_table_sql =
			"CREATE TABLE {$table_name}
			(
				id int(16) NOT NULL auto_increment primary key,
				user_numero varchar(16) NOT NULL,
				{$activite} varchar(16) NOT NULL,
				{$cours} varchar(16) NOT NULL,
				{$item} int(16) NOT NULL,
				INDEX user_index(user_id)
			)";

		maybe_create_table($table_name, $create_feedbacks_table_sql);
	}

	static function is_valid($atts)
	{
		return !empty($atts[Feedback::item]);
	}
}


add_shortcode('feedback', 'feedback_shortcode');
function feedback_shortcode($atts, $content)
{
	if (PSUser::has_valid_numero())
	{
		if (Feedback::is_valid($atts))
		{
			$metadata_attributes = Metadata::get_current_attributes();
			if (Metadata::is_valid($metadata_attributes))
			{
				$activite = $metadata_attributes[Metadata::activite];
				$cours = $metadata_attributes[Metadata::cours];
				$item = $atts[Feedback::item];

				if (!isset($atts['title']))
				{
					$title = Localisation::get('Feedback');
				}
				else
				{
					$title = $atts['title'];
				}

				$data_prefix = 'data-';

				$content =
					'<div class="__range __range-step">
					<input value="0" type="range" max="4" min="1" step="1" list="range-list">
					<datalist id="range-list" ' .
					$data_prefix . Metadata::activite . "={$activite}" .
					$data_prefix . Metadata::cours . "={$cours}" .
					$data_prefix . Feedback::item . "={$item}" .
					'>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</datalist>
					</div>';

				return HtmlGen::fieldset($title, $content);
			}
		}
		else
		{
			return '<div class="notice notice-error">
						<p>Balise feedback incorrecte, l\'attribut item doit avoir une valeur non null. 
						Exemple d\' une balise correcte : [feedback item="1"][\\feedback]</p>
            		</div>';
		}
	}

	return '';
}
