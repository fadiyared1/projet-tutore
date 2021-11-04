<?php

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = localize('Identification');

    $html = "";

    $numero = "numero";

    $logged = session_id();
    if ($logged && isset($_SESSION[$numero]))
    {
        $content = '<div>
                        Connecté avec le numéro ' . $_SESSION[$numero] . '
                    </div>';

        $html = fieldset($title, $content);
    }
    else
    {
        if (isset($_POST[$numero]))
        {
            start_session_wp();
            $_SESSION[$numero] = $_POST[$numero];
        }
        else
        {
            $content = '<div>
                            <form method="POST" action="">
                                <label for="' . $numero . '">Numero</label>
                                <input type="text" name="' . $numero . '">
                                <button type="submit">Login</button>
                            </form>
                        </div>';

            $html = fieldset($title, $content);
        }
    }

    return $html;
}
