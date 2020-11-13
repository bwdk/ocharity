<?php

/**
 * Template name: Taxo Pays page filtered
 */
get_header();
?>


<div class="title">
<h1 class="title">Nos actions réussies dans le Pays "<?php single_term_title(); ?>"</h1>
</div>
<main class="main">

    <div class="section__tpl">

        <?php get_sidebar(); ?>

        <?php
        $taxonomy     = 'pays';
        $orderby      = 'name';
        $title        = '';


        $url = 'reussie';


        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'title_li'     => $title,
        );
        ?>

        <?php
        $cats = get_categories($args);

        ?>


        <?php

        $taxo = get_query_var('taxonomy');
        $term = get_query_var('term');
        $statut = get_query_var('statut');

        $args = [
            'post_type' => 'collecte',
            'statut' => $statut,
            'tax_query' => [
                [
                    'taxonomy' => $taxo,
                    'field'    => 'slug',
                    'terms'    => $term,

                ]
            ],
        ];
        $queryAction = new WP_Query($args);

        ?>

        <div class="section__cards__success">
            <?php
            if ($queryAction->have_posts()) :
                while ($queryAction->have_posts()) :
                    $queryAction->the_post();

                    get_template_part('template-parts/collecte/current-successes-summary');

                endwhile;
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>