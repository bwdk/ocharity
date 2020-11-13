<?php

// on inclus nos fichiers de sections de customizer (1 fichier par section)

require 'customizer/ocharity_topbar.php';
require 'customizer/ocharity_footer.php';

if (!function_exists('ocharity_customize_register')) {

    // Ma fonction, puisqu'elle est greffée sur le hook "customize_register"
    // récupère automatiquement l'objet "wp_customize"
    // Cet objet représente le customizer tel qu'il existe actuellement
    // https://codex.wordpress.org/Theme_Customization_API

    function ocharity_customize_register($wp_customize)
    {
        // Première étape : ajouter un panel
        $wp_customize->add_panel(
            // identifiant unique du panel
            'ocharity_theme_panel',
            [
                // Titre
                'title' => 'O\'Charity',
                // Description
                'description' => 'O\'Charity - Gestion du thème',
                // Emplacement
                'priority' => 1
            ]
        );

        // Deuxième étape : ajouter une section
        // Section topbar
        $wp_customize->add_section(
            'ocharity_topbar',
            [
                'title' => 'Barre de menu supérieure',
                'description' => 'O\'Charity - Gestion de la barre de menu supérieure',
                // Identifiant du panel sur lequel placer cette section
                'panel' => 'ocharity_theme_panel'
            ]
        );

        // section footer
        $wp_customize->add_section(
            'ocharity_footer',
            [
                'title' => 'Pied de page',
                'description' => 'O\'Charity - Gestion du pied de page',
                // Identifiant du panel sur lequel placer cette section
                'panel' => 'ocharity_theme_panel'
            ]
        );

        
        // on appelle la fonction qui gère les settings/controls de la topbar
        ocharity_topbar($wp_customize);
        // on appelle la fonction qui gère les settings/controls du footer
        ocharity_footer($wp_customize);

    }
}

add_action('customize_register', 'ocharity_customize_register');