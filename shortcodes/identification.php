<?php

class Identification
{
    const NUMERO = "numero";
}

function connected_html($title, $numero)
{
    $logout = Localisation::get('Se deconnecter');

    $content = '<div>
                    Connecté avec le numéro ' . $numero . '
                    <form method="POST" action="">
                        <button type="submit" name="logout">' . $logout . '</button>
                    </form>
                </div>';

    $html = HtmlGen::fieldset($title, $content);

    return $html;
}

add_shortcode('ident', 'identification_shortcode');
function identification_shortcode($atts, $content)
{
    $title = Localisation::get('Identification');
    $login = Localisation::get('Se connecter');

    $html = "";

    $user_numero = User::get_numero();
    if (isset($user_numero))
    {
        if (isset($_SESSION['logout']))
        {
            User::set_numero(null);
        }
        else
        {
            $html = connected_html($title, $user_numero);
        }
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

            $html = HtmlGen::fieldset($title, $content);
        }
    }

    return $html;
}
