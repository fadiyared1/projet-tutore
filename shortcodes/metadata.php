<?php

add_shortcode('meta', 'metadata_shortcode');
function metadata_shortcode($atts, $content)
{
    $title = __('Identification', 'personalized-support');

    $content = '<div>
                    Test
                </div>';

    return fieldset($title, $content);
}
