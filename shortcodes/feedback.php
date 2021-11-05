<?php

add_shortcode('feedback', 'feedback_shortcode');
function feedback_shortcode($atts, $content)
{
	$whole_content = get_the_content();

	$start_metadata_pos = strpos($whole_content, '[meta');
	$end_metadata_pos = strpos($whole_content, '[\meta]') + 7;
	$metadata_content = substr($whole_content, $start_metadata_pos, $end_metadata_pos);

	$rrrr = shortcode_parse_atts($metadata_content);
	var_dump($metadata_content);
	var_dump($rrrr);

	if (PSUser::has_valid_numero())
	{
		if (!isset($atts['title']))
		{
			$title = Localisation::get('Feedback');
		}
		else
		{
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

		return HtmlGen::fieldset($title, $content);
	}
	else
	{
		return '';
	}
}
