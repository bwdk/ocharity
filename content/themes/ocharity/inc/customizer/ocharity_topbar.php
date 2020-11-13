<?php

function ocharity_topbar($wp_customize) {

    // Télephone
    $wp_customize->add_setting(
        'ocharity_topbar_num',
        [
            'default' => '+33 6 65 65 65 65'
        ]
    );
    $wp_customize->add_control(
        'ocharity_topbar_num',
        [
            'type' => 'text',
            'section' => 'ocharity_topbar',
            'label' => 'Numéro de téléphone',
            'description' => 'Numéro de téléphone affiché dans la barre de menu supérieure'
        ]
    );

    // Email
    $wp_customize->add_setting(
        'ocharity_topbar_email',
        [
            'default' => 'ocharity@ocharity.fr'
        ]
    );
    $wp_customize->add_control(
        'ocharity_topbar_email',
        [
            'type' => 'email',
            'section' => 'ocharity_topbar',
            'label' => 'Adresse email',
            'description' => 'Adresse email affichée dans la barre de menu supérieure'
        ]
    );


    // Activation / désactivation de l'afichage du topbar
    $wp_customize->add_setting('ocharity_topbar_active');

    $wp_customize->add_control(
        'ocharity_topbar_active',
        [
            'type' => 'checkbox',
            'section' => 'ocharity_topbar',
            'label' => 'Activer l\'affichage de la topbar',
            'description' => 'Permet de masquer ou afficher la topbar'
        ]
    );

    // si on désactive le topbar, on désactive le color picker
    if (get_theme_mod('ocharity_topbar_active')):

        // Modification de la couleur du bg du topbar
        $wp_customize->add_setting(
            'ocharity_topbar_bgcolor',
            [
                'default' => '#292f4c'
            ]
        );

        $wp_customize->add_control(
            'ocharity_topbar_bgcolor',
            [
                'type' => 'color',
                'section' => 'ocharity_topbar',
                'label' => 'Couleur de fond du topbar',
                'description' => 'Permet de modifier la couleur de fond du topbar'
            ]
        );

    endif;

}