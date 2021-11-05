<?php

class Metadata
{
    const activite = "activite";
    const cours = "cours";

    static function is_valid($atts)
    {
        return !empty($atts[Metadata::activite]) && !empty($atts[Metadata::cours]);
    }
}

add_shortcode('meta', 'metadata_shortcode');
function metadata_shortcode($atts, $content)
{
    var_dump("metadata_shortcode");

    if (Metadata::is_valid($atts))
    {
        $activite = $atts[Metadata::activite];
        $cours = $atts[Metadata::cours];

        return '';
    }
    else
    {
        return '<div class="notice notice-error">
                <p>Balise metadata incorrecte, les attributs activite et cours doivent avoir des valeurs non nulles.</p>
            </div>';
    }
}
