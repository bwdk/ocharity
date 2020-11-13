<?php

/** Template Name: Collectes reussies2 */
get_header()
?>


    <section class="main-collect">

        <div class="our-actions-title">
            <div class="our-actions-title__content">
                <h1><?php the_title() ?></h1>
                <p><?php the_excerpt(); ?></p>
            </div>
        </div>
        <div class="activities-boxes">
        <?php
        $args = [
            'post_type' => 'collecte',
            'posts_per_page' => 9,
            'tax_query' => array(
                array(
                    'taxonomy' => 'statut',
                    'field'    => 'slug',
                    'terms'    => 'reussie',
                ),
            ),
            // 'category__not_in' => 2
        ];

        $wpqueryCollectesEnCours = new WP_Query($args);

        if ($wpqueryCollectesEnCours->have_posts()) : while ($wpqueryCollectesEnCours->have_posts()) : $wpqueryCollectesEnCours->the_post();

                get_template_part('template-parts/collecte/current-action-summary');

            endwhile;

            
        endif;

        ?>



<?php get_footer()?>