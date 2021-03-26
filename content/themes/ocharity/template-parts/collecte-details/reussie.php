<?php

global $wpdb;
global $post;
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
$sumDonations = $wpdb->get_var("SELECT COUNT(DISTINCT(donor_id))
FROM $donation_amt_table
WHERE collecte_id = $page_id");

//dump($page_id);
?>

<main class="main">
  <div class="section__container fundraiser-grid">
    <section class="fundraiser__top">
      <div class="fundraiser__image">
        <?php the_post_thumbnail(); ?>
      </div>
    </section>

    <section>
      <div class="fundraiser__success-box">
        <div class="raising__text">
          <h2><?php the_title(); ?></h2>
          <p class="excerpt"><?php the_excerpt(); ?></p>
          <div class="action-data">

            <p class="data">Domaine d'intervention : <span> <?php the_terms($post->ID, 'theme'); ?> </span></p>

            <p class="data">Lieu de l'action : <span> <?php the_terms($post->ID, 'pays'); ?> </span></p>

            <p class="data">Année : <span> <?php the_field('date_de_creation'); ?> </span></p>

            <p class="data">Montant récolté : <span><?php the_field('objectif'); ?></span></p>

            <p class="data" id="nbDon">Nombre de donateurs : <span><?php echo $sumDonations ?></span></p>
          </div>
        </div>
        <div class="button">
          <a href="<?= get_permalink(get_page_by_path('actions-reussies')); ?>" class="action-button">Retour aux réussites</a>
        </div>
      </div>
    </section>
  </div>

</main>