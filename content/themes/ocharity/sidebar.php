<aside class="sidebar">
    <?php
    $url = 'reussie';

    $theme = [
        'taxonomy'     => 'theme',
        'orderby'      => 'name',
        'title_li'     => '<h2>Thèmes</h2>',
    ];

    $taxTheme = get_categories($theme);
    ?>

    <h4 class="sidebar__title">Thèmes</h4>
    <?php
    foreach ($taxTheme as $cat) :  ?>
        <ul class="sidebar__list">
            <li><a href="<?php echo esc_url(
                                add_query_arg('statut',  $url, home_url('theme/' . $cat->slug . ''))
                            ) ?>"><?= $cat->name ?></a></li>
        </ul>
    <?php endforeach; ?>

    
    <?php
    $pays = [
        'taxonomy'     => 'pays',
        'orderby'      => 'name',
        'title_li'     => '<h2>Pays</h2>',
    ];

    $taxPays = get_categories($pays);
    ?>

    <h4 class="sidebar__title">Pays</h4>
    <ul class="sidebar__list">
        <?php
        foreach ($taxPays as $cat) :  ?>
            <ul class="sidebar__list">
                <li><a href="<?php echo esc_url(
                                    add_query_arg('statut',  $url, home_url('pays/' . $cat->slug . ''))
                                ) ?>"><?= $cat->name ?></a></li>
            </ul>
        <?php endforeach; ?>
    </ul>
</aside>



