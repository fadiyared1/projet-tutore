<?php

class Identification
{
    const NUMERO = "numero";
}

function login_form_html($title)
{
    $login = Localisation::get('Se connecter');

    $numero_str = Identification::NUMERO;

    $content = '<div>
                    <form method="POST" action="">
                        <label for="' . $numero_str . '">Numero</label>
                        <input type="text" name="' . $numero_str . '">
                        <button type="submit">' . $login . '</button>
                    </form>
                </div>';

    $html = HtmlGen::fieldset($title, $content);

    return $html;
}

function logout_form_html($title, $numero)
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

    $html = "";

    $user_numero = User::get_numero();

    $is_user_logged = isset($user_numero);
    if ($is_user_logged)
    {
        $is_user_logging_out = isset($_POST['logout']);
        if ($is_user_logging_out)
        {
            User::set_numero(null);

            $html = login_form_html($title);
        }
        else
        {
            $html = logout_form_html($title, $user_numero);
        }
    }
    else
    {
        $posted_numero = $_POST[Identification::NUMERO];
        $is_user_trying_to_login = isset($posted_numero);
        if ($is_user_trying_to_login)
        {
            // check if numero is in DB.

            User::set_numero($posted_numero);
        }
        else
        {
            $html = login_form_html($title);
        }
    }

    return $html;
}
