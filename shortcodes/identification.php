<?php

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = __('Identification', 'personalized-support');

    $content = '<div>
    <form method="POST" action="#">
        <label for="numero">Numero</label>
        <input type="text">
        <button type="submit">Login</button>
    </form>
</div>';

    return fieldset($title, $content);
}
