<?php get_header();

global $wpdb;
global $post;

// Table wp_donator
$donation_amt_table = $wpdb->prefix . 'donator';
// Table wp_posts
$post_table = $wpdb->prefix . 'posts';
// Table wp_terms
$terms_table = $wpdb->prefix . 'terms';

// ID du custom post type en cours
$page_id = $post->ID;

// Calcule la somme des dons pour toutes les collecte 
$sumAmount = $wpdb->get_var("SELECT SUM(amount)
FROM $donation_amt_table"); //page_id équivaut au custom post type en cours

// Calcule le nombre de collectes
$sumCollectes = $wpdb->get_var("SELECT COUNT(DISTINCT(collecte_id))
FROM $donation_amt_table");

// Calcule le nombre de dons
$sumDonations = $wpdb->get_var("SELECT *
FROM $donation_amt_table");

// Calcule le pourcentage atteint
$sumCollectDone = $wpdb->get_var("SELECT count(*) FROM $terms_table WHERE slug = 'reussie'");

// Enlève les chiffres après la virgule
//$percentageReached = floor($percentage);

?>


<div class="hero__frontpage" style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/slide-5.png');">

  <div class="hero-title">
    <h2>Soutenez nos actions en cours</h2>
    <p>O'Charity est une association caritative qui intervient dans différents pays et sur différents champs d'actions. Découvrez la liste de nos actions en cours.</p>
  </div>

  <section class="calltoaction">
    <a href="<?php echo get_permalink(get_page_by_path('actions-en-cours')); ?>" class="action-button">
      Voir nos actions
    </a>
  </section>

</div>

<main class="main__frontpage">

  <div class="text-title" style="background-color:#f3fafa;">
    <h2>Contribuez à nos collectes en cours</h2>
    <p>Nous avons plusieurs collectes en cours qui nécessitent des dons. </p>
  </div>

  <div class="theme">
    <?php
    $taxonomy     = 'theme';
    $orderby      = 'name';
    $title        = '';

    $url = 'en-cours';

    $args = [
      'taxonomy'     => $taxonomy,
      'orderby'      => $orderby,
      'title_li'     => $title,
    ]
    ?>



    <?php
    //On définit une requête qui permet d'afficher les éléments de la catégorie "en cours" avec un affichage de 4 posts par page
    $args = [
      'post_type' => 'collecte',
      'posts_per_page' => 3,
      'tax_query' => array(
        array(
          'taxonomy' => 'statut',
          'field' => 'slug',
          'terms' => 'en-cours',
        ),

      ),
    ];
    ?>


    <?php

    $wpqueryCollectesReussies = new WP_Query($args);
    ?>
  </div>

  <div class="section__tpl">
    <div class="section__cards__actions">
      <?php

      //On créé une boucle permettant d'afficher l'ensemble des collectes ayant le statut réussi

      if ($wpqueryCollectesReussies->have_posts()) :
        while ($wpqueryCollectesReussies->have_posts()) :
          $wpqueryCollectesReussies->the_post();
          if (has_term('en-cours', 'statut')) :
            get_template_part('template-parts/collecte/current-actions-summary');
          endif;
        endwhile;
      endif;
      ?>

    </div>
  </div>

</main>

<section class="calltoaction" style="background-color:#f3fafa;">

  <a href="<?php echo get_permalink(get_page_by_path('actions-en-cours')); ?>" class="action-button">
    Voir tout
  </a>

</section>



<div class="map-container">
  <div class="text-title" style="background-color:#fff;">
    <h2>Nos actions dans le monde</h2>
    <p>Découvrez les différents pays dans lesquels nous intervenons.</p>
  </div>
  <div id="map">
    <div class="img-container">
      <img class="world-pic" src="<?php echo get_template_directory_uri(); ?>/public/images/ocharity-map.svg">
    </div>
    <div id="dots">
      <div class="dot dot-1" title="Maroc"></div>
      <div class="dot dot-2" title="Sénégal"></div>
      <div class="dot dot-3" title="Canada"></div>
      <div class="dot dot-4" title="Liban"></div>
      <div class="dot dot-5" title="Brésil"></div>
      <div class="dot dot-6" title="France"></div>
      <div class="dot dot-7" title="Chine"></div>
      <div class="dot dot-8" title="Indonésie"></div>
      <div class="dot dot-9" title="Madagascar"></div>
      <div class="dot dot-10" title="Inde"></div>
      <div class="dot dot-11" title="Australie"></div>
    </div>
  </div>
</div>


<section class="about-counter" style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/slide-2-counter.png');">
  <ul id="counter">
    <li>
      +<span class="count percent" data-count="250">
        0
      </span>
      <h1>Volontaires</h1>
    </li>
    <li>
      <span class="count percent" data-count="<?= $sumDonations == 0 ? 0 : number_format($sumDonations) ?>">
        0
      </span>
      <h1>Nombre de dons</h1>
    </li>
    <li>
      <span class="count percent" data-count="<?= $sumAmount ?>">
      </span>
      <h1>Euros récoltés</h1>
    </li>
    <li>
      <span class="count percent" data-count="<?= $sumCollectDone ?>">
        0
      </span>
      <h1>Projets réussis</h1>
    </li>
  </ul>
  <span class="call-toaction">
    <a href="#" class="action-button" style="margin-right: 30px;">
      Faire un don
    </a>
    <a href="#" class="action-button-linear">
      Devenir bénévole
    </a>
  </span>
</section>



<?php get_footer(); ?>