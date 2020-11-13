
<?php
/*
Plugin Name: Mes collectes
Description: Un plugin permettant de créer des gérer mes collectes
Author: oCharity
Version: 1.0
*/

// Sécurisation du plugin
if (!defined('WPINC')) {
    die;
}

class Collectes
{
    public function __construct()
    {
        // ici on va accrocher nos méthodes à des hooks
        add_action('init', [$this, 'register_cpt']);
        add_action('init', [$this, 'create_taxo']);
    }

    public function register_cpt()
    {

        $labels = [
            'name'                  => 'Collectes',
            'singular_name'         => 'Collecte',
            'menu_name'             => 'Collectes',
            'name_admin_bar'        => 'Collectes',
            'archives'              => 'Archives des collectes',
            'attributes'            => 'Attributs des collectes',
            'parent_item_colon'     => 'Element parent',
            'all_items'             => 'Toutes les collectes',
            'add_new_item'          => 'Ajouter une nouvelle collecte',
            'add_new'               => 'Ajouter une nouvelle collecte',
            'new_item'              => 'Nouvelle collecte',
            'edit_item'             => 'Editer la collecte',
            'update_item'           => 'Mettre à jour la collecte',
            'view_item'             => 'Voir la collecte',
            'view_items'            => 'Voir les collectes',
            'search_items'          => 'Rechercher les collectes',
            'not_found'             => 'Aucune collecte trouvée',
            'not_found_in_trash'    => 'Aucune collecte trouvée dans la corbeille',
            'featured_image'        => 'Image de la collecte',
            'set_featured_image'    => 'Ajouter une image à la collecte',
            'remove_featured_image' => 'Supprimer l\'image de la collecte',
            'use_featured_image'    => 'Utiliser une image pour la collecte',
            'insert_into_item'      => 'Insérer dans la collecte',
            'uploaded_to_this_item' => 'Televerser dans la collecte',
            'items_list'            => 'Liste des collectes',
            'items_list_navigation' => 'Liste des collectes',
            'filter_items_list'     => 'Filtrer la liste des collectes',
        ];

        $args = [
            'labels'                => $labels,
            'label'                 => 'Collectes',
            'description'           => 'Collectes de l\'association O\'Charity',
            'supports'              => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
            ],
            // 'taxonomies' => [
            //     'category', 
            //     'post_tag',
            // ],
            'public'                => true,
            'hierarchical'          => false,
            'menu_icon'             => 'dashicons-admin-site-alt',
            'menu_position'         => 4,
            'show_in_nav_menus'     => true,
            'show_in_menus'         => true,
            'has_archive'           => true,
        ];

        register_post_type('collecte', $args);
    }

    public function create_taxo()
    {
        $labels = [
            'name'                       => 'Thèmes',
            'singular_name'              => 'Thème',
            'menu_name'                  => 'Thèmes',
            'all_items'                  => 'Tous les thèmes',
            'new_item_name'              => 'Nouveaux thème',
            'add_new_item'               => 'Ajouter un thème',
            'update_item'                => 'Mettre à jour un thème',
            'edit_item'                  => 'Editer un thème',
            'view_item'                  => 'Voir tous les thèmes',
            'separate_items_with_commas' => 'Séparer les thèmes avec une virgule',
            'add_or_remove_items'        => 'Ajouter ou supprimer un thème',
            'choose_from_most_used'      => 'Choisir parmis les thèmes les plus utilisés',
            'popular_items'              => 'Thèmes populaires',
            'search_items'               => 'Rechercher un thème',
            'not_found'                  => 'Aucun thème trouvé',
            'items_list'                 => 'Lister les thèmes',
        ];

        $args = [
            'labels'        => $labels,
            'hierarchical'  => true,
            'show_admin_column' => true,
            'public'        => true,
            'rewrite' => [
                'slug' => 'theme',
            ],
        ];

        register_taxonomy('theme', 'collecte', $args);

        $labels = [
            'name'                       => 'Pays',
            'singular_name'              => 'Pays',
            'menu_name'                  => 'Pays',
            'all_items'                  => 'Tous les pays',
            'new_item_name'              => 'Nouveau pays',
            'add_new_item'               => 'Ajouter un pays',
            'update_item'                => 'Mettre à jour un pays',
            'edit_item'                  => 'Editer un pays',
            'view_item'                  => 'Voir tous les pays',
            'separate_items_with_commas' => 'Séparer les pays avec une virgule',
            'add_or_remove_items'        => 'Ajouter ou supprimer un pays',
            'choose_from_most_used'      => 'Choisir parmis les pays les plus utilisés',
            'popular_items'              => 'Pays populaires',
            'search_items'               => 'Rechercher un pays',
            'not_found'                  => 'Aucun pays trouvé',
            'items_list'                 => 'Lister les pays',
            'items_list_navigation'      => 'Lister les pays',
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => false,
            'show_admin_column' => true,
            'public'            => true,
            'rewrite' => [
                'slug' => 'pays',
            ]
        ];

        register_taxonomy('pays', 'collecte', $args);

        $labels = [
            'name'                       => 'Statut',
            'singular_name'              => 'Statut',
            'menu_name'                  => 'Statut',
            'all_items'                  => 'Tous les statuts',
            'new_item_name'              => 'Nouveaux statuts',
            'add_new_item'               => 'Ajouter un statut',
            'update_item'                => 'Mettre à jour un statut',
            'edit_item'                  => 'Editer un statut',
            'view_item'                  => 'Voir tous les statut',
            'separate_items_with_commas' => 'Séparer les statuts avec une virgule',
            'add_or_remove_items'        => 'Ajouter ou supprimer un statut',
            'choose_from_most_used'      => 'Choisir parmis les statuts les plus utilisés',
            'popular_items'              => 'Statuts populaires',
            'search_items'               => 'Rechercher un statut',
            'not_found'                  => 'Aucun statut trouvé',
            'items_list'                 => 'Lister les statuts',
        ];

        $args = [
            'labels'        => $labels,
            'hierarchical'  => true,
            'show_admin_column' => true,
            'public'        => true,
            'rewrite' => [
                'slug' => 'statut'
            ],
        ];
        register_taxonomy('statut', 'collecte', $args);
    }

    public function activation()
    {
        $this->register_cpt();
        $this->create_taxo();

        flush_rewrite_rules();
    }

    public function deactivation()
    {
        flush_rewrite_rules();
    }
}

// COLLECTES + TAXOS
$collectes = new Collectes();

// A l'activation du plugin
register_activation_hook(__FILE__, [$collectes, 'activation']);

// A la désactivation du plugin
register_deactivation_hook(__FILE__, [$collectes, 'deactivation']);
