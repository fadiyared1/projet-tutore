<?php

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
