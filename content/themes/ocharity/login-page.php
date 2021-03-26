<?php

/**
 * Template name: Page de connexion
 */
get_header();
?>

<div class="title">
    <h1 class="h1">Connexion</h1>
</div>
<main class="main">

    <div class="section__tpl">
        <div class="section__tpl__block__login-page">
            <h1 class="section__title">Connexion</h1>
            <?php if (isset($_GET['login']) && $_GET['login'] == 'failed') {
            ?>

                <div class="message__fail">
                    <p>Identifiants incorrects</p>
                </div>
            <?php


            } ?>

            <?php if (isset($_GET['login']) && $_GET['login'] == 'empty') {

            ?>

                <div class="message__fail">
                    <p>Renseignez vos identifiants</p>
                </div>

            <?php } ?>



            <div class="raising__form formdiv">

                <?php if (is_user_logged_in()) {
                    $url_redirect = home_url();
                    echo "<script>location.href = '$url_redirect';</script>";
                    exit;
                } else {

                    // wp_login_form();
                    do_shortcode('[wp_login_form_sc]');
                }

                ?>
            </div>
        </div>
    </div>
</main>

<?php

get_footer();

?>