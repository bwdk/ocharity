<?php

/** Template Name: Collectes en cours */
get_header();

global $post;
?>


<div class="title" style="background-image: <?php echo get_template_directory_uri(); ?>/public/images/header_title.jpg">
    <h1 class="h1">Nos actions</h1>
</div>

<main class="main">
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
        $cats = get_categories($args);
        ?>


        <?php foreach ($cats as $cat) : ?>
            <a href="<?php echo esc_url(add_query_arg('statut',  $url, home_url('theme/' . $cat->slug . ''))) ?>" class="cat__list"><?= $cat->name ?></a>
        <?php endforeach; ?>


        <?php
        //On définit une requête qui permet d'afficher les éléments de la catégorie 
        //"en cours" 
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

        $wpqueryCollectesEncours = new WP_Query($args);
        ?>
    </div>
    <div class="section__tpl">
        <div class="section__cards__actions">
            <?php

            //On créé une boucle permettant d'afficher l'ensemble des collectes ayant le statut en cours

            if ($wpqueryCollectesEncours->have_posts()) :
                while ($wpqueryCollectesEncours->have_posts()) :
                    $wpqueryCollectesEncours->the_post();
                    if (has_term('en-cours', 'statut')) :
                        get_template_part('template-parts/collecte/current-actions-summary');
                    endif;
                endwhile;
            endif;
            ?>

        </div>
    </div>

</main>

<?php get_footer(); ?>