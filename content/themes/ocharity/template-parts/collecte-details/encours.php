<?php

global $post;
global $wpdb;
// Table wp_donator
$donation_amt_table = $wpdb->prefix . 'donator';
// Table wp_posts
$post_table = $wpdb->prefix . 'posts';

// ID du custom post type en cours
$page_id = $post->ID;

// Calcule la somme des dons pour une collecte en particulier
$sumAmount = $wpdb->get_var("SELECT SUM(amount)
FROM $donation_amt_table
WHERE collecte_id = $page_id"); //page_id équivaut au custom post type en cours


// Calcule le nombre de donations
$sumDonations = $wpdb->get_var("SELECT COUNT(ID)
FROM $donation_amt_table
WHERE collecte_id = $page_id");

// Calcule le pourcentage atteint
$percentage = $sumAmount * 100 / get_field('objectif');

// Enlève les chiffres après la virgule
$percentageReached = floor($percentage);


?>

<main class="main">
  <div class="section__container fundraiser-grid">
    <section class="fundraiser__top">
      <div class="fundraiser__image">
        <?php the_post_thumbnail(); ?>
      </div>
      <div class="raising__text">
        <h2><?php the_title(); ?></h2>
        <p><?php the_content(); ?></p>
      </div>
    </section>
    <section>
      <div class="fundraiser__progress-box">
        <div class="fundraiser__progress-box__bar">
          <p>

            <!-- Affiche le pourcentage atteint en cours pour cette collecte -->
            <?php echo $percentageReached ?>
            %</p>

          <p class="lastp"><?php the_field('objectif'); ?> €</p>
        </div>
        <div class="progress-div">
          <label for="file"></label>
          <!-- Utilisation du pourcentage atteint actuellement pour faire avancer la progress bar -->
          <progress id="file" max="100" value="<?php echo $percentageReached ?>">
            %
          </progress>

          <?php $user_count = $wpdb->get_var("SELECT count('amount') FROM $donation_amt_table");
          ?>

        </div>
      </div>
      <div class="fundraiser__current-state">
        <div class="fundraiser__current-state__donors">
          <!-- Affichage du nombre de donations actuelles -->
          <p class="bold"><?php echo $sumDonations ?></p>
          <p>Donations</p>
        </div>
        <div class="fundraiser__current-state__raised">
          <!-- Affichage de la somme récoltée actuelle -->
          <p class="bold"> <?= $sumAmount == 0 ? 0 : $sumAmount ?> €</p>

          <p>Collectés</p>
        </div>
      </div>


      <?php

      $taxonomy = 'theme';

      $pageState = get_query_var('page_state');
      $login = get_query_var('login');
      $taxo = get_query_var('taxonomy');
      $term = get_query_var('term');

      //. Variables d'Url 
      $urlRegister = 'register';
      $urlLogin = 'login';
      $urlRegistered = 'registered';
      $urlLoggedIn = 'welcome';
      $urlFailed = add_query_arg($urlLogin, 'failed');
      $urlEmpty = add_query_arg($urlLogin, 'empty');

      $args = [
        'post_type' => 'collecte',
        'page_state' => $pageState,
        'login' => $login,
        'tax_query' => array(
          array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $term,
          ),
        ),
      ];
      $queryPageState = new WP_Query($args);
      ?>
      <div class="raising__form formdiv">




        <?php
        if (!is_user_logged_in() && $queryPageState->query['page_state'] === '') :  ?>
        <?php get_template_part('template-parts/form/buttons'); //-> buttons
        endif;


        if (!is_user_logged_in() && $queryPageState->query['page_state'] ===  $urlLogin) : ?>
          <h2 class="formheading">Me connecter</h2>

        <?php get_template_part('template-parts/form/login');
        endif;


        if (!is_user_logged_in() && $queryPageState->query['page_state'] ===  $urlLogin && $queryPageState->query['login'] === $urlFailed) :  ?>
          <h2 class="formheading">Me connecter</h2>
        <?php get_template_part('template-parts/form/login');

        endif;

        if (!is_user_logged_in() && $queryPageState->query['page_state'] ===  $urlLogin && $queryPageState->query['login'] === $urlEmpty) : ?>
          <h2 class="formheading">Me connecter</h2>
        <?php get_template_part('template-parts/form/login');
        endif;

        if (!is_user_logged_in() && $queryPageState->query['page_state'] ===  $urlRegister) : ?>
          <h2 class="formheading">M'inscrire</h2>
        <?php get_template_part('template-parts/form/register');
        endif;

        if (!is_user_logged_in() && $queryPageState->query['page_state'] ===  $urlLoggedIn) : ?>
          <h2 class="formheading">Me connecter</h2>
        <?php get_template_part('template-parts/form/login');
        endif;

        if (is_user_logged_in()) : ?>
          <h2 class="formheading">Faire une promesse de don</h2>
        <?php get_template_part('template-parts/form/donate-form');
        endif;

        ?>
        <!-- <?php dump($queryPageState);
              dump($_SERVER);
              dump($urlFailed);
              ?> -->


      </div>

    </section>
  </div>
</main>