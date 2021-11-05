<?php

add_shortcode('feedback', 'feedback_shortcode');
function feedback_shortcode($atts, $content)
{
	$whole_content = get_the_content();

	$start_metadata_pos = strpos($whole_content, '[meta');
	$len_metadata = strpos($whole_content, "[/meta]") - $start_metadata_pos;
	$metadata_shortcode = substr($whole_content, $start_metadata_pos, $len_metadata);
	$newstr = substr_replace($metadata_shortcode, " /", $len_metadata - 1, 0);

	$rrrr = shortcode_parse_atts($newstr);
	var_dump($newstr);
	var_dump($rrrr);

	$qsd = shortcode_parse_atts(
		'[soundcloud url="http://api.soundcloud.com/tracks/67658191" params="" width=" 100%" height="166" iframe="true" /]'
	);
	var_dump($qsd); // echo just the URL

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
