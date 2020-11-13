<?php get_header(); ?>
<!---On créé une boucle permettant d'aller chercher l'ensemble des articles inclus dans le CPt gallerie--->
<?php $query = new WP_Query( array( 'post-type' => 'galerie' ) ) ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <?php the_post_thumbnail('thumbnail'); ?>
<?php  endwhile;
        endif;

        ?>

<?php get_footer(); ?>