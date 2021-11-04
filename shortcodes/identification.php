<?php

class Identification
{
    const NUMERO = "numero";
}

function connected_html($title)
{
    $logout = localize('Se deconnecter');

    $content = '<div>
                    Connecté avec le numéro ' . User::get_numero() . '
                    <form method="POST" action="">
                            <button type="submit">' . $logout . '</button>
                    </form>
                </div>';

    $html = fieldset($title, $content);

    return $html;
}

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = localize('Identification');
    $login = localize('Se connecter');

    $html = "";

    $user_numero = User::get_numero();
    if (isset($user_numero))
    {
        $content = '<div>
                        Connecté avec le numéro ' . $user_numero . '
                    </div>';

        $html = fieldset($title, $content);
    }
    else
    {
        $numero_str = Identification::NUMERO;

        $posted_numero = $_POST[$numero_str];
        if (isset($posted_numero))
        {
            User::set_numero($posted_numero);
        }
        else
        {
            $content = '<div>
                            <form method="POST" action="">
                                <label for="' . $numero_str . '">Numero</label>
                                <input type="text" name="' . $numero_str . '">
                                <button type="submit">' . $login . '</button>
                            </form>
                        </div>';

            $html = fieldset($title, $content);
        }
    }

    return $html;
}
