<?php

get_header();
global $wp_roles, $errormsg;


$errormsg = new WP_Error();

$method = $_REQUEST;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $password = $method['password'];
    $username = $method['username'];
    $email = $method['email'];

    $username = esc_sql($method['username']);
    if (strpos($username, ' ') !== false) {
        $errormsg->add('username', '<div class="message__fail">Attention il y a des espaces dans le nom d\'utilisateur</div>');
    }
    if (empty($name)) {
        $errormsg->add('username', '<div class="message__fail">Veuillez renseigner un nom d\'utilisateur</div>');
    } elseif (username_exists($name)) {
        $errormsg->add('username', 'Le nom d\'utilisateur existe déja');
    }

    $email = esc_sql($_REQUEST['email']);
    if (!is_email($email)) {
        $errormsg->add('email', '<div class="message__fail">Renseigner un email valide</div>');
    } elseif (email_exists($email)) {
        $errormsg->add('email', '<div class="message__fail">Cet email existe déja</div>');
    }

    $password = esc_sql($_REQUEST['password']);
    if (empty($password)) {
        $errormsg->add('password', '<div class="message__fail">Mot de passe obligatoire</div>');
    }

    if (isset($method['password'])) {
        if ($errormsg->get_error_message()) {
            echo $errormsg->get_error_message();
        } else {


            $userId = wp_insert_user(
                [
                    'user_login'  => $username,
                    'user_pass' => $password,
                    'user_email'  => $email,
                    'role' => 'donator'
                ]
            );

            $urlParam = 'registered';
            $url_redirect = esc_url(add_query_arg('page_state',  $urlParam, get_permalink()));
            echo "<script>location.href = '$url_redirect';</script>";
            exit;
        }
    }
}


?>


<p class="raising__form__text">Vous devez être inscrit pour faire une promesse de don</p>

<form id="register_form" action="" method="post" enctype="multipart/form-data">
    <div class="field">
        <label for="username">Votre nom:</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="field">
        <label for="email">Votre Adresse email:</label>
        <input type="text" name="email" id="email">
    </div>
    <div class="field">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit" class="action-button">M'inscrire
    </button>
</form>

<p class="raising__form__text">J'ai déja un compte</p>
<a href="<?php echo esc_url(add_query_arg('page_state',  'login', get_page_link())) ?>" class="action-button raising__form__block--btn" id="login-btn">Me connecter
</a>