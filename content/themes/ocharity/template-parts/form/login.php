<?php

$page_state = get_query_var('page_state');
$login = get_query_var('login');

$args = [
    'page_state' => $page_state,
    'login' => $login
];
$queryDonate = new WP_Query($args);

if (($queryDonate->query_vars['page_state']) == 'login' &&  ($queryDonate->query_vars['login']) == 'failed') :

?>

    <div class="message__fail">
        <p>Vos identifiants sont erronés</p>
    </div>


<?php
elseif (isset($_GET['login']) && $_GET['login'] == 'empty') :
?>

    <div class="message__fail">
        <p>Renseignez vos identifiants</p>
    </div>

    <?php dump($login); ?>

<?php
elseif (($queryDonate->query_vars['page_state']) == 'registered') : ?>
    <div class="message__success">
        <p>Votre compte est créé ! Vous pouvez vous connecter</p>
    </div>
<?php
elseif ($_SERVER['QUERY_STRING'] !== 'login?login=failed' && $_SERVER['QUERY_STRING'] !== 'registered') :


?>

<?php
endif; ?>

<p class="raising__form__text">Connectez-vous pour faire une promesse de don</p>

<?php

if (!is_user_logged_in()) {

    wp_login_form();

}

?>

<p class="raising__form__text--subtn">Je n'ai pas de compte</p>
<a href="<?php echo esc_url(add_query_arg('page_state',  'register', get_page_link())) ?>" class="action-button raising__form__block--btn">M'inscrire
</a>