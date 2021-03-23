<?php

/** Template Name: Collectes reussies */
get_header();
global $post;

?>

<div class="title">
    <h1 class="h1">Nos réussites</h1>
</div>


<main class="main">
    <div class="success__theme">
        <?php
        $taxonomy     = 'theme';
        $orderby      = 'name';
        $title        = '';

        $url = 'reussie';

        $args = [
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'title_li'     => $title,
        ]
        ?>


        <?php
        $cats = get_categories($args);
        ?>


        <?php foreach ($cats as $cat) : ?>
            <a href="<?php echo esc_url(add_query_arg('statut',  $url, home_url('theme/' . $cat->slug . ''))) ?>" class="cat__list"><?= $cat->name ?></a>
        <?php endforeach; ?>


        <?php
        //On définit une requête qui permet d'afficher les éléments de la catégorie "en cours" avec un affichage de 9 posts par page
        $args = [
            'post_type' => 'collecte',
            'posts_per_page' => 9,
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
        <?php get_sidebar(); ?>

        <?php

        $args = [
            'post_type' => 'collecte',
            'posts_per_page' => 9,
            'tax_query' => array(
                array(
                    'taxonomy' => 'statut',
                    'field' => 'slug',
                    'terms' => 'reussie',
                ),
            ),
        ];
        ?>

        <?php
        $wpqueryCollectesReussies = new WP_Query($args);
        ?>

        <div class="section__cards__success">
            <?php
            if ($wpqueryCollectesReussies->have_posts()) :
                while ($wpqueryCollectesReussies->have_posts()) :
                    $wpqueryCollectesReussies->the_post();

                    get_template_part('template-parts/collecte/current-successes-summary');

                endwhile;
            endif;
            ?>
        </div>
    </div>
</main>


<?php get_footer(); ?>