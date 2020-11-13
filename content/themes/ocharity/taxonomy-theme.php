<?php

/**
 * Template name: Taxo Theme page filtered
 */
get_header();
?>


 

<div class="title">
<?php if (has_term('en-cours', 'statut')) : ?>
        <h1 class="title">Nos actions en cours dans le thème "<?php single_term_title(); ?>"</h1>
    <?php else : ?>
        <h1 class="title">Nos actions réussies dans le thème "<?php single_term_title(); ?>"</h1>
    <?php endif; ?>
    </div>
<main class="main">

    <div class="theme">


        <?php
        $taxonomy     = 'theme';
        $orderby      = 'name';
        $title        = '';

        // Checking if current page has a taxonomy "en-cours" or "reussie"
        if (has_term('en-cours', 'statut')) :
            $url = 'en-cours';
        else :
            $url = 'reussie';
        endif;

        // Add arguments to get_categories function
        // to uses them in a custom URL
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'title_li'     => $title,
        );
        ?>

        <?php
        $cats = get_categories($args);
        ?>

        <!-- Custom URL for filtering by "status" -->
        <?php foreach ($cats as $cat) : ?>
            <a href="<?php echo esc_url(add_query_arg('statut',  $url, home_url('theme/' . $cat->slug . ''))) ?>" class="cat__list"><?= $cat->name ?></a>
        <?php endforeach; ?>


        <?php

        //

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


    </div>
    <div class="section__tpl">
        <div class="section__cards__actions">
            <?php
            //On va chercher la page de template permettant l'affichage de l'ensemble des collectes en fonction du statut
            if ($queryAction->have_posts()) :
                while ($queryAction->have_posts()) :
                    $queryAction->the_post();
                    if (has_term('reussie', 'statut')) :
                        get_template_part('template-parts/collecte/current-successes-summary');
                    else :
                        get_template_part('template-parts/collecte/current-actions-summary');

                    endif;
                endwhile;
            endif;
            ?>

        </div>
    </div>

</main>

<?php get_footer(); ?>