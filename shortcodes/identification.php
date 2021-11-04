<?php

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = __('Identification', 'personalized-support');

    $content = "";

    $input_numeros_name = "numeros";

    if (isset($_POST[$input_numeros_name])) {
        $content = $_POST[$input_numeros_name];
    } else {
        $content = '<div>
                        <form method="POST" action="">
                            <label for="' . $input_numeros_name . '">Numero</label>
                            <input type="text" name="' . $input_numeros_name . '">
                            <button type="submit">Login</button>
                        </form>
                    </div>';
    }

    return fieldset($title, $content);
}
