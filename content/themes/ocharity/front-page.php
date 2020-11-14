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


<div id="carousel" class="carou carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <!-- 
                    If you need more browser support use https://scottjehl.github.io/picturefill/
                    If a picture looks blurry on a retina device you can add a high resolution like this
                    <source srcset="img/blog-post-1000x600-2.jpg, blog-post-1000x600-2@2x.jpg 2x" media="(min-width: 768px)">
                    What image sizes should you use? This can help - https://codepen.io/JacobLett/pen/NjramL
                     -->
      <picture>
        <source srcset="https://dummyimage.com/2000x857/e8faeb/a0ba86.jpg&text=protéger." media="(min-width: 1400px)">
        <source srcset="https://dummyimage.com/1400x500/e8faeb/a0ba86.jpg&text=protéger." media="(min-width: 769px)">
        <source srcset="https://dummyimage.com/800x500/e8faeb/a0ba86.jpg&text=protéger." media="(min-width: 577px)">
        <img srcset="https://dummyimage.com/600x400/e8faeb/a0ba86.jpg&text=protéger." alt="responsive image" class="d-block img-fluid">
      </picture>
    </div>
    <!-- /.carousel-item -->
    <div class="carousel-item">
      <picture>
        <source srcset="https://dummyimage.com/2000x857/e8faeb/a0ba86.jpg&text=accompagner." media="(min-width: 1400px)">
        <source srcset="https://dummyimage.com/1400x500/e8faeb/a0ba86.jpg&text=accompagner." media="(min-width: 769px)">
        <source srcset="https://dummyimage.com/800x500/e8faeb/a0ba86.jpg&text=accompagner." media="(min-width: 577px)">
        <img srcset="https://dummyimage.com/600x400/e8faeb/a0ba86.jpg&text=accompagner." alt="responsive image" class="d-block img-fluid">
      </picture>
    </div>
    <!-- /.carousel-item -->
    <div class="carousel-item">
      <picture>
        <source srcset="https://dummyimage.com/2000x857/e8faeb/a0ba86.jpg&text=contribuer." media="(min-width: 1400px)">
        <source srcset="https://dummyimage.com/1400x500/e8faeb/a0ba86.jpg&text=contribuer." media="(min-width: 769px)">
        <source srcset="https://dummyimage.com/800x500/e8faeb/a0ba86.jpg&text=contribuer." media="(min-width: 577px)">
        <img srcset="https://dummyimage.com/600x400/e8faeb/a0ba86.jpg&text=contribuer." alt="responsive image" class="d-block img-fluid">
      </picture>
    </div>
    <!-- /.carousel-item -->
  </div>
  <!-- /.carousel-inner -->
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- /.carousel -->
<!-- /.container -->
<!-- <div class="text-title">
  <p>Lorem ipsum</p>
  <h2>Lorem ipsum dolor sit amet</h2>
</div>

 <section class="main-activities section">
  <div class="section__container">
    <div class="activities-box">
      <div class="content">
        <span class="content--icon"><img src="<?php echo get_template_directory_uri(); ?>/public/images/animal.svg"></span>
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="content">
        <span class="content--icon"><img src="<?php echo get_template_directory_uri(); ?>/public/images/education.svg"></span>
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="content">
        <span class="content--icon"><img src="<?php echo get_template_directory_uri(); ?>/public/images/environnement.svg"></span>
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="content">
        <span class="content--icon"><img src="<?php echo get_template_directory_uri(); ?>/public/images/eau.svg"></span>
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
  </div>
</section>  -->

<main class="main__frontpage">

  <div class="text-title" style="background-color:#f3fafa;">
    <p>Contribuer</p>
    <h2>Soutenez les collectes en cours</h2>
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
    <p>De par le monde</p>
    <h2>Actions en cours</h2>
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


<section class="about-counter">
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

<section class="main-about-section">

  <div class="section__tpl">





    <div class="about-content">

      <div class="about__img">
        <div class="about__pic">
          <img class="about__pic" src="https://source.unsplash.com/590x360/?children,happy" alt="">
        </div>
        <div class="text-box">
          <div class="about__text">
            <h3 class="text__box__title">Agir
              ensemble</h3>
            <p class="about__text__p">L’aide apportée par les donateurs permet à de nombreuses personnes et<br> associations de finaliser leurs projets.
              Plus qu’un apport financier, votre contribution<br> est l’espoir de voir se concrétiser des rêves d’entreprendre.<br> Participez à l’aventure humaine…

              <div class="text__box__button"><a href="<?php echo get_permalink(get_page_by_path('actions-en-cours')); ?>" class="action-button">Voir plus</a></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<?php get_footer(); ?>