<?php
/*
Template Name: Formulaire de recherche
*/

get_header()
?>


<section class="main-activities section">
    <div class="section__container">
    <h3>Résultats pour la recherche: <?php echo "$s"; ?> </h3>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" class="posts">
                    <article>

                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php the_excerpt(); ?></p>
                        <p align="right"><a href="<?php the_permalink(); ?>">Afficher plus</p>
                        <span class="post-meta"> Publié par <?php the_author(); ?>
                            | Date : <?php echo date('j m Y'); ?></span>

                    </article><!-- #post -->
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

</section>


<?php get_footer(); ?>