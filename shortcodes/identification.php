<?php

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = localize('Identification');

    $content = "";

    $numero = "numero";

    if (isset($_POST[$numero])) {
        $content = $_POST[$numero];
    } else {
        $content = '<div>
                        <form method="POST" action="">
                            <label for="' . $numero . '">Numero</label>
                            <input type="text" name="' . $numero . '">
                            <button type="submit">Login</button>
                        </form>
                    </div>';
    }

    return fieldset($title, $content);
}
