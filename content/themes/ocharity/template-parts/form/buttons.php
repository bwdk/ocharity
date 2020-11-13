<h2 class="formheading">Vous n'êtes pas connecté</h2>
<p class="raising__form__text">Vous devez vous connecter, ou vous inscrire pour faire une promesse de don</p>
<div class="raising__form__block">
    <a href="<?php echo esc_url(add_query_arg('page_state',  'login', get_page_link())) ?>" class="action-button raising__form__block--btn" id="login-btn">Se connecter
    </a>
    <a href="<?php echo esc_url(add_query_arg('page_state',  'register', get_page_link())) ?>" class="action-button raising__form__block--btn">M'inscrire
    </a>
</div>