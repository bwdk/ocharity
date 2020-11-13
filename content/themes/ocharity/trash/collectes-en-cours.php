<?php

/** Template Name: Collectes en cours */
get_header()
?>

<div class="our-actions-title">
        <div class="our-actions-title__content">
        <h1><?php the_title() ?></h1>
        <p><?php the_excerpt(); ?></p>
        </div>
    </div>
    <div class="theme">

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
                'terms'    => 'en-cours',
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
</div>
</section>


<div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
      </div> -->

<section class="main-activities section">
    <div class="section__container">
        <h1><?php the_title(); ?></h1>

        <div class="activities-box">
            <div class="content">
                <span class="content--icon"><i class="fa fa-tint" aria-hidden="true"></i></span>
                <h3>Lorem ipsum</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            </div>
            <div class="content">
                <span class="content--icon"><i class="fa fa-tint" aria-hidden="true"></i></span>
                <h3>Lorem ipsum</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            </div>
            <div class="content">
                <span class="content--icon"><i class="fa fa-tint" aria-hidden="true"></i></span>
                <h3>Lorem ipsum</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            </div>
            <div class="content">
                <span class="content--icon"><i class="fa fa-tint" aria-hidden="true"></i></span>
                <h3>Lorem ipsum</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>