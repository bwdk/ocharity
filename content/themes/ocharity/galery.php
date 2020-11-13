<?php
/*
Template Name: Galerie temp 
*/

get_header()
?>

<div class="our-actions-title">
            <div class="our-actions-title__content">
        <h1><?php the_title () ?></h1>
        <p><?php the_excerpt(); ?></p>
        </div>
</div>

<div class="container">
        <div class="gallery">

        <?php
                $args = [
                'post_type' => 'galerie',
                'posts_per_page' => 9,

        ]; ?>

<?php 
$queryGallery = new WP_Query($args) ;
if ( $queryGallery ->have_posts()) : while ($queryGallery->have_posts() ) : $queryGallery->the_post(); ?>

<?php get_template_part('template-parts/img-gallery'); ?>

<?php endwhile;
        endif;

        ?>
      </div>
</div>

<?php get_footer(); ?>