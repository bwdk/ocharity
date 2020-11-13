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
$sumDonations = $wpdb->get_var("SELECT COUNT(ID)
FROM $donation_amt_table
WHERE collecte_id = $page_id");

// Calcule le pourcentage atteint
$percentage = $sumAmount * 100 / get_field('objectif');

// Enlève les chiffres après la virgule
$percentageReached = floor($percentage);
?>


<div class="card">
  <a href="#"><img src="<?php the_post_thumbnail_url(); ?>" alt="" class="card__img"></a>
  <label for="file"></label>
  <progress id="file" max="100" value="<?php echo $percentageReached ?>" class="progressbar"> 70% </progress>

  <div class="card__info">
  <div class="campaign-information">
    <div class="campaign-raised">
      <span class="campaign-title">Collectés</span> <br>
      <span class="campaign-amount"><?= $sumAmount == 0 ? 0 : number_format($sumAmount) ?> €</span>
    </div>
    <div class="funded">
      <span class="funded-percent"><?php echo $percentageReached ?> %</span>
    </div>
    <div class="campaign-goal">
      <span class="campaign-title">Objectif</span><br>
      <span class="campaign-amount"><?php number_format(the_field('objectif')); ?> €</span>
    </div>
  </div>
    <h1 class="card__title"><?php the_title(); ?></h1>
    <p class="card__text">
      <!-- <?= substr(get_the_excerpt(), 0, strpos(get_the_excerpt(), ' ', 30)) . " ..."; ?>
    </p> -->
      <a href="<?php the_permalink() ?>" class="card__action-button">Faire un don</a>
  </div>
</div>