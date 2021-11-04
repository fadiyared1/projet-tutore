<?php

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = __('Identification', 'personalized-support');

    $content = "";
    if (isset($_POST['numeros'])) {
        $content = $_POST['numeros'];
    } else {
        $content = '<div>
                        <form method="POST" action="">
                            <label for="numero">Numero</label>
                            <input type="text" name="numeros">
                            <button type="submit">Login</button>
                        </form>
                    </div>';
    }


    return fieldset($title, $content);
}
