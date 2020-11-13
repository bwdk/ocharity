<?php

get_header();



$post = $wp_query->post;

    if ( has_term('en-cours', 'statut') ) {
        get_template_part('template-parts/collecte/collecte-encours');
    } else {
        get_template_part('template-parts/collecte/collecte-reussie');
    }

get_footer();