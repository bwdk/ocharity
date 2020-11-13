<?php

function ocharity_footer($wp_customize) {

    // Télephone
    $wp_customize->add_setting(
        'ocharity_footer_num',
        [
            'default' => '+33 6 65 65 65 65'
        ]
    );
    $wp_customize->add_control(
        'ocharity_footer_num',
        [
            'type' => 'text',
            'section' => 'ocharity_footer',
            'label' => 'Numéro de téléphone',
            'description' => 'Numéro de téléphone affiché dans le pied de page'
        ]
    );

    // Email
    $wp_customize->add_setting(
        'ocharity_footer_email',
        [
            'default' => 'ocharity@ocharity.fr'
        ]
    );
    $wp_customize->add_control(
        'ocharity_footer_email',
        [
            'type' => 'email',
            'section' => 'ocharity_footer',
            'label' => 'Adresse email',
            'description' => 'Adresse email affichée dans le pied de page'
        ]
    );

    // Adresse postale
    $wp_customize->add_setting(
        'ocharity_footer_address',
        [
            'default' => '55 rue de Papou 17000 La Rochelle'
        ]
    );
    $wp_customize->add_control(
        'ocharity_footer_address',
        [
            'type' => 'textarea',
            'section' => 'ocharity_footer',
            'label' => 'Adresse postale',
            'description' => 'Adresse postale affichée dans le pied de page'
        ]
    );

    // Activation / désactivation de l'afichage du footer
    $wp_customize->add_setting('ocharity_footer_active');

    $wp_customize->add_control(
        'ocharity_footer_active',
        [
            'type' => 'checkbox',
            'section' => 'ocharity_footer',
            'label' => 'Activer l\'affichage du footer',
            'description' => 'Permet de masquer ou afficher le pied de page'
        ]
    );

    // si on désactive le footer, on désactive le color picker
    if (get_theme_mod('ocharity_footer_active')):

        // Modification de la couleur du bg du footer
        $wp_customize->add_setting(
            'ocharity_footer_bgcolor',
            [
                'default' => '#292f4c'
            ]
        );

        $wp_customize->add_control(
            'ocharity_footer_bgcolor',
            [
                'type' => 'color',
                'section' => 'ocharity_footer',
                'label' => 'Couleur de fond du footer',
                'description' => 'Permet de modifier la couleur de fond du pied de page'
            ]
        );

    endif;

}